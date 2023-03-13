<?php

namespace FiberPay\SystemAML\RequestParams;

use FiberPay\SystemAML\RequestParams\Party\PartyParams;

abstract class RequestParams implements PartyParams
{
	private ?string $references = null;
	private ?string $createdByName = null;

	public function references(?string $references): self
	{
		$this->references = $references;
		return $this;
	}

	public function createdByName(?string $createdByName): self
	{
		$this->createdByName = $createdByName;
		return $this;
	}

	public function toArray(): array {
		return [
			'references' => $this->references,
			'createdByName' => $this->createdByName,
		];
	}
}
