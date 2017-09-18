<?php

/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 16/09/2017
 * Time: 01:29
 */

namespace App\Modules\Student\Actions;

use Framework\database\Table;
use Framework\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface as Request;


class StudentAction
{
    /**
     * @var RendererInterface
     */
    private $renderer;

    /**
     * @var \PDO
     */
    private $pdo;

    /*
     * @var Table
     */
    private $table;

    /**
     * StudentAction constructor.
     * @param RendererInterface $renderer
     * @param \PDO $pdo
     */
    public function __construct(RendererInterface $renderer, \PDO $pdo)
    {
        $this->renderer = $renderer;
        $this->pdo = $pdo;
        $this->table = new Table($pdo);
    }

    public function __invoke(Request $request)
    {
        if ($request->getMethod() === "POST")
            return $this->post($request);
        if ($request->getUri()->getPath() === "/student/add")
            return $this->add();
        $slug = $request->getAttribute('slug');
        return $slug ? $this->show($slug) : $this->index();
    }

    public function index(): string
    {
        $students = $this->pdo
            ->query('SELECT student.name as name, GROUP_CONCAT(school.name SEPARATOR \' - \') as school FROM student LEFT JOIN student_school ON student.id = student_school.student_id LEFT JOIN school ON student_school.school_id = school.id GROUP BY student.name')
            ->fetchAll();

        return $this->renderer->render('@student/index', compact('students'));
    }

    public function show(string $slug): string
    {
        return $this->renderer->render('@student/show', [
            'slug' => $slug
        ]);
    }

    public function add(): string
    {
        $schools = $this->pdo
            ->query('SELECT * from school');
        return $this->renderer->render('@student/add', compact('schools'));
    }

    public function post(Request $request)
    {
        $params = $request->getParsedBody();

        $userParams = [
            'name' => $params['name'],
            'email' => $params['email'],
            'slug' => $params['name']
        ];

        $this->table->insert('student', $userParams);

        $array = $params['school'];
        $school = array();

        $id = $this->pdo->lastInsertId();
        foreach ($array as $item)
        {
            $school["student_id"] = $id;
            $school["school_id"] = $item;
            $this->table->insert('student_school', $school);
        }

        return $this->index();
    }
}