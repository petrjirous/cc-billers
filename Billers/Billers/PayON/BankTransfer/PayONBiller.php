<?php
namespace Billers\PayON\BankTransfer;
use CzechCash\Billers\Billers\BaseBiller;
use CzechCash\Billers\IBankTransferBiller;
use CzechCash\Billers\Structures\BankTransfers\Interfaces\ITransferDetails;
use CzechCash\Billers\Structures\Payments\BankTransferPayment;
use Tracy\Debugger;


/**
 *
 *
 * @author Kenny
 * @package Billers\PayON\BankTransfer
 */
class PayONBiller extends BaseBiller implements IBankTransferBiller
{
	protected $configFile = __DIR__ . '/../config/payOn.neon';

	/**
	 * @inheritDoc
	 */
	public function isServiceAvailable()
	{
		exec(sprintf('ping -c 1 -W 5 %s', escapeshellarg($this->config['host'])), $res, $rval);
		return $rval === 0;
	}

	public function createBankTransferPayment($amount, ITransferDetails $transferDetails)
	{
		$payment = new BankTransferPayment($transferDetails, $amount);
		$payment->setTransferDetails($transferDetails);
		$payment->onProcess = array($this, 'processPayment');
		$payment->validate = new \Billers\PayON\CreditCard\CreditCardPaymentValidator(); // TODO dopsat validator
		$payment->onFailure = function($response) {
			return false;
		};
		$payment->onSuccess = function($response){
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

	public function getAuthentication(){
		return [
			"authentication.userId" => $this->config['authentication']['userId'],
			"authentication.password" =>$this->config['authentication']['password'],
			"authentication.entityId" => $this->config['authentication']['entityId']
		];
	}

	public function processPayment($amount, ITransferDetails $transferDetails){

		$transferDetails->setAmount($amount);

		$brandOptions = $this->config['brands'][strtolower($transferDetails->getPaymentBrand())];
		if($brandOptions === null){
			$brandOptions = $this->config['brands']['default'];
		}
		$requestFields = $transferDetails->getRequest($brandOptions);

		foreach($this->getAuthentication() as $key => $val){
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