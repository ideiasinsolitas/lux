<?php

namespace Testing\Api;

use Testing\TestCase;

class ShopApiTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->product = [
            'id' => '1',
            '' => '',
        ];

        $this->shop = [
            'id' => '1',
            '' => '',
            'products' => []
        ];
    }

    public function testIndex()
    {
        $this->json('GET', '/shop')
            ->seeJson([
                'success' => true,
            ]);
    }

    public function testCreate()
    {
        $shop = $this->shop;
        $shop['_state'] = "NEW";

        $this->json('POST', '/shop', $shop)
            ->seeJson([
                'success' => true,
                'data' => $shop
            ]);
    }

    public function testModify()
    {
        $shop = $this->shop;
        $shop['_state'] = "DIRTY";

        $this->json('POST', '/shop', $shop)
            ->seeJson([
                'success' => true,
                'data' => $shop
            ]);
    }

    public function testShow()
    {
        $id = $this->shop['id'];

        $this->json('GET', '/shop/' . $id)
            ->seeJson([
                'success' => true,
            ]);
    }

    public function testAddProduct()
    {
        $shop = $this->shop;
        $product = $this->product;
        $shop['products'][] = $product;

        $this->json('POST', '/shop', $shop)
            ->seeJson([
                'success' => true,
                'data' => $shop
            ]);
    }

    public function testUpdateProduct()
    {
        $shop = $this->shop;
        $product = $this->product;
        $shop = $this->shop;
        $product = $this->product;
        $shop['products'][] = $product;
        $shop['products'][] = $product;
        
        $this->json('POST', '/shop', $shop)
            ->seeJson([
                'success' => true,
                'data' => $shop
            ]);
    }

    public function testRemoveProduct()
    {
        $shop = $this->shop;
        $product = $this->product;
        $shop['products'][] = $product;

        $this->json('POST', '/shop', $shop)
            ->seeJson([
                'success' => true,
                'data' => $shop
            ]);
    }

    public function testDestroy()
    {
        $shop = $this->shop;
        $shop['_state'] = "REMOVED";

        $this->json('POST', '/shop', $shop)
            ->seeJson([
                'success' => true,
                'data' => $shop
            ]);
    }
}
