<?php
namespace Billers\Webbilling;
use Billers\PayON\BankTransferPaymentValidator;
use CzechCash\Billers\Billers\BaseBiller;


/**
 *
 *
 * @author Kenny
 * @package Billers\Webbilling
 */
class WebbillingBiller extends BaseBiller
{
	protected $configFile = __DIR__ . "/config/webbilling.neon";

	/**
	 * @inheritDoc
	 */
	public function isServiceAvailable()
	{
		exec(sprintf('ping -c 1 -W 5 %s', escapeshellarg($this->config['host'])), $res, $rval);
		return $rval === 0;
	}

	public function createPayment($transferDetails){
		$payment = new BankTransferBasePayment($transferDetails);
		$payment->setTransferDetails($transferDetails);
		$payment->onProcess = [$this, 'processPayment'];
		$payment->validate = new BankTransferPaymentValidator();
		$payment->onFailure = function($response){
			return false;
		};
		$payment->onSuccess = function($response){
			return true;
		};
		return $payment;
	}

	public function getAuthentication(){
		$credentials = [
			'MerchantID' => $this->config['authentication']['merchantId'],
			'Password' => $this->config['authentication']['password'],
			'ProfileID' => $this->config['authentication']['profileId']
		];
		$xml = Array2XML::createXML('Merchant', $credentials);

		return $xml->saveXML();
	}

	public function proccessPayment($transferDetails){

	}
}
