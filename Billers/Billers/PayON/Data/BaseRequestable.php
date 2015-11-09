<?php
namespace Billers\PayON\Data;

use Billers\PayON\Data\Exceptions\ArrayMustContainObjectsOfCustomParameterException;
use Billers\PayON\Data\Exceptions\NotExistingGetterException;
use Billers\PayON\Data\Exceptions\RequiredColumnValueCannotBeNullException;
use Nette\Utils\Callback;
use Tracy\Debugger;


/**
 *
 *
 * @author Kenny
 * @package Billers\PayON\BankTransfer
 */
abstract class BaseRequestable
{

	public function getRequest(array $requiredColumns)
	{
		$data = [];

		foreach ($requiredColumns as $col) {
			$params = explode('.', $col);
			if (count($params) == 1) {
				$value = $this->invokeGetter($this, $params[0]);
				if(is_array($value)){
					foreach($value as $val){
						if($val instanceof CustomParameter){
							$key = lcfirst($col) . "[" . $val->getName() . "]";
							$data[$key] = $val->getValue();
						}else{
							throw new ArrayMustContainObjectsOfCustomParameterException;
						}
					}
					continue;
				}
				$data[$col] = $value;
			} elseif (count($params) > 1) {
				$lastClass = null;

				for ($i = 0; $i < count($params); $i++) {

					$param = $params[$i];
					if (preg_match('/^([a-zA-Z0-9_]+)%i%$/', $param, $parts)) {
						$param = $parts[1];
						$iterable = $this->invokeGetter(($lastClass === null ? $this : $lastClass), $param);
						for ($j = 0; $j < count($iterable); $j++) {
							$key = lcfirst(str_replace('%i%', "[$j]", $col));
							$data[$key] = $this->invokeGetter($iterable[$j], $params[$i + 1]);
						}
						continue 2;
					}

					if ($lastClass === null) {
						$lastClass = $this->invokeGetter($this, $param);
						continue;
					} else {
						$lastClass = $this->invokeGetter($lastClass, $param);
					}

					if ($i == count($params) - 1) {
						$data[lcfirst($col)] = ucfirst($lastClass);
					}
				}
			}
		}

		return $data;
	}

	private function invokeGetter($class, $propertyName)
	{
		$getterName = ['get' . ucfirst($propertyName), 'is' . ucfirst($propertyName)];
		$value = null;
		foreach ($getterName as $getter) {
			if (method_exists($class, $getter)) {
				$value = Callback::invoke([$class, $getter]);
				if ($value === null) {
					throw new RequiredColumnValueCannotBeNullException;
				}
				return $value;
			}
		}

		throw new NotExistingGetterException("Getter for property " . $propertyName . " doesn't exist");
	}
}