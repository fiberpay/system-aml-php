<?php

namespace FiberPay\SystemAML;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Log;

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
	 * @return array
	 * @throws SystemAMLException
	 */
	public function createIndividualParty(
		bool   $isDraft,
		string $refID = null,
		string $firstName = null,
		string $lastName = null,
		string $personalIdentityNumber = null,
		string $documentType = null,
		string $documentNumber = null,
		string $documentExpirationDate = null,
		bool   $withoutExpirationDate = null,
		string $citizenship = null,
		string $birthCity = null,
		string $birthCountry = null,
		bool   $politicallyExposed = null,
		string $birthDate = null,
		string $createdByName = null,
		string $accommodationAddressCountry = null,
		string $accommodationAddressCity = null,
		string $accommodationAddressStreet = null,
		string $accommodationAddressHouseNumber = null,
		string $accommodationAddressFlatNumber = null,
		string $accommodationAddressPostalCode = null,
		string $forwardAddressCountry = null,
		string $forwardAddressCity = null,
		string $forwardAddressStreet = null,
		string $forwardAddressHouseNumber = null,
		string $forwardAddressFlatNumber = null,
		string $forwardAddressPostalCode = null,
	): array
	{
		$data = [
			'type' => 'individual',
			'firstName' => $firstName,
			'lastName' => $lastName,
			'personalIdentityNumber' => $personalIdentityNumber,
			'documentType' => $documentType,
			'documentNumber' => $documentNumber,
			'documentExpirationDate' => $documentExpirationDate,
			'citizenship' => $citizenship,
			'birthCity' => $birthCity,
			'birthCountry' => $birthCountry,
			'politicallyExposed' => $politicallyExposed,
			'withoutExpirationDate' => $withoutExpirationDate,
			'birthDate' => $birthDate,
			'references' => $refID,
			'createdByName' => $createdByName,
		];

		if ($isDraft) {
			$data['status'] = 'draft';
		}

		$accommodationAddress = [
			'country' => $accommodationAddressCountry,
			'city' => $accommodationAddressCity,
			'street' => $accommodationAddressStreet,
			'houseNumber' => $accommodationAddressHouseNumber,
			'flatNumber' => $accommodationAddressFlatNumber,
			'postalCode' => $accommodationAddressPostalCode,
		];

		$hasAccommodationAddress = !empty(array_filter(array_values($accommodationAddress)));
		if ($hasAccommodationAddress) {
			$data['accommodationAddress'] = $accommodationAddress;
		}

		$forwardAddress = [
			'country' => $forwardAddressCountry,
			'city' => $forwardAddressCity,
			'street' => $forwardAddressStreet,
			'houseNumber' => $forwardAddressHouseNumber,
			'flatNumber' => $forwardAddressFlatNumber,
			'postalCode' => $forwardAddressPostalCode,
		];

		$hasForwardAddress = !empty(array_filter(array_values($forwardAddress)));
		if ($hasForwardAddress) {
			$data['forwardAddress'] = $forwardAddress;
		}

		return $this->createParty($data);
	}

	/**
	 * @throws SystemAMLException
	 * @noinspection PhpUnused
	 */
	private function createParty($data): array
	{
		$uri = '/parties';
		$method = 'post';

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
	 * @return array
	 * @throws SystemAMLException
	 * @noinspection PhpUnused
	 */
	public function createTransaction(
		bool            $isDraft,
		bool            $isOccasional,
		TransactionType $type,
		string          $amount,
		Currency        $currency,
		                $bookedAt,
		                $location = null,
		                $description = null,
		                $references = null,
		                $paymentMethod = null,
		                $senderIban = null,
		                $senderCode = null,
		                $senderFirstName = null,
		                $senderLastName = null,
		                $senderCompanyName = null,
		                $receiverIban = null,
		                $receiverCode = null,
		                $receiverFirstName = null,
		                $receiverLastName = null,
		                $receiverCompanyName = null,
		                $createdByName = null,
	): array
	{
		$data = [
			'occasional_transaction' => $isOccasional,
			'type' => $type,
			'status' => $isDraft ? TransactionStatus::DRAFT : TransactionStatus::NEW,
			'amount' => $amount,
			'currency' => $currency,
			'bookedAt' => $bookedAt,
			'location' => $location,
			'description' => $description,
			'references' => $references,
			'paymentMethod' => $paymentMethod,
			'senderFirstName' => $senderFirstName,
			'senderLastName' => $senderLastName,
			'senderCompanyName' => $senderCompanyName,
			'senderCode' => $senderCode,
			'senderIban' => $senderIban,
			'receiverFirstName' => $receiverFirstName,
			'receiverLastName' => $receiverLastName,
			'receiverCompanyName' => $receiverCompanyName,
			'receiverCode' => $receiverCode,
			'receiverIban' => $receiverIban,
			'createdByName' => $createdByName,
		];

		$uri = '/transactions';
		$method = 'post';

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

		if ($httpCode >= 400) {
			throw new SystemAMLException($response, $httpCode);
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

	/** @noinspection PhpUnused */
	public function decodeJWT(string $jwt): object
	{
		return JWT::decode($jwt, new Key($this->apiSecret, 'HS256'));
	}
}
