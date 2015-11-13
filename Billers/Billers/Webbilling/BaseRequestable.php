<?php
namespace Billers\Webbilling;
use Billers\PayON\Data\Exceptions\NotExistingGetterException;
use Billers\PayON\Data\Exceptions\RequiredColumnValueCannotBeNullException;
use Nette\Utils\Callback;


/**
 *
 *
 * @author Kenny
 * @package Billers\Webbilling
 */
abstract class BaseRequestable
{
	public function getRequest(array $requiredParameters){
		$data = [];
		foreach($requiredParameters as $parameter){
			$data[$parameter] = $this->invokeGetter($parameter);
		}

		return Array2XML::createXML('DirectDebitData', $data)->saveXML();
	}

	public function invokeGetter($propertyName){
		$getterName = ['get' . ucfirst($propertyName), 'is' . ucfirst($propertyName)];
		$value = null;
		foreach ($getterName as $getter) {
			if (method_exists($this, $getter)) {
				$value = Callback::invoke([$this, $getter]);
				if ($value === null) {
					throw new RequiredColumnValueCannotBeNullException;
				}
				return $value;
			}
		}

		throw new NotExistingGetterException("Getter for property " . $propertyName . " doesn't exist");
	}
}