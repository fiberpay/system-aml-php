<!-- CREATE TRANSACTION -->
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
<!-- GET TRANSACTION -->
$ret = $client->getTransaction("q9hyv32w4b68");
<!-- CHANGE TRANSACTION STATUS -->

<!-- DELETE TRANSACTION -->
$ret = $client->deleteTransaction("q9hyv32w4b68");