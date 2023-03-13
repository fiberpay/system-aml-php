<?php

namespace FiberPay\SystemAML\RequestParams\Party;

interface PartyParams
{
	public function references(string $references);

	public function createdByName(string $createdByName);
	public function toArray(): array;
}
