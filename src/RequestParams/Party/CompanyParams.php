<?php

namespace FiberPay\SystemAML\RequestParams\Party;

class CompanyParams
{
	private string $taxIdNumber;
	private string $nationalBusinessRegistryNumber;
	private string $companyName;

	public function __construct(string $taxIdNumber, string $nationalBusinessRegistryNumber, string $companyName)
	{
		$this->taxIdNumber = $taxIdNumber;
		$this->nationalBusinessRegistryNumber = $nationalBusinessRegistryNumber;
		$this->companyName = $companyName;
	}

	public function toArray(): array
	{
		return [
			'taxIdNumber' => $this->taxIdNumber,
			'nationalBusinessRegistryNumber' => $this->nationalBusinessRegistryNumber,
			'companyName' => $this->companyName,
		];
	}
}
