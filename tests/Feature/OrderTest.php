<?php

namespace Tests\Feature;

use App\Order;
use App\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class OrderTest extends TestCase
{
	
	private $order;	
	public function setUp()
	{
		parent::setup();

		$this->order = $this->createOrdeWithProducts();
	}
	/**
	*@test
	*/
	public function an_order_consists_of_products()
	{
		$this->assertCount(2, $this->order->products());
	}

	/**
	*@test
	*/
	public function an_order_can_determine_its_total_cost(){
		$this->assertEquals(40, $this->order->totalCost()); 
	}

	private function createOrdeWithProducts()
	{
		$order = new Order();
		$product1 = new Product('benz', 20);
		$product2 = new Product('Toyota', 20);

		$order->add($product1); 
		$order->add($product2);

		return $order;
	}

	 /** @test */
	 public function basic_test()
	 {
	 	$this->assertEquals(2, 2);
	 }
}
