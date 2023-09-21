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
    $ret = $client->updateTransactionStatus("td4r9v6weunk", TransactionStatus::CANCELLED);
    var_dump($ret);
} catch (Exception $e) {
    $code = $e->getHttpStatusCode();
    $message = $e->getMessage();
    var_dump("[$code] $message");
}