<?php

namespace Testing\Api;

use Testing\Cases\TestCase;

class AreaApiTest extends TestCase
{
    public function setUp()
    {

    }

    public function testIndex()
    {
        $this->json('GET', '/')->seeJson([
            'success' => true,
            ]);
    }

    public function testSave()
    {
        $data = [];
        $this->json('POST', '/', $data)->seeJson([
            'success' => true,
            ]);
    }

    public function testShow()
    {
        $this->json('GET', '/')->seeJson([
            'success' => true,
            ]);
    }

    public function testDestroy()
    {
        $this->json('DELETE', '/')->seeJson([
            'success' => true,
            ]);
    }
}
