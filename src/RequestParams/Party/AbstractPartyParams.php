<?php

namespace FiberPay\SystemAML\RequestParams\Party;

use FiberPay\SystemAML\PartyStatus;
use FiberPay\SystemAML\PartyType;
use FiberPay\SystemAML\RequestParams\RequestParams;

abstract class AbstractPartyParams extends RequestParams
{
	protected PartyType $type;
	protected PartyStatus $status;

	public function toArray(): array
	{
		$data = [
			'type' => $this->type->value,
			'status' => $this->status->value,
		];

		return array_merge(
			parent::toArray(),
			$data
		);
	}
}
