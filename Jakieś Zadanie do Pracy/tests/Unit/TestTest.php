<?php

use PHPUnit\Framework\TestCase;
use App\Test;

class TestTest extends TestCase
{
    /** @test */
    public function testTesting()
    {
        $this->assertEquals(5, Test::keo());
    }
    
}