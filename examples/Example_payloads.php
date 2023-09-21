<!-- CREATE TRANSACTION -->

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
                    "type" => "buyer",
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