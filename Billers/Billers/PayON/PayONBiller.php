<?php
namespace Billers\PayON;

use CzechCash\Billers\Billers\BaseBiller;
use CzechCash\Billers\Interfaces\IAsyncBiller;
use CzechCash\Billers\Structures\Exceptions\CheckoutFailedException;
use CzechCash\Billers\Structures\Exceptions\CheckoutNotExistException;
use CzechCash\Billers\Structures\Exceptions\PaymentStatusNotResponseException;
use Tracy\Debugger;

/**
 *
 *
 * @author Kenny
 * @package Billers\PayON
 */
class PayONBiller extends BaseBiller implements IAsyncBiller
{
	protected $configFile = __DIR__ . '/config/payOn.neon';

	const STATUS_CHECKOUT_SUCCESS = "000.200.100",
		STATUS_PAYMENT_SUCCESS = "000.100.110";

	/**
	 * @inheritDoc
	 */
	public function isServiceAvailable()
	{
		exec(sprintf('ping -c 1 -W 5 %s', escapeshellarg($this->config['host'])), $res, $rval);
		return $rval === 0;
	}

	public function createCheckout($amount, $currency)
	{
		$requestFields = $this->getAuthentication();
		$requestFields['amount'] = $amount;
		$requestFields['currency'] = $currency;
		$requestFields['paymentType'] = "PA";

		$url = join("/", [$this->getRequestUrl(), $this->config['checkoutUrl']]);

		$response = $this->sendRequest($url, $requestFields);

		if ($response !== null && $response->result->code === self::STATUS_CHECKOUT_SUCCESS) {
			$this->paymentSection->order = $response;
			Debugger::barDump($response, 'response');
			Debugger::barDump($response->id, 'response id');
			return $response->id;
		} else {
			throw new CheckoutFailedException;
		}
	}

	public function checkPaymentStatus()
	{

		if ($this->paymentSection->order !== null && isset($this->paymentSection->order->id)) {
			$url = join("/", [$this->getRequestUrl(),
				$this->config['checkoutUrl'],
				$this->paymentSection->order->id, 'payment']);
		} else {
			throw new CheckoutNotExistException;
		}
		$requestFields = $this->getAuthentication();
		$response = $this->sendRequest($url, $requestFields, true);

		if ($response !== null && isset($response->result->code)) {
			return $response->result->code === self::STATUS_PAYMENT_SUCCESS;
		} else {
			throw new PaymentStatusNotResponseException;
		}
	}

	private function getAuthentication()
	{
		return [
			"authentication.userId" => $this->config['authentication']['userId'],
			"authentication.password" => $this->config['authentication']['password'],
			"authentication.entityId" => $this->config['authentication']['entityId']
		];
	}

	private function getRequestUrl()
	{
		$url = $this->config['protocol'] . "://" . $this->config['host'];
		return join("/", [
			$url,
			$this->config['apiVersion'],
		]);
	}

	private function sendRequest($url, $field, $methodGet = false)
	{
		$ch = curl_init();
		if($methodGet !== false){
			$url .= "?" . http_build_query($field);
			Debugger::barDump($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		}else{
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($field));
		}
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$responseData = curl_exec($ch);
		if (curl_errno($ch)) {
			return curl_error($ch);
		}
		curl_close($ch);

		if ($responseData !== null) {
			return json_decode($responseData);
		}
	}

}