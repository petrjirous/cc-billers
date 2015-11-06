<?php
namespace Billers\PayON\BankTransfer;
use Billers\PayON\BankTransfer\Exceptions\IncorrectFormatException;
use CzechCash\Billers\Structures\BankTransfers\Interfaces\ITransferDetails;


/**
 *
 *
 * @author Kenny
 * @package Billers\PayON\BankTransfer
 */
class TransferDetails extends BaseRequestable implements ITransferDetails
{
	/**
	 * @var double
	 */
	private $amount;
	/**
	 * @var string A3[a-zA-Z]{3}
	 */
	private $currency;
	/**
	 * @var string AN32[a-zA-Z0-9_] {1,32}
	 */
	private $paymentBrand;
	/**
	 * @var string A2
	 */
	private $paymentType;
	/**
	 * @var string AN127 [\s\S]{1,127}
	 */
	private $descriptor;
	/**
	 * @var string AN255 [\s\S]{8,255}
	 */
	private $merchantTransactionId;
	/**
	 * @var string AN255 [\s\S]{8,255}
	 */
	private $merchantInvoiceId;
	/**
	 * @var Customer
	 */
	private $customer;
	/**
	 * @var BankAccount
	 */
	private $bankAccount;
	/**
	 * @var Billing
	 */
	private $billing;
	/**
	 * @var array <CustomParameter>
	 */
	private $customParameters;
	/**
	 * @var Cart
	 */
	private $cart;
	/**
	 * @var string
	 */
	private $shopperResultUrl;
	/**
	 * @var string
	 */
	private $testMode;

	/**
	 * @return float
	 */
	public function getAmount()
	{
		return number_format($this->amount, 2, ".", '');
	}

	/**
	 * @param float $amount
	 * @return TransferDetails
	 */
	public function setAmount($amount)
	{
		$this->amount = $amount;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getCurrency()
	{
		return $this->currency;
	}

	/**
	 * @param string $currency
	 * @return TransferDetails
	 * @throws IncorrectFormatException
	 */
	public function setCurrency($currency)
	{
		if(!preg_match('/^[a-zA-Z]{3}$/', $currency)){
			throw new IncorrectFormatException;
		}
		$this->currency = $currency;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPaymentBrand()
	{
		return $this->paymentBrand;
	}

	/**
	 * @param string $paymentBrand
	 * @return TransferDetails
	 * @throws IncorrectFormatException
	 */
	public function setPaymentBrand($paymentBrand)
	{
		if(!preg_match('/^[a-zA-Z0-9_]{1,32}$/',$paymentBrand)){
			throw new IncorrectFormatException;
		}
		$this->paymentBrand = $paymentBrand;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPaymentType()
	{
		return $this->paymentType;
	}

	/**
	 * @param string $paymentType
	 * @return TransferDetails
	 * @throws IncorrectFormatException
	 */
	public function setPaymentType($paymentType)
	{
		if(!preg_match('/^[A-Z]{2}$/', $paymentType)){
			throw new IncorrectFormatException;
		}
		$this->paymentType = $paymentType;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDescriptor()
	{
		return $this->descriptor;
	}

	/**
	 * @param string $descriptor
	 * @return TransferDetails
	 * @throws IncorrectFormatException
	 */
	public function setDescriptor($descriptor)
	{
		if(!preg_match('/^[\s\S]{1,127}$/', $descriptor)){
			throw new IncorrectFormatException;
		}
		$this->descriptor = $descriptor;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getMerchantTransactionId()
	{
		return $this->merchantTransactionId;
	}

	/**
	 * @param string $merchantTransactionId
	 * @return TransferDetails
	 * @throws IncorrectFormatException
	 */
	public function setMerchantTransactionId($merchantTransactionId)
	{
		if(!preg_match('/^[\s\S]{8,255}$/', $merchantTransactionId)){
			throw new IncorrectFormatException;
		}
		$this->merchantTransactionId = $merchantTransactionId;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getMerchantInvoiceId()
	{
		return $this->merchantInvoiceId;
	}

	/**
	 * @param string $merchantInvoiceId
	 * @return TransferDetails
	 * @throws IncorrectFormatException
	 */
	public function setMerchantInvoiceId($merchantInvoiceId)
	{
		if(!preg_match('/^[\s\S]{8,255}$/', $merchantInvoiceId)){
			throw new IncorrectFormatException;
		}
		$this->merchantInvoiceId = $merchantInvoiceId;
		return $this;
	}

	/**
	 * @return Customer
	 */
	public function getCustomer()
	{
		return $this->customer;
	}

	/**
	 * @param Customer $customer
	 * @return TransferDetails
	 */
	public function setCustomer($customer)
	{
		$this->customer = $customer;
		return $this;
	}

	/**
	 * @return BankAccount
	 */
	public function getBankAccount()
	{
		return $this->bankAccount;
	}

	/**
	 * @param BankAccount $bankAccount
	 * @return TransferDetails
	 */
	public function setBankAccount($bankAccount)
	{
		$this->bankAccount = $bankAccount;
		return $this;
	}

	/**
	 * @return Billing
	 */
	public function getBilling()
	{
		return $this->billing;
	}

	/**
	 * @param Billing $billing
	 * @return TransferDetails
	 */
	public function setBilling($billing)
	{
		$this->billing = $billing;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getCustomParameters()
	{
		return $this->customParameters;
	}

	/**
	 * @param array $customParameters
	 * @return TransferDetails
	 */
	public function setCustomParameters($customParameters)
	{
		$this->customParameters = $customParameters;
		return $this;
	}

	/**
	 * @return Cart
	 */
	public function getCart()
	{
		return $this->cart;
	}

	/**
	 * @param Cart $cart
	 * @return TransferDetails
	 */
	public function setCart($cart)
	{
		$this->cart = $cart;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getShopperResultUrl()
	{
		return $this->shopperResultUrl;
	}

	/**
	 * @param string $shopperResultUrl
	 * @return TransferDetails
	 */
	public function setShopperResultUrl($shopperResultUrl)
	{
		$this->shopperResultUrl = $shopperResultUrl;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getTestMode()
	{
		return $this->testMode;
	}

	/**
	 * @param string $testMode
	 * @return TransferDetails
	 */
	public function setTestMode($testMode)
	{
		$this->testMode = $testMode;
		return $this;
	}

}