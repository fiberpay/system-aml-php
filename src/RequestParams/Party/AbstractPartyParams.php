<?php

namespace FiberPay\SystemAML\RequestParams\Party;

use FiberPay\SystemAML\PartyStatus;
use FiberPay\SystemAML\RequestParams\RequestParams;

abstract class AbstractPartyParams extends RequestParams
{
	private string $type;
	private readonly PartyStatus $status;

	public function __construct(string $type, PartyStatus $status)
	{
		$this->type = $type;
		$this->status = $status;
	}

	public function toArray(): array
	{
		$data = [
			'type' => $this->type,
			'status' => $this->status,
		];

		return array_merge(
			parent::toArray(),
			$data
		);
	}
}
