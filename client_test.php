<?php

use FiberPay\SystemAML\RequestParams\Constants\Currency;
use FiberPay\SystemAML\RequestParams\Party\PartyStatus;
use FiberPay\SystemAML\RequestParams\Transaction\EntityType;
use FiberPay\SystemAML\SystemAMLClient;
use FiberPay\SystemAML\RequestParams\Transaction\TransactionStatus;
use FiberPay\SystemAML\RequestParams\Transaction\TransactionType;

require_once __DIR__ . '/vendor/autoload.php';

// $apiURL = 'Twoj super URL do serwera';
// $apiKey = "asd";
// $apiSecret = "asd2";

$client = new SystemAMLClient($apiURL, $apiKey, $apiSecret);

try {
    $ret = $client->createCompanyParty(
        status: PartyStatus::ACTIVE,
        companyName: "FiberPay",
        taxIdNumber: "7010634566",
        nationalBusinessRegistryNumber: "147302566",
        tradeNames: ["FiberPay", "SystemAML"],
        nationalCourtRegistryNumber: "0000512707",
        businessActivityForm: "stock_company",
        website: "fiberpay.pl",
        references: "qwerty",
        businessCountry: "PL",
        businessCity: "Warszawa",
        businessStreet: "Grzybowska",
        businessHouseNumber: "4",
        businessFlatNumber: "106",
        businessPostalCode: "00-131",
        companyEmailAdress: "info@fiberpay.pl",
        companyPhoneCountry: "48",
        companyPhoneNumber: "123123123",
        servicesDescription: "Usługi płatnicze",
        createdByName: "Wojtek",
        mainPkdCode: "64.99.Z",
        mainPkdName: "POZOSTAŁA FINANSOWA DZIAŁALNOŚĆ USŁUGOWA, GDZIE INDZIEJ NIESKLASYFIKOWANA, Z WYŁĄCZENIEM UBEZPIECZEŃ I FUNDUSZÓW EMERYTALNYCH",
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
            ]
        ]
    );
    var_dump($ret);
} catch (Exception $e) {
    $code = $e->getHttpStatusCode();
    $message = $e->getMessage();
    var_dump("[$code] $message");
}