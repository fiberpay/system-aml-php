<?php

namespace FiberPay\SystemAML\RequestParams\Party;

use FiberPay\SystemAML\PartyStatus;
use FiberPay\SystemAML\PartyType;

class CompanyPartyParams extends AbstractPartyParams
{
	protected PartyType $type = PartyType::COMPANY;

	private CompanyParams $companyParams;
	private ?AddressParams $businessAddress = null;

	public function __construct(
		PartyStatus $status,
		CompanyParams $companyParams)
	{
		$this->status = $status;
		$this->companyParams = $companyParams;
	}

	public function businessAddress(AddressParams $businessAddress): self
	{
		$this->businessAddress = $businessAddress;
		return $this;
	}

	public function toArray(): array
	{
		$data = array_merge(
			$this->companyParams->toArray(),
			parent::toArray(),
		);

		if (isset($this->businessAddress)) {
			$data['businessAddress'] = $this->businessAddress->toArray();
		}

		return $data;
	}
}
