<?php

namespace FiberPay\SystemAML;

use Exception;

class SystemAMLException extends Exception
{
	private int $httpStatusCode;

	public function __construct(string $message, ?int $httpStatusCode = 500)
	{
		parent::__construct($message);
		$this->httpStatusCode = $httpStatusCode;
	}

	/**
	 * @noinspection PhpUnused
	 */
	public function getHttpStatusCode(): ?int
	{
		return $this->httpStatusCode;
	}
}
