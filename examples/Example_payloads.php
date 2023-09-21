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
$ret = $client->updateTransactionStatus("td4r9v6weunk", TransactionStatus::CANCELLED);
<!-- DELETE TRANSACTION -->
$ret = $client->deleteTransaction("q9hyv32w4b68");

<!-- CREATE INDIVIDUAL PARTY -->
$ret = $client->createIndividualParty(
    status: PartyStatus::ACTIVE,
    birthCity: "Warszawa",
    birthDate: "2000-01-12",
    birthCountry: "PL",
    citizenship: "PL",
    createdByName: "Wojtek",
    documentExpirationDate: "2025-05-15",
    documentNumber: "aze123123",
    documentType: "id_card",
    firstName: "Jan",
    lastName: "Kowalski",
    personalIdentityNumber: "09271573233",
    politicallyExposed: "no",
    politicallyExposedCoworker:"no",
    politicallyExposedFamily:"yes",
    references: "qwerty",
    withoutExpirationDate: false,
    accommodationCountry: "PL",
    accommodationCity: "Warszawa",
    accommodationStreet: "Grzybowska",
    accommodationHouseNumber: "4",
    accommodationFlatNumber: "106",
    accommodationPostalCode: "00-131",
    forwardCountry: "PL",
    forwardCity: "Warszawa",
    forwardStreet: "Grzybowska",
    forwardHouseNumber: "4",
    forwardFlatNumber: "106",
    forwardPostalCode: "00-131",
    personalEmailAdress: "info@fiberpay.pl",
    personalPhoneCountry: "48",
    personalPhoneNumber: "123123123",
);
<!-- GET PARTY -->
$ret = $client->getParty("8s4a617n3xgf");
<!-- CHANGE TRANSACTION STATUS -->
$ret = $client->updatePartyStatus("yvjhwpk4seu7", PartyStatus::INACTIVE);
<!-- DELETE PARTY -->
$ret = $client->deleteParty("8s4a617n3xgf");
