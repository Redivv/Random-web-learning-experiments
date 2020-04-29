<?php

namespace Tests\Unit;

use App\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{

    protected $product;
    

    protected function setUp() : void
    {
        $this->product = new Product('kek',59);
    }
    
    /** @test */
    public function a_product_has_name()
    {
        $this->assertEquals('kek',$this->product->name());
    }
    
    /** @test */
    public function a_product_has_price()
    {
        $this->assertEquals(59,$this->product->price());
    }
    
    
}
