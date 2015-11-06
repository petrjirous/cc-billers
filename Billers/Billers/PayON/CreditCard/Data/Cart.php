<?php
namespace Billers\PayON\CreditCard\Data;


/**
 *
 *
 * @author Kenny
 * @package Billers\PayON\CreditCard\Data
 */
class Cart implements IArrayable
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
	 * @return Cart
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
	 * @return Cart
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
	 * @return Cart
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
	 * @return Cart
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
	 * @return Cart
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
	 * @return Cart
	 */
	public function setTax($tax)
	{
		$this->tax = $tax;
		return $this;
	}

	public function toArray($iterator = null)
	{
		$iterator = ($iterator === null ? 0 : $iterator);
		$cart = 'cart.items[' . $iterator . '].';
		return [
			$cart . 'discount' => $this->getDiscount(),
			$cart . 'merchantProductId' => $this->getMerchantItemId(),
			$cart . 'name' => $this->getName(),
			$cart . 'price' => $this->getPrice(),
			$cart . 'quantity' => $this->getQuantity(),
			$cart . 'tax' => $this->getTax()
		];
	}

}