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
		$optionalParams = [
			"personalIdentityNumber",
			"birthDate",
			"birthCountry",
			"references",
			"citizenship",
			"birthCity",
			"documentType",
			"documentNumber",
			"documentExpirationDate",
			"withoutExpirationDate",
			"createdByName",
		];

		foreach ($optionalParams as $paramName) {
			if ($$paramName !== null) {
				$partyParams[$paramName] = $$paramName;
			}
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
		return $this->call(HttpMethod::POST, self::PARTIES_URI, $partyParams);
	}
	public function createSoleProprietorshipParty($status, $firstName, $lastName, $taxIdNumber, $companyName, $birthDate = null,
										 $personalIdentityNumber = null, $withoutNipData = [], $mainPkdCodeData = [],
										 $pkdCodes = [], $pepData = [], $companyData = [], $personalData = [],
										 $otherParams = [], $accommodationAddressData = [], $forwardAddressData = [],
										 $businessAddressData = [], $personalContactData = [], $contactData = []
										): array {
		$partyParams = [
			"type" => PartyType::SOLE_PROPRIETORSHIP,
			"status" => $status,
			"firstName" => $firstName,
			"lastName" => $lastName,
			"taxIdNumber" => $taxIdNumber,
			"companyName" => $companyName,
		];

		// Main PKD data: pkdCode, pkdName
		if (!empty($mainPkdCodeData)) {
			$partyParams["mainPkdCode"] = [
				"pkdCode" => $mainPkdCodeData["pkdCode"] ?? null,
				"pkdName" => $mainPkdCodeData["pkdName"] ?? null,
			];
		}
		// Without NIP data: companyIdentifier, registrationCountry
		foreach ($withoutNipData as $paramName => $paramValue) {
			if ($paramValue !== null) {
				$partyParams[$paramName] = $paramValue;
			}
		}
		//Company data: nationalBusinessRegistryNumber, tradeNames, economicRelationStartDate
		foreach ($companyData as $paramName => $paramValue) {
			if ($paramValue !== null) {
				$partyParams[$paramName] = $paramValue;
			}
		}
		//PEP data: politicallyExposed, politicallyExposedFamily, politicallyExposedCoworker
		foreach ($pepData as $paramName => $paramValue) {
			if ($paramValue !== null) {
				$partyParams[$paramName] = $paramValue;
			}
		}
		//Personal data: birthCountry, birthCity, citizenship, documentType, documentNumber, documentExpirationDate, withoutExpirationDate
		foreach ($personalData as $paramName => $paramValue) {
			if ($paramValue !== null) {
				$partyParams[$paramName] = $paramValue;
			}
		}
		//Other params: references, createdByName
		foreach ($otherParams as $paramName => $paramValue) {
			if ($paramValue !== null) {
				$partyParams[$paramName] = $paramValue;
			}
		}
		$optionalParams = [
			"pkdCodes" => $pkdCodes,
			"personalIdentityNumber" => $personalIdentityNumber,
			"birthDate" => $birthDate,
		];
		foreach ($optionalParams as $paramName => $paramValue) {
			if ($paramValue !== null) {
				$partyParams[$paramName] = $paramValue;
			}
		}
		// Accommodation Data: [country, city, street, houseNumber, flatNumber, postalCode]
		if (!empty($accommodationAddressData)) {
			$partyParams["accommodationAddress"] = $accommodationAddressData;
		}
		// Forward Data: [country, city, street, houseNumber, flatNumber, postalCode]
		if (!empty($forwardAddressData)) {
			$partyParams["forwardAddress"] = $forwardAddressData;
		}
		// Business Data: [country, city, street, houseNumber, flatNumber, postalCode]
		if (!empty($businessAddressData)) {
			$partyParams["businessAddress"] = $businessAddressData;
		}
		// Contact Data: [phoneCountry, phoneNumber, emailAdress]
		if (!empty($personalContactData)) {
			$partyParams["personalContact"] = $contactData;
		}
		// Contact Data: [phoneCountry, phoneNumber, emailAdress]
		if (!empty($contactData)) {
			$partyParams["companyContact"] = $contactData;
		}
		return $this->call(HttpMethod::POST, self::PARTIES_URI, $partyParams);
	}

	public function createCompanyParty($status, $taxIdNumber, $companyName, $mainPkdCodeData = [],
									   $withoutNipData = [], $pkdCodes = [], $beneficiaries = [], $boardMembers = [],
									   $companyData = [], $otherParams = [], $businessAddressData = [], $contactData = []
									  ): array {
		$partyParams = [
			"type" => PartyType::COMPANY,
			"status" => $status,
			"taxIdNumber" => $taxIdNumber,
			"companyName" => $companyName,
		];
		// Main PKD data: pkdCode, pkdName
		if (!empty($mainPkdCodeData)) {
			$partyParams["mainPkdCode"] = [
				"pkdCode" => $mainPkdCodeData["pkdCode"] ?? null,
				"pkdName" => $mainPkdCodeData["pkdName"] ?? null,
			];
		}
		// Without NIP data: companyIdentifier, registrationCountry
		foreach ($withoutNipData as $paramName => $paramValue) {
			if ($paramValue !== null) {
				$partyParams[$paramName] = $paramValue;
			}
		}
		//Company data: businessActivityForm, nationalBusinessRegistryNumber, nationalCourtRegistryNumber, economicRelationStartDate
		foreach ($companyData as $paramName => $paramValue) {
			if ($paramValue !== null) {
				$partyParams[$paramName] = $paramValue;
			}
		}
		//Other params: tradeNames, website, servicesDescription, references, createdByName
		foreach ($otherParams as $paramName => $paramValue) {
			if ($paramValue !== null) {
				$partyParams[$paramName] = $paramValue;
			}
		}
		$optionalParams = [
			"pkdCodes" => $pkdCodes,
			"beneficiaries" => $beneficiaries,
			"boardMembers" => $boardMembers,
		];

		foreach ($optionalParams as $paramName => $paramValue) {
			if ($paramValue !== null) {
				$partyParams[$paramName] = $paramValue;
			}
		}
		// Business Data: [country, city, street, houseNumber, flatNumber, postalCode]
		if (!empty($businessAddressData)) {
			$partyParams["businessAddress"] = $businessAddressData;
		}
		// Contact Data: [phoneCountry, phoneNumber, emailAdress]
		if (!empty($contactData)) {
			$partyParams["companyContact"] = $contactData;
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

		$optionalParams = [
			"entities" => $entities,
			"description" => $description,
			"references" => $references,
			"createdByName" => $createdByName,
		];

		foreach ($optionalParams as $paramName => $paramValue) {
			if ($paramValue !== null) {
				$transactionParams[$paramName] = $paramValue;
			}
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
	public function recalculateModelRulesAndSuggestedRisk(string $modelCode, string $modelType): array {
		$uri = "/rules/risk-recalculate?type=$modelType&code=$modelCode";
		return $this->call(HttpMethod::GET, $uri);
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
