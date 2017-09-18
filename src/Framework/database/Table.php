<?php
/**
 * Created by PhpStorm.
 * User: kitephx
 * Date: 9/18/17
 * Time: 1:34 AM
 */

namespace Framework\database;

use PDO;

class Table
{
    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert(string $table, array $params) : bool
    {
        $fields = array_keys($params);
        $values = join(', ', array_map(function ($field) {
            return ':' . $field;
        }, $fields));
        $fields = join(', ', $fields);

        $query = $this->pdo->prepare("INSERT INTO {$table} ($fields) VALUES ($values)");
        return $query->execute($params);
    }
}