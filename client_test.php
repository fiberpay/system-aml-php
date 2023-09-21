<?php

use FiberPay\SystemAML\RequestParams\Constants\Currency;
use FiberPay\SystemAML\RequestParams\Party\PartyStatus;
use FiberPay\SystemAML\RequestParams\Transaction\Entity\EntityType;
use FiberPay\SystemAML\SystemAMLClient;
use FiberPay\SystemAML\RequestParams\Transaction\TransactionStatus;
use FiberPay\SystemAML\RequestParams\Transaction\TransactionType;

require_once __DIR__ . '/vendor/autoload.php';

// >>> localhost <<<
$apiURL = 'http://localhost:8083';
$apiKey = "gWkMLduzNOfZLX1o";
$apiSecret = "437c2ea68b47e774c475ad43b82e36f6c414ae86200469dbf2f37470dde6ac9d";

// >>> amldev2 <<<
// $apiURL = 'https://amlapidev2.fiberpay.pl';
// $apiKey = "asd";
// $apiSecret = "asd2";

$client = new SystemAMLClient($apiURL, $apiKey, $apiSecret);

try {
    $ret = $client->createSoleProprietorshipParty(
        status: PartyStatus::ACTIVE,
        birthCity: "Warszawa",
        nationalBusinessRegistryNumber: "123456789",
        birthCountry: "PL",
        citizenship: "PL",
        companyName: "Usługi programistyczne",
        createdByName: "Adam",
        documentExpirationDate: "2025-05-08",
        documentNumber: "aze123123",
        documentType: "passport",
        firstName: "Jan",
        lastName: "Kowalski",
        mainPkdCode: "01.12.Z",
        mainPkdName: "Uprawa ryżu",
        personalIdentityNumber: "99120234518",
        pkdCodes: [
          [
            "pkdCode" => "01.15.Z",
            "pkdName" => "Uprawa tytoniu"
          ]
        ],
        tradeNames: ["super firma", "moja firma","fajna firma"],
        politicallyExposed: "no",
        politicallyExposedCoworker: "no",
        politicallyExposedFamily: "yes",
        references: "qwerty",
        taxIdNumber: "3765151981",
        withoutExpirationDate: false,
        forwardCountry: "PL",
        forwardCity: "Warszawa",
        forwardStreet: "Grzybowska",
        forwardHouseNumber: "4",
        forwardFlatNumber: "106",
        forwardPostalCode: "00-131",
        businessCountry: "PL",
        businessCity: "Warszawa",
        businessStreet: "Grzybowska",
        businessHouseNumber: "4",
        businessFlatNumber: "106",
        businessPostalCode: "00-131",
        accommodationCountry: "PL",
        accommodationCity: "Warszawa",
        accommodationStreet: "Grzybowska",
        accommodationHouseNumber: "4",
        accommodationFlatNumber: "106",
        accommodationPostalCode: "00-131",
        personalEmailAdress: "info@fiberpay.pl",
        personalPhoneCountry: "48",
        personalPhoneNumber: "123123123",
        companyEmailAdress: "info@fiberpay.pl",
        companyPhoneCountry: "48",
        companyPhoneNumber: "123123123"
    );
    var_dump($ret);
} catch (Exception $e) {
    $code = $e->getHttpStatusCode();
    $message = $e->getMessage();
    var_dump("[$code] $message");
}