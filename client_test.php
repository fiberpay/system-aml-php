<?php

use FiberPay\SystemAML\RequestParams\Constants\Currency;
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
    $ret = $client->createTransaction(
            status: TransactionStatus::ACCEPTED,
            type: TransactionType::VENDER,
            occasionalTransaction: false,
            amount: '780',
            currency: Currency::PLN,
            bookedAt: '2023-09-10 10:10:10',
            paymentMethod: 'blik',
            title: 'transakcja z klienta',
            location: 'PL',
            references: "",
            createdByName: "OPTIMUS PRIME",
            entities: [
                [
                    "type" => EntityType::BUYER,
                    "description" => "entity z klienta",
                    "firstName" => "Jan",
                    "lastName" => "Kowalski",
                    "companyName" => "",
                    "partyCode" => "",
                    "iban" => ""
                ]
            ]
    );
    var_dump($ret);
} catch (Exception $e) {
    $code = $e->getHttpsStatusCode();
    $message = $e->getMessage();
    var_dump("[$code] $message");
}