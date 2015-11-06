<?php
namespace CzechCash\Billers\Structures\BankTransfers\Interfaces;
use Billers\PayON\BankTransfer\BankAccount;
use Billers\PayON\BankTransfer\Billing;
use Billers\PayON\BankTransfer\Customer;
use Billers\PayON\BankTransfer\Exceptions\IncorrectFormatException;
use Billers\PayON\BankTransfer\TransferDetails;


/**
 *
 *
 * @author Kenny
 * @package CzechCash\Billers\Structures\BankTransfers\Interfaces
 */
interface ITransferDetails
{

	public function getAmount();

	/**
	 * @param float $amount
	 * @return TransferDetails
	 */
	public function setAmount($amount);

	/**
	 * @return string
	 */
	public function getCurrency();

	/**
	 * @param string $currency
	 * @return TransferDetails
	 * @throws IncorrectFormatException
	 */
	public function setCurrency($currency);

	/**
	 * @return string
	 */
	public function getPaymentBrand();

	/**
	 * @param string $paymentBrand
	 * @return TransferDetails
	 * @throws IncorrectFormatException
	 */
	public function setPaymentBrand($paymentBrand);

	/**
	 * @return string
	 */
	public function getPaymentType();

	/**
	 * @param string $paymentType
	 * @return TransferDetails
	 * @throws IncorrectFormatException
	 */
	public function setPaymentType($paymentType);

	/**
	 * @return string
	 */
	public function getDescriptor();

	/**
	 * @param string $descriptor
	 * @return TransferDetails
	 * @throws IncorrectFormatException
	 */
	public function setDescriptor($descriptor);

	/**
	 * @return string
	 */
	public function getMerchantTransactionId();

	/**
	 * @param string $merchantTransactionId
	 * @return TransferDetails
	 * @throws IncorrectFormatException
	 */
	public function setMerchantTransactionId($merchantTransactionId);

	/**
	 * @return string
	 */
	public function getMerchantInvoiceId();

	/**
	 * @param string $merchantInvoiceId
	 * @return TransferDetails
	 * @throws IncorrectFormatException
	 */
	public function setMerchantInvoiceId($merchantInvoiceId);

	/**
	 * @return Customer
	 */
	public function getCustomer();

	/**
	 * @param Customer $customer
	 * @return TransferDetails
	 */
	public function setCustomer($customer);

	/**
	 * @return BankAccount
	 */
	public function getBankAccount();

	/**
	 * @param BankAccount $bankAccount
	 * @return TransferDetails
	 */
	public function setBankAccount($bankAccount);

	/**
	 * @return Billing
	 */
	public function getBilling();

	/**
	 * @param Billing $billing
	 * @return TransferDetails
	 */
	public function setBilling($billing);

	/**
	 * @return array
	 */
	public function getCustomParameters();

	/**
	 * @param array $customParameters
	 * @return TransferDetails
	 */
	public function setCustomParameters($customParameters);

	public function getRequest(array $requiredColumns);
}