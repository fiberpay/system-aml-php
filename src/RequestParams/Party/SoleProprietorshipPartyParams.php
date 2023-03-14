<?php

namespace FiberPay\SystemAML\RequestParams\Party;

use FiberPay\SystemAML\PartyType;

class SoleProprietorshipPartyParams extends AbstractPartyParams
{
	protected PartyType $type = PartyType::SOLE_PROPRIETORSHIP;
	private IndividualPartyParams $individualParams;
	private CompanyParams $companyParams;
	private ?AddressParams $businessAddress = null;

	public function __construct(IndividualPartyParams $individualParams, CompanyParams $companyParams)
	{
		$this->individualParams = $individualParams;
		$this->companyParams = $companyParams;
		$this->status = $individualParams->status;
	}

	public function businessAddress(AddressParams $businessAddress): self
	{
		$this->businessAddress = $businessAddress;
		return $this;
	}

	public function toArray(): array
	{
		$data = array_merge(
			$this->individualParams->toArray(),
			$this->companyParams->toArray(),
			parent::toArray(),
		);

		if (isset($this->businessAddress)) {
			$data['businessAddress'] = $this->businessAddress->toArray();
		}

		return $data;
	}
}
