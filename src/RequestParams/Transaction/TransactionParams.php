<?php

namespace FiberPay\SystemAML\RequestParams\Transaction;

use DateTimeImmutable;
use FiberPay\SystemAML\Currency;
use FiberPay\SystemAML\RequestParams\RequestParams;
use FiberPay\SystemAML\TransactionStatus;
use FiberPay\SystemAML\TransactionType;

class TransactionParams extends RequestParams
{
	private ?string $location = null;
	private ?string $description = null;
	private bool $isOccasional = false;
	private ?string $senderIban = null;
	private ?string $senderCode = null;
	private ?string $senderFirstName = null;
	private ?string $senderLastName = null;
	private ?string $senderCompanyName = null;
	private ?string $receiverIban = null;
	private ?string $receiverCode = null;
	private ?string $receiverFirstName = null;
	private ?string $receiverLastName = null;
	private ?string $receiverCompanyName = null;

	public function __construct(
		private readonly TransactionStatus $status,
		private readonly TransactionType   $type,
		private readonly string            $amount,
		private readonly Currency          $currency,
		private readonly DateTimeImmutable $bookedAt,
		private readonly ?string           $paymentMethod,
	)
	{
	}

	public function location(?string $location): self
	{
		$this->location = $location;
		return $this;
	}

	public function description(?string $description): self
	{
		$this->description = $description;
		return $this;
	}

	public function isOccasional(bool $isOccasional): self
	{
		$this->isOccasional = $isOccasional;
		return $this;
	}

	public function senderIban(?string $senderIban): self
	{
		$this->senderIban = $senderIban;
		return $this;
	}

	public function senderCode(?string $senderCode): self
	{
		$this->senderCode = $senderCode;
		return $this;
	}

	public function senderFirstName(?string $senderFirstName): self
	{
		$this->senderFirstName = $senderFirstName;
		return $this;
	}

	public function senderLastName(?string $senderLastName): self
	{
		$this->senderLastName = $senderLastName;
		return $this;
	}

	public function senderCompanyName(?string $senderCompanyName): self
	{
		$this->senderCompanyName = $senderCompanyName;
		return $this;
	}

	public function receiverIban(?string $receiverIban): self
	{
		$this->receiverIban = $receiverIban;
		return $this;
	}

	public function receiverCode(?string $receiverCode): self
	{
		$this->receiverCode = $receiverCode;
		return $this;
	}

	public function receiverFirstName(?string $receiverFirstName): self
	{
		$this->receiverFirstName = $receiverFirstName;
		return $this;
	}

	public function receiverLastName(?string $receiverLastName): self
	{
		$this->receiverLastName = $receiverLastName;
		return $this;
	}

	public function receiverCompanyName(?string $receiverCompanyName): self
	{
		$this->receiverCompanyName = $receiverCompanyName;
		return $this;
	}

	public function toArray(): array
	{
		$data = [
			'occasionalTransaction' => $this->isOccasional,
			'type' => $this->type->value,
			'status' => $this->status->value,
			'amount' => $this->amount,
			'currency' => $this->currency->value,
			'bookedAt' => $this->bookedAt->format('c'),
			'location' => $this->location,
			'description' => $this->description,
			'paymentMethod' => $this->paymentMethod,
			'senderFirstName' => $this->senderFirstName,
			'senderLastName' => $this->senderLastName,
			'senderCompanyName' => $this->senderCompanyName,
			'senderCode' => $this->senderCode,
			'senderIban' => $this->senderIban,
			'receiverFirstName' => $this->receiverFirstName,
			'receiverLastName' => $this->receiverLastName,
			'receiverCompanyName' => $this->receiverCompanyName,
			'receiverCode' => $this->receiverCode,
			'receiverIban' => $this->receiverIban,
		];

		return array_merge(
			parent::toArray(),
			$data
		);
	}
}
