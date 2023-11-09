<?php

use FiberPay\SystemAML\RequestParams\Constants\Currency;
use FiberPay\SystemAML\RequestParams\Party\PartyStatus;
use FiberPay\SystemAML\RequestParams\Transaction\EntityType;
use FiberPay\SystemAML\SystemAMLClient;
use FiberPay\SystemAML\RequestParams\Transaction\TransactionStatus;
use FiberPay\SystemAML\RequestParams\Transaction\TransactionType;

require_once __DIR__ . '/vendor/autoload.php';

$apiURL = 'apiURL';
$apiKey = "apiKey";
$apiSecret = "apiSecret";

$client = new SystemAMLClient($apiURL, $apiKey, $apiSecret);

try {
    $ret = $client->createCompanyParty(
        status: PartyStatus::ACTIVE,
        companyName: "FiberPay",
        taxIdNumber: "7010634566",
        mainPkdCodeData: [ "pkdCode"=> "64.99.Z", "pkdName" => "POZOSTAŁA FINANSOWA DZIAŁALNOŚĆ USŁUGOWA, GDZIE INDZIEJ NIESKLASYFIKOWANA, Z WYŁĄCZENIEM UBEZPIECZEŃ I FUNDUSZÓW EMERYTALNYCH"],
        withoutNipData: [],
        pkdCodes: [
            [
            "pkdCode" => "58.29.Z",
            "pkdName" => "DZIAŁALNOŚĆ WYDAWNICZA W ZAKRESIE POZOSTAŁEGO OPROGRAMOWANIA"
            ],
            [
            "pkdCode" => "62.01.Z",
            "pkdName" => "DZIAŁALNOŚĆ ZWIĄZANA Z OPROGRAMOWANIEM"
            ]
        ],
        beneficiaries: [
            [
                "birthCountry" => "PL",
                "directRights" => "ABB",
                "birthCity" => "Warszawa",
                "citizenship" => "PL",
                "documentNumber" => "aze123123",
                "documentType" => "id_card",
                "firstName" => "Jan",
                "lastName" => "Kowalski",
                "ownedSharesAmount" => "45",
                "ownedSharesUnit" => "%",
                "personalIdentityNumber" => "64091098920",
                "politicallyExposed" => "no",
                "withoutExpirationDate" => false,
                ],
                [
                "birthCountry" => "DE",
                "directRights" => "3M",
                "birthCity" => "Germany",
                "birthDate" => "2002-10-01",
                "citizenship" => "DE",
                "documentNumber" => "aze423",
                "documentType" => "id_card",
                "firstName" => "Hans",
                "lastName" => "Podolski",
                "ownedSharesAmount" => "15",
                "ownedSharesUnit" => "%",
                "politicallyExposed" => "no",
                "withoutExpirationDate" => false,
                ],
            ],
        boardMembers: [
            [
                "birthCity" => "Warszawa",
                "birthDate" => "2001-01-01",
                "birthCountry" => "PL",
                "citizenship" => "PL",
                "description" => "Prezes",
                "documentNumber" => "aze123123",
                "documentType" => "id_card",
                "firstName" => "Jan",
                "lastName" => "Kowalski",
                "personalIdentityNumber" => "31111161119",
                "politicallyExposed" => "no",
                "withoutExpirationDate" => false,
                "roleType" => "president",
            ],
            [
                "birthCity" => "Warszawa",
                "birthDate" => "2001-01-01",
                "birthCountry" => "PL",
                "citizenship" => "PL",
                "description" => "Wiceprezes",
                "documentNumber" => "aze129923",
                "documentType" => "id_card",
                "firstName" => "Adam",
                "lastName" => "Nowak",
                "politicallyExposed" => "yes",
                "withoutExpirationDate" => false,
                "roleType" => "other",
                ]
            ],
        companyData: [ "nationalBusinessRegistryNumber" => "147302566", "nationalCourtRegistryNumber" => "0000512707", "businessActivityForm" => "stock_company", "economicRelationStartDate" => "2020-01-01"],
        otherParams:[ "tradeNames" => ["FiberPay", "SystemAML"], "website" => "fiberpay.pl", "references" => "qwerty", "servicesDescription" => "Usługi płatnicze", "createdByName" => "Wojtek"],
        businessAddressData: [ "country" => "PL", "city" => "Warszawa", "street" => "Grzybowska", "houseNumber" => "4", "flatNumber" => "106", "postalCode" => "00-131"],
        contactData: ["emailAdress" => "info@fiberpay.pl", "phoneCountry" => "48", "phoneNumber" => "123123123"]
    );
    var_dump($ret);
} catch (Exception $e) {
    $code = $e->getHttpStatusCode();
    $message = $e->getMessage();
    var_dump("[$code] $message");
}