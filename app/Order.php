<?php 
namespace App;

/**
* Order
*/
class Order
{
	protected $products = [];
	public function add($products)
	{
		$this->products[] = $products;
	}
	public function products()
	{
		return $this->products;	
	}

	public function totalCost()
	{
		return array_reduce($this->products, function($carry, $product) {
			return $carry += $product->cost();
			
		});
	}
}

 ?>