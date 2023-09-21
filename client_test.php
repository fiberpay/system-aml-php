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
    // $ret = $client->deleteParty("8s4a617n3xgf");
    // $ret = $client->getParty("yvjhwpk4seu7");
    // $ret = $client->updatePartyStatus("yvjhwpk4seu7", PartyStatus::INACTIVE);

    // $ret = $client->createIndividualParty(
    //     status: PartyStatus::ACTIVE,
    //     birthCity: "Warszawa",
    //     birthDate: "2000-01-12",
    //     birthCountry: "PL",
    //     citizenship: "PL",
    //     createdByName: "Wojtek",
    //     documentExpirationDate: "2025-05-15",
    //     documentNumber: "aze123123",
    //     documentType: "id_card",
    //     firstName: "Jan",
    //     lastName: "Kowalski",
    //     personalIdentityNumber: "09271573233",
    //     politicallyExposed: "no",
    //     politicallyExposedCoworker:"no",
    //     politicallyExposedFamily:"yes",
    //     references: "qwerty",
    //     withoutExpirationDate: false,
    //     accommodationCountry: "PL",
    //     accommodationCity: "Warszawa",
    //     accommodationStreet: "Grzybowska",
    //     accommodationHouseNumber: "4",
    //     accommodationFlatNumber: "106",
    //     accommodationPostalCode: "00-131",
    //     forwardCountry: "PL",
    //     forwardCity: "Warszawa",
    //     forwardStreet: "Grzybowska",
    //     forwardHouseNumber: "4",
    //     forwardFlatNumber: "106",
    //     forwardPostalCode: "00-131",
    //     personalEmailAdress: "info@fiberpay.pl",
    //     personalPhoneCountry: "48",
    //     personalPhoneNumber: "123123123",
    // );
    var_dump($ret);
} catch (Exception $e) {
    $code = $e->getHttpStatusCode();
    $message = $e->getMessage();
    var_dump("[$code] $message");
}