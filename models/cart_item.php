<?php
class CartItemException extends Exception {}

/**
 * Generated by PHPUnit_SkeletonGenerator on 2012-05-17 at 23:15:30.
 */
class CartItem
{
	public $product;
	private $qty = 0;

	public function __construct(Product $product = null, $qty = 0)
	{
		if (is_null($product))
		{
			throw new CartItemException("Invalid Cart Item");
		}
		if ($qty < 0)
		{
			throw new CartItemException("Invalid quantity");
		}
		if (!$product->has_stock())
		{
			throw new CartItemException("There is no stock");
		}
		if ($product->stock_qty < $qty)
		{
			throw new CartItemException("Insufficient stock");
		}
		$this->product = $product;
		$this->qty = $qty;
	}

    public function getQty()
    {
        return $this->qty;
    }

    public function getSubTotal()
    {
        return $this->qty * $this->product->unit_price;
    }

    public function setQty($new_qty=0)
    {
		if ($new_qty < 0)
		{
			throw new CartItemException("Invalid quantity");
		}
		if ($this->product->stock_qty < $new_qty)
		{
			throw new CartItemException("Insufficient stock");
		}
        $this->qty = $new_qty;
        return $this->qty;
    }
}