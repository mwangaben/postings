<?php

namespace Tests\Feature;

use App\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    /**
    *@test
    */
    public function a_product_has_a_name()
    {
        $product = new Product('benz', 20);
        $this->assertEquals('benz', $product->name());
    }

   /**
   *@test
   */
   public function a_product_has_a_price()
   {
   		$product = new Product('benz', 20);
   		$this->assertEquals(20, $product->cost());
   }

}







