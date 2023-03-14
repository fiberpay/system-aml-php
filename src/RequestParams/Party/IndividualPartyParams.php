<?php

namespace FiberPay\SystemAML\RequestParams\Party;

use DateTimeImmutable;
use FiberPay\SystemAML\PartyStatus;
use FiberPay\SystemAML\PartyType;

class IndividualPartyParams extends AbstractPartyParams
{
	protected PartyType $type = PartyType::INDIVIDUAL;
	private ?string $personalIdentityNumber;
	private bool $withoutExpirationDate;
	private ?string $citizenship = null;
	private ?string $birthCity = null;
	private ?string $birthCountry = null;
	private ?string $birthDate = null;
	private ?AddressParams $accommodationAddress = null;
	private ?AddressParams $forwardAddress = null;

	public function __construct(
		PartyStatus                         $status,
		private readonly string             $firstName,
		private readonly string             $lastName,
		private readonly string             $documentType,
		private readonly string             $documentNumber,
		private readonly ?DateTimeImmutable $documentExpirationDate,
		private readonly bool               $politicallyExposed,
	)
	{
		$this->status = $status;
		$this->withoutExpirationDate = !isset($this->documentExpirationDate);
	}

	public function personalIdentityNumber(string $personalIdentityNumber): self
	{
		$this->personalIdentityNumber = $personalIdentityNumber;
		return $this;
	}

	public function citizenship(string $citizenship): self
	{
		$this->citizenship = $citizenship;
		return $this;
	}

	public function birthCity(string $birthCity): self
	{
		$this->birthCity = $birthCity;
		return $this;
	}

	public function birthCountry(string $birthCountry): self
	{
		$this->birthCountry = $birthCountry;
		return $this;
	}

	public function birthDate(string $birthDate): self
	{
		$this->birthDate = $birthDate;
		return $this;
	}

	public function accommodationAddress(AddressParams $accommodationAddress): self
	{
		$this->accommodationAddress = $accommodationAddress;
		return $this;
	}

	public function forwardAddress(AddressParams $forwardAddress): self
	{
		$this->forwardAddress = $forwardAddress;
		return $this;
	}

	public function toArray(): array
	{
		$data = [
			'firstName' => $this->firstName,
			'lastName' => $this->lastName,
			'personalIdentityNumber' => $this->personalIdentityNumber,
			'documentType' => $this->documentType,
			'documentNumber' => $this->documentNumber,
			'documentExpirationDate' => $this->documentExpirationDate?->format('Y-m-d'),
			'citizenship' => $this->citizenship,
			'birthCity' => $this->birthCity,
			'birthCountry' => $this->birthCountry,
			'politicallyExposed' => $this->politicallyExposed,
			'withoutExpirationDate' => $this->withoutExpirationDate,
			'birthDate' => $this->birthDate,
		];

		if ($this->accommodationAddress) $data['accommodationAddress'] = $this->accommodationAddress->toArray();
		if ($this->forwardAddress) $data['forwardAddress'] = $this->forwardAddress->toArray();

		return array_merge(
			parent::toArray(),
			$data,
		);
	}
}
