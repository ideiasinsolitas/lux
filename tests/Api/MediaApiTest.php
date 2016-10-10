<?php

namespace Testing\Api;

use Testing\TestCase;

class MediaApiTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->media = [
            'id' => '1',
            '' => '',
        ];
    }

    public function testIndex()
    {
        $this->json('GET', '/media')
            ->seeJson([
                'success' => true,
            ]);
    }

    public function testCreate()
    {
        $media = $this->media;
        $media['_state'] = "NEW";

        $this->json('POST', '/media', $media)
            ->seeJson([
                'success' => true,
                'data' => $media
            ]);
    }

    public function testModify()
    {
        $media = $this->media;
        $media['_state'] = "DIRTY";

        $this->json('POST', '/media', $media)
            ->seeJson([
                'success' => true,
                'data' => $media
            ]);
    }

    public function testShow()
    {
        $id = $this->media['id'];

        $this->json('GET', '/media/' . $id)
            ->seeJson([
                'success' => true,
            ]);
    }

    public function testDestroy()
    {
        $media = $this->media;
        $media['_state'] = "REMOVED";

        $this->json('POST', '/media', $media)
            ->seeJson([
                'success' => true,
                'data' => $media
            ]);
    }
}
