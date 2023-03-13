<?php

namespace FiberPay\SystemAML\RequestParams\Party;

class SoleProprietorshipPartyParams extends IndividualPartyParams
{
	private readonly string $taxIdNumber;
	private readonly string $nationalBusinessRegistryNumber;
	private readonly string $companyName;

	public function taxIdNumber(string $taxIdNumber): self
	{
		$this->taxIdNumber = $taxIdNumber;
		return $this;
	}

	public function nationalBusinessRegistryNumber(string $nationalBusinessRegistryNumber): self
	{
		$this->nationalBusinessRegistryNumber = $nationalBusinessRegistryNumber;
		return $this;
	}

	public function companyName(string $companyName): self
	{
		$this->companyName = $companyName;
		return $this;
	}

	public function toArray(): array
	{
		$data = [
			'taxIdNumber' => $this->taxIdNumber,
			'nationalBusinessRegistryNumber' => $this->nationalBusinessRegistryNumber,
			'companyName' => $this->companyName,
		];

		return array_merge(
			parent::toArray(),
			$data,
		);
	}
}
