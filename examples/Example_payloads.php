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