<?php
namespace Billers\PayON\CreditCard;

use Billers\PayON\CreditCard\Data\Asynchronous;
use Billers\PayON\CreditCard\Data\Synchronous;
use CzechCash\Billers\Billers\BaseBiller;
use CzechCash\Billers\ICreditCardBiller;
use CzechCash\Billers\Structures\CreditCards\ICreditCard;
use CzechCash\Billers\Structures\Payments\CreditCardPayment;


/**
 *
 *
 * @author Kenny
 * @package Billers\PayON
 */
class PayONBiller extends BaseBiller implements ICreditCardBiller
{
	protected $configFile = __DIR__ . '/../config/payOn.neon';

	public function isServiceAvailable()
	{
		exec(sprintf('ping -c 1 -W 5 %s', escapeshellarg($this->config['host'])), $res, $rval);
		return $rval === 0;
	}

	public function createCreditCardPayment($amount, ICreditCard $card, $details)
	{
		$payment = new CreditCardPayment($amount, $card, $details);
		$payment->setCreditCard($card);
		$payment->onProcess = [$this, 'processPayment'];
		$payment->validate = new CreditCardPaymentValidator();
		$payment->onFailure = function ($response) {
			return false;
		};
		$payment->onSuccess = function ($response) {
			return true;
		};
		return $payment;
	}

	public static function formatCreditCard(ICreditCard $card)
	{

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

	public function processPayment($amount, ICreditCard $card, $details)
	{
		if (in_array($details['paymentBrand'], Synchronous::BRANDS)) {
			$data = new Synchronous();
			$data->set($amount, $card, $details);
		} elseif (in_array($details['paymentBrand'], Asynchronous::BRANDS)) {
			$data = new Asynchronous();
			$data->set($amount, $details);
		} else {
			throw new UnsupportedPaymentBrandException;
		}

		$data->setUserId($this->config['authentication']['userId'])
			->setPassword($this->config['authentication']['password'])
			->setEntityId($this->config['authentication']['entityId']);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->getRequestUrl());
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data->getInRequestFormat()));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$responseData = curl_exec($ch);
		if (curl_errno($ch)) {
			return curl_error($ch);
		}
		curl_close($ch);
		echo($responseData);
		return $responseData;
	}

	// TODO: async payment
//	public function checkoutAsyncPayment($resourcePath, $userId, $password, $entityId)
//	{
//		$url = $this->config['protocol'] . "://" . $this->config['host'] . $resourcePath . "?";
//		$url .= http_build_query([
//			'authentication.userId' => $this->config['userId'],
//			'authentication.password' => $this->config['password'],
//			'authentication.entityId' => $this->config['entityId']
//		]);
//
//		$ch = curl_init();
//		curl_setopt($ch, CURLOPT_URL, $url);
//		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
//		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//		$responseData = curl_exec($ch);
//		if(curl_errno($ch)) {
//			return curl_error($ch);
//		}
//		curl_close($ch);
//		return $responseData;
//	}

}

class UnsupportedPaymentBrandException extends \Exception
{

}