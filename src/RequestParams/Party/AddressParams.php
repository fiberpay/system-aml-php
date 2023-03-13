<?php

namespace FiberPay\SystemAML\RequestParams\Party;

class AddressParams
{
	private ?string $country = null;
	private ?string $city = null;
	private ?string $street = null;
	private ?string $houseNumber = null;
	private ?string $flatNumber = null;
	private ?string $postalCode = null;

	public function country(?string $country): self
	{
		$this->country = $country;
		return $this;
	}

	public function city(?string $city): self
	{
		$this->city = $city;
		return $this;
	}

	public function street(?string $street): self
	{
		$this->street = $street;
		return $this;
	}

	public function houseNumber(?string $houseNumber): self
	{
		$this->houseNumber = $houseNumber;
		return $this;
	}

	public function flatNumber(?string $flatNumber): self
	{
		$this->flatNumber = $flatNumber;
		return $this;
	}

	public function postalCode(?string $postalCode): self
	{
		$this->postalCode = $postalCode;
		return $this;
	}

	public function toArray(): ?array
	{
		$hasAttributes = $this->country
			|| $this->city
			|| $this->street
			|| $this->houseNumber
			|| $this->flatNumber
			|| $this->postalCode;

		if ($hasAttributes) {
			return [
				'country' => $this->country,
				'city' => $this->city,
				'street' => $this->street,
				'houseNumber' => $this->houseNumber,
				'flatNumber' => $this->flatNumber,
				'postalCode' => $this->postalCode,
			];
		}

		return null;
	}
}
