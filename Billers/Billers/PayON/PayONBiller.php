<?php
namespace Billers\PayON;

use Billers\PayON\Data\Exceptions\UnsupportedTypeException;
use CzechCash\Billers\Billers\BaseBiller;
use CzechCash\Billers\Structures\BankTransfers\Interfaces\ITransferDetails;
use CzechCash\Billers\Structures\Payments\PayONPayment;
use Tracy\Debugger;


/**
 *
 *
 * @author Kenny
 * @package Billers\PayON\BankTransfer
 */
class PayONBiller extends BaseBiller
{
	protected $configFile = __DIR__ . '/config/payOn.neon';

	/**
	 * @inheritDoc
	 */
	public function isServiceAvailable()
	{
		exec(sprintf('ping -c 1 -W 5 %s', escapeshellarg($this->config['host'])), $res, $rval);
		return $rval === 0;
	}

	public function createPayment(ITransferDetails $transferDetails)
	{
		$payment = new PayONPayment($transferDetails);
		$payment->setTransferDetails($transferDetails);
		$payment->onProcess = array($this, 'processPayment');

		$type = $this->config['brands'][strtolower($transferDetails->getPaymentBrand())]['type'];

		// TODO dopsat validator
		if ($type === "creditcard") {
			$payment->validate = new CreditCardPaymentValidator();
		} elseif ($type === "banktransfer") {
			$payment->validate = new BankTransferPaymentValidator();
		} else {
			throw new UnsupportedTypeException();
		}
		$payment->onFailure = function ($response) {
			return false;
		};
		$payment->onSuccess = function ($response) {
			return true;
		};
		return $payment;
	}

	public function getRequestUrl()
	{
		$url = $this->config['protocol'] . "://" . $this->config['host'];
		return join("/", [
			$url,
			$this->config['apiVersion'],
			$this->config['paymentUrl']
		]);
	}

	public function getAuthentication()
	{
		return [
			"authentication.userId" => $this->config['authentication']['userId'],
			"authentication.password" => $this->config['authentication']['password'],
			"authentication.entityId" => $this->config['authentication']['entityId']
		];
	}

	public function processPayment(ITransferDetails $transferDetails)
	{

		$brandOptions = $this->config['brands'][strtolower($transferDetails->getPaymentBrand())];
		unset($brandOptions['type']);

		if ($brandOptions === null) {
			$brandOptions = $this->config['brands']['default'];
		}
		$requestFields = $transferDetails->getRequest($brandOptions);

		foreach ($this->getAuthentication() as $key => $val) {
			$requestFields[$key] = $val;
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->getRequestUrl());
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($requestFields));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$responseData = curl_exec($ch);
		if (curl_errno($ch)) {
			return curl_error($ch);
		}
		curl_close($ch);
		//echo(http_build_query($requestFields));
		Debugger::barDump($requestFields);
		return $responseData;
	}
}