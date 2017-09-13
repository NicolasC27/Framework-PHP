<?php

namespace Tests\Framework;

use App\Modules\Blog\BlogModule;
use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase {

    public function testRedirectTrailingSlash()
    {
        $app = new App();
        $request = new ServerRequest('GET', '/demoslash/');

        $response = $app->run($request);

        $this->assertContains('/demoslash', $response->getHeader('Location'));
        $this->assertEquals(301, $response->getStatusCode());
    }

    public function testBlog()
    {
        $app = new App([
            BlogModule::class
        ]);

        $request = new ServerRequest('GET', '/blog');
        $response = $app->run($request);
        $this->assertContains('<h1>Bienvenue sur le blog</h1>', (string)$response->getBody());
        $this->assertEquals(200, $response->getStatusCode());


        $requestSingle = new ServerRequest('GET', '/blog/article-de-test');
        $responseSingle = $app->run($requestSingle);
        $this->assertContains('<h1>Welcome on this article</h1>',  (string)$responseSingle->getBody());

    }

    public function testError404()
    {
        $app = new App();
        $request = new ServerRequest('GET', '/aza');
        $response = $app->run($request);
        $this->assertContains('<h1>Erreur 404</h1>', (string)$response->getBody());
        $this->assertEquals(404, $response->getStatusCode());
    }
}