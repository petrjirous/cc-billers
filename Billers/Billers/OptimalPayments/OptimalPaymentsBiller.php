<?php
namespace Billers\OptimalPayments;

use CzechCash\Billers\Billers\BaseBiller;
use CzechCash\Billers\Interfaces\IAsyncBiller;
use CzechCash\Billers\Structures\Exceptions\CheckoutFailedException;
use CzechCash\Billers\Structures\Exceptions\CheckoutNotExistException;
use CzechCash\Billers\Structures\Exceptions\PaymentStatusNotResponseException;
use Nette\Utils\Random;
use OptimalPayments\Environment;
use OptimalPayments\HostedPayment\Order;
use OptimalPayments\OptimalApiClient;
use Tracy\Debugger;


/**
 *
 *
 * @author Kenny
 * @package Billers\OptimalPayments
 */
class OptimalPaymentsBiller extends BaseBiller implements IAsyncBiller
{
	const PAYMENTMETHOD_CARD = "card",
		PAYMENTMETHOD_GIROPAY = "giropay",
		PAYMENTMETHOD_IDEAL = "ideal",
		PAYMENTMETHOD_INTERAC = "interac",
		PAYMENTMETHOD_MASTERPASS = "masterpass",
		PAYMENTMETHOD_NETELLER = "neteller",
		PAYMENTMETHOD_PAYNEARME = "paynearme",
		PAYMENTMETHOD_PAYPAL = "paypal",
		PAYMENTMETHOD_PINGIT = "pingit",
		PAYMENTMETHOD_POLI = "poli",
		PAYMENTMETHOD_PREPAIDCARD = "prepaidcard",
		PAYMENTMETHOD_SOFORTBANKING = "sofortbanking",
		PAYMENTMETHOD_UKASH = "ukash";

	const STATUS_SUCCESS = "success",
		STATUS_CANCELLED = "cancelled",
		STATUS_DECLINED = "declined",
		STATUS_PENDING = "pending",
		STATUS_ABANDONED = "abandoned",
		STATUS_HELD = "held",
		STATUS_ERRORED = "errored";

	protected $configFile = __DIR__ . '/config/optimalPayments.neon';

	protected $client;

	public function __construct()
	{
		parent::__construct();

		$this->client = new OptimalApiClient($this->config['apiKey'], $this->config['apiSecret'], Environment::TEST, $this->config['accountID']);
	}

	/**
	 * @inheritDoc
	 */
	public function isServiceAvailable()
	{
		return $this->client->cardPaymentService()->monitor();
	}

	public function createCheckout($amount, $currency)
	{
		$order = new Order([
			'merchantRefNum' => Random::generate(10, '0-9A-Z'), // TODO nezapomenout nastavit na real merchant number
			'currencyCode' => $currency,
			'totalAmount' => (int)($amount * 100),
			'paymentMethod' => [self::PAYMENTMETHOD_CARD]
			//TODO add users IP
		]);

		$response = $this->client->hostedPaymentService()->processOrder($order);

		if ($response !== null) {
			$this->paymentSection->order = $response;
			foreach ($response->link as $link) {
				if ($link->rel === "hosted_payment" && $link->uri !== null) {
					$this->response->redirect($link->uri);
					break;
				}
			}
			throw new CheckoutFailedException;
		}

		return $response;
	}

	public function checkPaymentStatus()
	{
		if ($this->paymentSection->order !== null && isset($this->paymentSection->order->id)) {
			$order = $this->client->hostedPaymentService()->getOrder(new Order([
				'id' => $this->paymentSection->order->id
			]));
		} else {
			throw new CheckoutNotExistException;
		}
		if ($order !== null && isset($order->transaction) && isset($order->transaction->status)) {
			unset($this->paymentSection->order);
			return $order->transaction->status === self::STATUS_SUCCESS;
		}else{
			throw new PaymentStatusNotResponseException;
		}
	}
}