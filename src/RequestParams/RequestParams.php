<?php

namespace FiberPay\SystemAML\RequestParams;

abstract class RequestParams
{
	private ?string $references;
	private ?string $createdByName;

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

	protected function toArray(): array {
		return [
			'references' => $this->references,
			'createdByName' => $this->createdByName,
		];
	}
}
