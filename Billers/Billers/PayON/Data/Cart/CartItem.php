<?php
namespace Billers\PayON\Data\Cart;


/**
 *
 *
 * @author Kenny
 * @package Billers\PayON\BankTransfer\Cart
 */
class CartItem
{
	/**
	 * @var float
	 */
	private $discount;
	/**
	 * @var int
	 */
	private $merchantItemId;
	/**
	 * @var string
	 */
	private $name;
	/**
	 * @var float
	 */
	private $price;
	/**
	 * @var int
	 */
	private $quantity;
	/**
	 * @var float
	 */
	private $tax;

	/**
	 * @return float
	 */
	public function getDiscount()
	{
		return $this->discount;
	}

	/**
	 * @param float $discount
	 * @return CartItem
	 */
	public function setDiscount($discount)
	{
		$this->discount = $discount;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getMerchantItemId()
	{
		return $this->merchantItemId;
	}

	/**
	 * @param int $merchantItemId
	 * @return CartItem
	 */
	public function setMerchantItemId($merchantItemId)
	{
		$this->merchantItemId = $merchantItemId;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 * @return CartItem
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * @return float
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * @param float $price
	 * @return CartItem
	 */
	public function setPrice($price)
	{
		$this->price = $price;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getQuantity()
	{
		return $this->quantity;
	}

	/**
	 * @param int $quantity
	 * @return CartItem
	 */
	public function setQuantity($quantity)
	{
		$this->quantity = $quantity;
		return $this;
	}

	/**
	 * @return float
	 */
	public function getTax()
	{
		return $this->tax;
	}

	/**
	 * @param float $tax
	 * @return CartItem
	 */
	public function setTax($tax)
	{
		$this->tax = $tax;
		return $this;
	}
}