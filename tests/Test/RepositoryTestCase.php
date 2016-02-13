<?php

namespace Test;

use Maltz\Mvc\DB;

class ModelTestCase extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->db = new DB('mysql://localhost&dbname=maltz_unit_test', 'root', 'root');
    }

    public function tearDown()
    {
        $this->db = null;
    }

    public function runTests($result)
    {
        $this->assertInstanceOf('', $result);
        $this->assertTrue(is_array($result));
        $this->assertArrayHasKey('success', $result);
        $this->assertArrayHasKey('message', $result);
        $this->assertTrue($result->isSuccessful() === true);
        $this->assertTrue(is_string($result->getMessage()));
    }

    public function runSelectTests($result)
    {
        $this->runTests($result);
        $result = $result->toArray();
        $this->assertArrayHasKey('records', $result);
        $this->assertTrue(is_array($result->getRecords()));
        $this->assertContainsOnlyInstancesOf('', $result);
    }

    public function runInsertTests($result)
    {
        $this->runTests($result);
        $result = $result->toArray();
        $this->assertArrayHasKey('last.insert.id', $result);
    }

    public function runUpdateTests($result)
    {
        $this->runTests($result);
    }

    public function runDeleteTests($result)
    {
        $this->runTests($result);
    }
}
