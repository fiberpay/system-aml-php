<?php

use FiberPay\SystemAML\RequestParams\Constants\Currency;
use FiberPay\SystemAML\RequestParams\Party\PartyStatus;
use FiberPay\SystemAML\RequestParams\Transaction\EntityType;
use FiberPay\SystemAML\SystemAMLClient;
use FiberPay\SystemAML\RequestParams\Transaction\TransactionStatus;
use FiberPay\SystemAML\RequestParams\Transaction\TransactionType;

require_once __DIR__ . '/vendor/autoload.php';

$apiURL = 'https://amlapidev2.fiberpay.pl';
$apiKey = "kC1tJVSUIVfxjGPd";
$apiSecret = "670830d849b1a17622e330dc63a5c97f5f2841350d718ec865918717961b272b";

$client = new SystemAMLClient($apiURL, $apiKey, $apiSecret);

try {
    $ret = $client->createIndividualParty(
        status: PartyStatus::ACTIVE,
        firstName: "Jan",
        lastName: "Kowalski",
        personalIdentityNumber: "09271573233",
        birthDate: "2000-01-12",
        pepData: ["politicallyExposed" => "no", "politicallyExposedCoworker" => "no","politicallyExposedFamily" => "yes"],
        personalData: ["birthCountry" => "PL", "birthCity" => "Warszawa", "citizenship" => "PL", "documentType" => "id_card", "documentNumber" => "aze123123", "documentExpirationDate" => "2025-05-15", "withoutExpirationDate" => false],
        otherParams: ["createdByName" => "Kuba", "references" => "qwerty", "economicRelationStartDate" => "2020-01-01"],
        accommodationAddressData: ["country" => "PL", "city" => "Warszawa", "street" => "Grzybowska", "houseNumber" => "4", "flatNumber" => "106", "PostalCode" => "00-131"],
        forwardAddressData: ["country" => "PL", "city" => "Warszawa", "street" => "Grzybowska", "houseNumber" => "4", "flatNumber" => "106", "postalCode" => "00-131"],
        personalContactData: ["emailAdress" => "info@fiberpay.pl", "phoneCountry" => "48","phoneNumber" => "123123123"],
    );
    var_dump($ret);
} catch (Exception $e) {
    $code = $e->getHttpStatusCode();
    $message = $e->getMessage();
    var_dump("[$code] $message");
}