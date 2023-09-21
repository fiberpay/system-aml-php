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
<!-- CREATE SOLE PROPRIETORSHIP PARTY -->
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
<!-- CREATE COMPANY PARTY -->
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
<!-- GET PARTY -->
$ret = $client->getParty("8s4a617n3xgf");
<!-- CHANGE TRANSACTION STATUS -->
$ret = $client->updatePartyStatus("yvjhwpk4seu7", PartyStatus::INACTIVE);
<!-- DELETE PARTY -->
$ret = $client->deleteParty("8s4a617n3xgf");
