<?php
namespace Billers\PayON\BankTransfer;


/**
 *
 *
 * @author Kenny
 * @package Billers\PayON\BankTransfer
 */
class Cart
{
	/**
	 * @var array <CartItem>
	 */
	private $items;

	/**
	 * @return array
	 */
	public function getItems()
	{
		return $this->items;
	}

	/**
	 * @param array $items
	 * @return Cart
	 */
	public function setItems($items)
	{
		$this->items = $items;
		return $this;
	}


}