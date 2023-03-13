<?php

namespace FiberPay\SystemAML;

use FiberPay\SystemAML\RequestParams\Party\PartyParams;
use FiberPay\SystemAML\RequestParams\Transaction\TransactionParams;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class SystemAMLClient
{
	private const PARTIES_URI = '/parties';
	private const TRANSACTIONS_URI = '/transactions';
	private readonly string $apiVersion;

	public function __construct(
		private readonly string $baseApiURL,
		private readonly string $apiKey,
		private readonly string $apiSecret,
	)
	{
		$this->apiVersion = '1.0';
	}

	/**
	 * @throws SystemAMLException
	 * @noinspection PhpUnused
	 */
	public function getParty(string $partyCode): array
	{
		$uri = self::PARTIES_URI . '/' . $partyCode;
		return $this->call(HttpMethod::GET, $uri);
	}

	/**
	 * @throws SystemAMLException
	 */
	public function createParty(PartyParams $request): array
	{
		return $this->call(HttpMethod::POST, self::PARTIES_URI, $request->toArray());
	}

	/**
	 * @throws SystemAMLException
	 */
	public function updateParty(string $partyCode, PartyParams $request): array
	{
		$uri = self::PARTIES_URI . '/' . $partyCode;
		return $this->call(HttpMethod::PUT, $uri, $request->toArray());
	}

	/**
	 * @throws SystemAMLException
	 */
	public function deleteParty(string $partyCode): array
	{
		$uri = self::PARTIES_URI . '/' . $partyCode;
		return $this->call(HttpMethod::DELETE, $uri);
	}

	/**
	 * @throws SystemAMLException
	 */
	public function createTransaction(TransactionParams $transactionParams): array
	{
		return $this->call(HttpMethod::POST, self::TRANSACTIONS_URI, $transactionParams->toArray());
	}

	/**
	 * @throws SystemAMLException
	 */
	private function call(HttpMethod $httpMethod, $uri, $body = [])
	{
		$curl = curl_init();

		$url = "$this->baseApiURL/$this->apiVersion$uri";
		curl_setopt($curl, CURLOPT_URL, $url);

		$headers = $this->createHeaders($httpMethod);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

		switch ($httpMethod) {
			case HttpMethod::POST:
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $this->createJWT($body));
				break;
			case HttpMethod::PUT:
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
				curl_setopt($curl, CURLOPT_POSTFIELDS, $this->createJWT($body));
				break;
			case HttpMethod::DELETE:
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
				break;
			case HttpMethod::GET:
				break;
		}

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		/** @var string|false $response */
		$response = curl_exec($curl);

		$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		if ($httpCode >= 500 || $response === false) {
			$errorMsg = curl_error($curl);
			throw new SystemAMLException($errorMsg, $httpCode);
		}

		if ($httpCode >= 400) {
			throw new SystemAMLException($response, $httpCode);
		}

		return json_decode($response, true);
	}

	private function createHeaders(HttpMethod $httpMethod): array
	{
		$headers = [
			'Content-Type: application/json',
			"Api-Key: $this->apiKey",
		];

		if ($httpMethod === HttpMethod::GET) {
			$token = $this->createJWT([]);
			$headers[] = "Authorization: Bearer $token";
		}
		return $headers;
	}

	private function createJWT($payload)
	{
		return JWT::encode($payload, $this->apiSecret, 'HS256');
	}

	public function decodeJWT(string $jwt): object
	{
		return JWT::decode($jwt, new Key($this->apiSecret, 'HS256'));
	}
}
