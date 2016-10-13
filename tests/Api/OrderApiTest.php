<?php

namespace Testing\Api;

use Testing\TestCase;

class OrderApiTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->order = [
            'id' => '1',
            '' => '',
        ];

        $this->seller = [
        ];

        $this->customer = [
        ];

        $this->product = [
        ];

        $this->payment = [
        ];

        $this->shipping = [
        ];

        $this->invoice = [
        ];
    }

    public function testIndex()
    {
        $this->json('GET', '/order')
            ->seeJson([
                'success' => true,
            ]);
    }

    public function testCreate()
    {
        $order = $this->order;
        $order['_state'] = "NEW";

        $this->json('POST', '/order', $order)
            ->seeJson([
                'success' => true,
                'data' => $order
            ]);
    }

    public function testModify()
    {
        $order = $this->order;
        $order['_state'] = "DIRTY";

        $this->json('POST', '/order', $order)
            ->seeJson([
                'success' => true,
                'data' => $order
            ]);
    }

    public function testShow()
    {
        $id = $this->order['id'];

        $this->json('GET', '/order/' . $id)
            ->seeJson([
                'success' => true,
            ]);
    }

    public function testDestroy()
    {
        $order = $this->order;
        $order['_state'] = "REMOVED";

        $this->json('POST', '/order', $order)
            ->seeJson([
                'success' => true,
                'data' => $order
            ]);
    }
}
