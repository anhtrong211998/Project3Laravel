<?php 
namespace App;
class Cart{
	public $items = null;
	public $totalPrice= 0;
	public $totalQty = 0;
	//construct cart
	public function __construct($oldCart){
		if($oldCart){
			$this->items=$oldCart->items;
			$this->totalQty=$oldCart->totalQty;
			$this->totalPrice=$oldCart->totalPrice;
		}
		
	}
	//add new product to cart with quantity = 1(for same index pages )
	public function Add($item,$id){
		$price = $item->product_price - ($item->product_price * $item->product_sale)*0.01; 
		//create a new cart with empty
		$newItem = ['qty'=>0,'price'=>$price,'item'=>$item];
		if($this->items){
			if(array_key_exists($id,$this->items)){
				//if not empty items and exists items has id, give data to new cart
				$newItem = $this->items[$id];
			}
		}
		//quanty add 1
		$newItem['qty']++;
		//update price of new cart
		$newItem['price']=$newItem['qty']*$price;
		//give new cart to list cart
		$this->items[$id]=$newItem;
		//update total quanty
		$this->totalQty++;
		//update total price = total price + product's price
		$this->totalPrice +=$price;
	}
	// //add new product to cart with quanty > 1
	// public function Add($item,$id,$quantity){
	// 	$price = $item->product_price - ($item->product_price * $item->product_sale)*0.01; 
	// 	//create a new cart with empty
	// 	$newItem = ['qty'=>0,'price'=>$price,'item'=>$item];
	// 	if($this->items){
	// 		if(array_key_exists($id,$this->items)){
	// 			//if not empty items and exists items has id, give data to new cart
	// 			$newItem = $this->items[$id];
	// 		}
	// 	}
	// 	//quanty add 1
	// 	if($quantity > 1){
	// 		$newItem['qty'] = $quantity;
	// 	}
	// 	else{
	// 		$newItem['qty']++;
	// 	}
	// 	//update price of new cart
	// 	$newItem['price']=$newItem['qty']*$price;
	// 	//give new cart to list cart
	// 	$this->items[$id]=$newItem;
	// 	//update total quanty
	// 	$this->totalQty++;
	// 	//update total price = total price + product's price
	// 	$this->totalPrice +=$price;
	// }
	//delete product from cart
	public function Delete($id){
		//update total quanty
		$this->totalQty -= $this->items[$id]['qty'];
		//update total price
		$this->totalPrice -= $this->items[$id]['price'];
		//delete product 
		unset($this->items[$id]);
	}
	//update quanty 
	public function Update($id,$quanty){
		$price = $this->items[$id]['item']->product_price - ($this->items[$id]['item']->product_price * $this->items[$id]['item']->product_sale)*0.01;
		//get total price and total quanty without product which need update
		$this->totalQty -= $this->items[$id]['qty'];
		$this->totalPrice -= $this->items[$id]['price'];
		//update quanty and price for product of cart
		if($quanty <= 0){
			$quanty =1;
		}
		$this->items[$id]['qty']=$quanty;
		$this->items[$id]['price']=$price*$quanty;
			//update total price and total quanty
		$this->totalQty += $this->items[$id]['qty'];
		$this->totalPrice += $this->items[$id]['price'];	
	}
}

?>