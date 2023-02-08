<?php

namespace FiberPay\SystemAML;

use Firebase\JWT\JWT;

/** @noinspection PhpUnused */
class SystemAMLClient
{
	private string $baseApiURL;
	private string $apiVersion = '1.0';
	private string $apiKey;
	private string $apiSecret;

	public function __construct($apiURL, $apiKey, $apiSecret)
	{
		$this->baseApiURL = $apiURL;
		$this->apiKey = $apiKey;
		$this->apiSecret = $apiSecret;
	}
	/**
	 * @throws SystemAMLException
	 * @noinspection PhpUnused
	 */
	public function getParty(): array
	{
		throw new \Exception('Not implemented');
		$uri = '/parties';
		$method = 'get';
		$data = [];

		return $this->call($method, $uri, $data);
	}

	/**
	 * @throws SystemAMLException
	 * @noinspection PhpUnused
	 */
	public function createParty(): array
	{
		throw new \Exception('Not implemented');
		$uri = '/parties';
		$method = 'post';
		$data = [];

		return $this->call($method, $uri, $data);
	}

	/**
	 * @throws SystemAMLException
	 * @noinspection PhpUnused
	 */
	public function updateParty(): array
	{
		throw new \Exception('Not implemented');
		$uri = '/parties';
		$method = 'put';
		$data = [];

		return $this->call($method, $uri, $data);
	}

	/**
	 * @throws SystemAMLException
	 * @noinspection PhpUnused
	 */
	public function deleteParty(): array
	{
		throw new \Exception('Not implemented');
		$uri = '/parties';
		$method = 'delete';
		$data = [];

		return $this->call($method, $uri, $data);
	}

	/**
	 * @throws SystemAMLException
	 * @noinspection PhpUnused
	 */
	public function createTransaction(): array
	{
		throw new \Exception("Not implemented");
		$uri = '/transactions';
		$method = 'post';
		$data = [];

		return $this->call($method, $uri, $data);
	}

	/**
	 * @throws SystemAMLException
	 */
	private function call($httpMethod, $uri, $body = null)
	{
		$curl = curl_init();

		$url = "$this->baseApiURL/$this->apiVersion$uri";
		curl_setopt($curl, CURLOPT_URL, $url);

		$headers = $this->createHeaders($httpMethod);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

		switch ($httpMethod) {
			case 'post':
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $this->createJWT($body));
				break;
			case 'put':
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
				curl_setopt($curl, CURLOPT_POSTFIELDS, $this->createJWT($body));
				break;
			case 'delete':
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
				break;
			default:
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

		return json_decode($response, true);
	}

	private function createHeaders(string $httpMethod): array
	{
		$headers = [
			'Content-Type: application/json',
			"Api-Key: $this->apiKey",
		];

		if ($httpMethod === 'get') {
			$token = $this->createJWT([]);
			$headers[] = "Authorization: Bearer $token";
		}
		return $headers;
	}

	private function createJWT($payload)
	{
		return JWT::encode($payload, $this->apiSecret, 'HS256');
	}
}
