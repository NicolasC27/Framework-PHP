<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 14/09/2017
 * Time: 19:50
 */

namespace Tests\Framework;


use Framework\Renderer;
use PHPUnit\Framework\TestCase;

class RendererTest extends TestCase
{
    private $renderer;

    public function setUp()
    {
        $this->renderer = new Renderer();
    }

/*    public function testRenderTheRightPath()
    {
        $this->renderer->addPath('blog', __DIR__ . '/views');
        $content = $this->renderer->render('@blog/demo');
        $this->assertEquals('Salut les gens', $content);
    }
*/
    public function testRenderTheDefaultPath()
    {
        $this->renderer->addPath(__DIR__ . '/views');
        $content = $this->renderer->render('demo');
        $this->assertEquals('Salut les gens', $content);
    }

    public function testRenderwithParams()
    {
        $this->renderer->addPath(__DIR__ . '/views');
        $content = $this->renderer->render('demoparams', ['nom' => 'Marc']);
        $this->assertEquals('Hello Marc', $content);
    }


    public function testRenderGlobalParams()
    {
        $this->renderer->addPath(__DIR__ . '/views');
        $this->renderer->addGlobal('nom', 'Marc');
        $content = $this->renderer->render('demoparams');
        $this->assertEquals('Hello Marc', $content);
    }
}