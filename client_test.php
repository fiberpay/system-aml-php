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
    $ret = $client->createSoleProprietorshipParty(
        status: PartyStatus::ACTIVE,
        firstName: "Jan",
        lastName: "Kowalski",
        taxIdNumber: "3765151981",
        companyName: "Usługi programistyczne",
        personalIdentityNumber: "99120234518",
        mainPkdCodeData:["pkdCode" => "01.12.Z", "pkdName" => "Uprawa ryżu"],
        pkdCodes: [["pkdCode" => "01.15.Z","pkdName" => "Uprawa tytoniu"]],
        pepData: ["politicallyExposed" => "no", "politicallyExposedCoworker" => "no", "politicallyExposedFamily" => "yes"],
        companyData: ["nationalBusinessRegistryNumber" => "123456789", "tradeNames" => ["super firma", "moja firma","fajna firma"], "economicRelationStartDate" => "2020-01-01"],
        personalData: ["birthCountry" => "PL", "birthCity" => "Warszawa", "citizenship" => "PL", "documentType" => "passport", "documentNumber" => "aze123123", "documentExpirationDate" => "2025-05-08", "withoutExpirationDate" => false],
        otherParams: ["createdByName" => "Adam", "references" => "qwerty"],
        forwardAddressData: ["country" => "PL", "city" => "Warszawa", "street" => "Grzybowska", "houseNumber" => "4", "flatNumber" => "106", "postalCode" => "00-131"],
        businessAddressData: ["country" => "PL", "city" => "Warszawa", "street" => "Grzybowska", "houseNumber" => "4", "flatNumber" => "106", "postalCode" => "00-131"],
        accommodationAddressData: ["country" => "PL", "city" => "Warszawa", "street" => "Grzybowska", "houseNumber" => "4", "flatNumber" => "106", "postalCode" => "00-131"],
        personalContactData:["emailAdress" => "info@fiberpay.pl", "phoneCountry" => "48", "phoneNumber" => "123123123"],
        contactData: ["emailAdress" => "info@fiberpay.pl", "phoneCountry" => "48", "phoneNumber" => "123123123"]
    );
    var_dump($ret);
} catch (Exception $e) {
    $code = $e->getHttpStatusCode();
    $message = $e->getMessage();
    var_dump("[$code] $message");
}