<?php

namespace FiberPay\SystemAML;

use FiberPay\SystemAML\RequestParams\Party\PartyParams;
use FiberPay\SystemAML\RequestParams\Constants\HttpMethod;
use FiberPay\SystemAML\RequestParams\Party\PartyType;
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
	 */
	public function createIndividualParty($status, $firstName, $lastName, $politicallyExposed,
										 $politicallyExposedFamily, $politicallyExposedCoworker,
	 									 $personalIdentityNumber = null, $birthDate = null,
										 $birthCountry = null, $references = null, $citizenship = null,
										 $birthCity = null, $documentType = null, $documentNumber = null,
										 $documentExpirationDate = null, $createdByName = null, $withoutExpirationDate = null,
										 $accommodationCountry = null, $accommodationCity = null, $accommodationStreet = null,
										 $accommodationHouseNumber = null, $accommodationFlatNumber = null,
										 $accommodationPostalCode = null, $forwardCountry = null, $forwardCity = null,
										 $forwardStreet = null, $forwardHouseNumber = null, $forwardFlatNumber = null,
										 $forwardPostalCode = null, $personalEmailAdress = null,
										 $personalPhoneCountry = null, $personalPhoneNumber = null
										 ): array {
		$partyParams = [
			"type" => PartyType::INDIVIDUAL,
			"status" => $status,
			"firstName" => $firstName,
			"lastName" => $lastName,
			"politicallyExposed" => $politicallyExposed,
			"politicallyExposedFamily" => $politicallyExposedFamily,
			"politicallyExposedCoworker" => $politicallyExposedCoworker,
		];
		if ($personalIdentityNumber) {
			$partyParams["personalIdentityNumber"] = $personalIdentityNumber;
		}
		if ($birthDate) {
			$partyParams["birthDate"] = $birthDate;
		}
		if ($birthCountry) {
			$partyParams["birthCountry"] = $birthCountry;
		}
		if ($citizenship) {
			$partyParams["citizenship"] = $citizenship;
		}
		if ($references) {
			$partyParams["references"] = $references;
		}
		if ($birthCity) {
			$partyParams["birthCity"] = $birthCity;
		}
		if ($documentType) {
			$partyParams["documentType"] = $documentType;
		}
		if ($documentNumber) {
			$partyParams["documentNumber"] = $documentNumber;
		}
		if ($documentExpirationDate) {
			$partyParams["documentExpirationDate"] = $documentExpirationDate;
		}
		if ($withoutExpirationDate) {
			$partyParams["withoutExpirationDate"] = $withoutExpirationDate;
		}
		if ($accommodationCountry || $accommodationCity || $accommodationStreet ||
			$accommodationHouseNumber || $accommodationFlatNumber || $accommodationPostalCode) {
			$partyParams["accommodationAddress"] = [
				"country" => $accommodationCountry,
				"city" => $accommodationCity,
				"street" => $accommodationStreet,
				"houseNumber" => $accommodationHouseNumber,
				"flatNumber" => $accommodationFlatNumber,
				"postalCode" => $accommodationPostalCode,
			];
		}
		if ($forwardCountry || $forwardCity || $forwardStreet ||
			$forwardHouseNumber || $forwardFlatNumber || $forwardPostalCode) {
			$partyParams["forwardAddress"] = [
				"country" => $forwardCountry,
				"city" => $forwardCity,
				"street" => $forwardStreet,
				"houseNumber" => $forwardHouseNumber,
				"flatNumber" => $forwardFlatNumber,
				"postalCode" => $forwardPostalCode,
			];
		}
		if ($personalEmailAdress || $personalPhoneCountry || $personalPhoneNumber) {
			$partyParams["personalContact"] = [
				"emailAdress" => $personalEmailAdress,
				"phoneCountry" => $personalPhoneCountry,
				"phoneNumber" => $personalPhoneNumber,
			];
		}
		if ($createdByName) {
			$partyParams["createdByName"] = $createdByName;
		}
		return $this->call(HttpMethod::POST, self::PARTIES_URI, $partyParams);
	}
	public function createSoleProprietorshipParty($status, $firstName, $lastName, $politicallyExposed,
										 $politicallyExposedFamily, $politicallyExposedCoworker,
										 $taxIdNumber, $companyName, $mainPkdCode = null, $mainPkdName = null,
										 $registrationCountry = null, $pkdCodes = [],
										 $companyIdentifier = null, $nationalBusinessRegistryNumber = null, $tradeNames = null,
										 $personalIdentityNumber = null, $birthDate = null,
										 $birthCountry = null, $references = null, $citizenship = null,
										 $birthCity = null, $documentType = null, $documentNumber = null,
										 $documentExpirationDate = null, $createdByName = null, $withoutExpirationDate = null,
										 $accommodationCountry = null, $accommodationCity = null, $accommodationStreet = null,
										 $accommodationHouseNumber = null, $accommodationFlatNumber = null,
										 $accommodationPostalCode = null, $forwardCountry = null, $forwardCity = null,
										 $forwardStreet = null, $forwardHouseNumber = null, $forwardFlatNumber = null,
										 $forwardPostalCode = null, $businessCountry = null, $businessCity = null,
										 $businessStreet = null, $businessHouseNumber = null, $businessFlatNumber = null,
										 $businessPostalCode = null, $personalEmailAdress = null,
										 $personalPhoneCountry = null, $personalPhoneNumber = null, $companyEmailAdress = null,
										 $companyPhoneCountry = null, $companyPhoneNumber = null
										 ): array {
		$partyParams = [
			"type" => PartyType::SOLE_PROPRIETORSHIP,
			"status" => $status,
			"firstName" => $firstName,
			"lastName" => $lastName,
			"politicallyExposed" => $politicallyExposed,
			"politicallyExposedFamily" => $politicallyExposedFamily,
			"politicallyExposedCoworker" => $politicallyExposedCoworker,
			"taxIdNumber" => $taxIdNumber,
			"companyName" => $companyName,
		];
		if ($mainPkdCode || $mainPkdName) {
			$partyParams["mainPkdCode"] = [
				"pkdCode" => $mainPkdCode,
				"pkdName" => $mainPkdName,
			];
		}
		if ($pkdCodes) {
			$partyParams["pkdCodes"] = $pkdCodes;
		}
		if ($tradeNames) {
			$partyParams["tradeNames"] = $tradeNames;
		}
		if ($companyIdentifier) {
			$partyParams["companyIdentifier"] = $companyIdentifier;
		}
		if ($nationalBusinessRegistryNumber) {
			$partyParams["nationalBusinessRegistryNumber"] = $nationalBusinessRegistryNumber;
		}
		if ($registrationCountry) {
			$partyParams["registrationCountry"] = $registrationCountry;
		}
		if ($personalIdentityNumber) {
			$partyParams["personalIdentityNumber"] = $personalIdentityNumber;
		}
		if ($birthDate) {
			$partyParams["birthDate"] = $birthDate;
		}
		if ($birthCountry) {
			$partyParams["birthCountry"] = $birthCountry;
		}
		if ($citizenship) {
			$partyParams["citizenship"] = $citizenship;
		}
		if ($references) {
			$partyParams["references"] = $references;
		}
		if ($birthCity) {
			$partyParams["birthCity"] = $birthCity;
		}
		if ($documentType) {
			$partyParams["documentType"] = $documentType;
		}
		if ($documentNumber) {
			$partyParams["documentNumber"] = $documentNumber;
		}
		if ($documentExpirationDate) {
			$partyParams["documentExpirationDate"] = $documentExpirationDate;
		}
		if ($withoutExpirationDate) {
			$partyParams["withoutExpirationDate"] = $withoutExpirationDate;
		}
		if ($accommodationCountry || $accommodationCity || $accommodationStreet ||
			$accommodationHouseNumber || $accommodationFlatNumber || $accommodationPostalCode) {
			$partyParams["accommodationAddress"] = [
				"country" => $accommodationCountry,
				"city" => $accommodationCity,
				"street" => $accommodationStreet,
				"houseNumber" => $accommodationHouseNumber,
				"flatNumber" => $accommodationFlatNumber,
				"postalCode" => $accommodationPostalCode,
			];
		}
		if ($forwardCountry || $forwardCity || $forwardStreet ||
			$forwardHouseNumber || $forwardFlatNumber || $forwardPostalCode) {
			$partyParams["forwardAddress"] = [
				"country" => $forwardCountry,
				"city" => $forwardCity,
				"street" => $forwardStreet,
				"houseNumber" => $forwardHouseNumber,
				"flatNumber" => $forwardFlatNumber,
				"postalCode" => $forwardPostalCode,
			];
		}
		if ($businessCountry || $businessCity || $businessStreet ||
			$businessHouseNumber || $businessFlatNumber || $businessPostalCode) {
			$partyParams["businessAddress"] = [
				"country" => $businessCountry,
				"city" => $businessCity,
				"street" => $businessStreet,
				"houseNumber" => $businessHouseNumber,
				"flatNumber" => $businessFlatNumber,
				"postalCode" => $businessPostalCode,
			];
		}
		if ($personalEmailAdress || $personalPhoneCountry || $personalPhoneNumber) {
			$partyParams["personalContact"] = [
				"emailAdress" => $personalEmailAdress,
				"phoneCountry" => $personalPhoneCountry,
				"phoneNumber" => $personalPhoneNumber,
			];
		}
		if ($companyEmailAdress || $companyPhoneCountry || $companyPhoneNumber) {
			$partyParams["companyContact"] = [
				"emailAdress" => $companyEmailAdress,
				"phoneCountry" => $companyPhoneCountry,
				"phoneNumber" => $companyPhoneNumber,
			];
		}
		if ($createdByName) {
			$partyParams["createdByName"] = $createdByName;
		}
		return $this->call(HttpMethod::POST, self::PARTIES_URI, $partyParams);
	}

	public function updatePartyStatus(string $partyCode, $newStatus): array
	{
		$partyParams = [
			"newStatus" => $newStatus
		];
		$uri = self::PARTIES_URI . '/' . $partyCode . '/status';
		return $this->call(HttpMethod::POST, $uri, $partyParams);
	}

	/**
	 * @throws SystemAMLException
	 * @noinspection PhpUnused
	 */
	public function getParty(string $partyCode): array {
		$uri = self::PARTIES_URI . '/' . $partyCode;
		return $this->call(HttpMethod::GET, $uri);
	}

	/**
	 * @throws SystemAMLException
	 */
	public function deleteParty(string $partyCode): array {
		$uri = self::PARTIES_URI . '/' . $partyCode;
		return $this->call(HttpMethod::DELETE, $uri);
	}

	/**
	 * @throws SystemAMLException
	 */
	public function createTransaction($status, $type, $occasionalTransaction, $amount, $currency,
									 $bookedAt, $paymentMethod, $title, $location, $entities = [],
									 $description = null, $references = null, $createdByName = null): array {
		$transactionParams = [
			"status" => $status,
			"type" => $type,
			"occasionalTransaction" => $occasionalTransaction,
			"amount" => $amount,
			"currency" => $currency,
			"bookedAt" => $bookedAt,
			"paymentMethod" => $paymentMethod,
			"title" => $title,
			"location" => $location,
		];
		if ($entities) {
			$transactionParams["entities"] = $entities;
		}
		if ($references) {
			$transactionParams["references"] = $references;
		}
		if ($description) {
			$transactionParams["description"] = $description;
		}
		if ($createdByName) {
			$transactionParams["createdByName"] = $createdByName;
		}
		return $this->call(HttpMethod::POST, self::TRANSACTIONS_URI, $transactionParams);
	}

	public function updateTransactionStatus(string $transactionCode, $newStatus): array {
		$transactionParams = [
			"newStatus" => $newStatus
		];
		$uri = self::TRANSACTIONS_URI . '/' . $transactionCode . '/status';
		return $this->call(HttpMethod::POST, $uri, $transactionParams);
	}
	public function getTransaction(string $transactionCode): array {
		$uri = self::TRANSACTIONS_URI . '/' . $transactionCode;
		return $this->call(HttpMethod::GET, $uri);
	}

	public function deleteTransaction(string $transactionCode): array {
		$uri = self::TRANSACTIONS_URI . '/' . $transactionCode;
		return $this->call(HttpMethod::DELETE, $uri);
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

		if ($httpMethod === HttpMethod::GET || $httpMethod === HttpMethod::DELETE) {
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
