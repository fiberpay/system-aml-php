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
        firstName: "Jan",
        lastName: "Kowalski",
        taxIdNumber: "3765151981",
        companyName: "Usługi programistyczne",
        personalIdentityNumber: "99120234518",
        mainPkdCodeData:["pkdCode" => "01.12.Z", "pkdName" => "Uprawa ryżu"],
        pkdCodes: [["pkdCode" => "01.15.Z","pkdName" => "Uprawa tytoniu"]],
        pepData: ["politicallyExposed" => "no", "politicallyExposedCoworker" => "no", "politicallyExposedFamily" => "yes"],
        companyData: ["nationalBusinessRegistryNumber" => "123456789", "tradeNames" => ["super firma", "moja firma","fajna firma"], "economicRelationStartDate" => "2020-01-01"],
        personalData: ["birthCountry" => "PL", "birthCity" => "Warszawa", "citizenship" => "PL", "documentType" => "passport", "documentNumber" => "aze123123", "documentExpirationDate" => "2025-05-08", "withoutExpirationDate" => false],
        otherParams: ["createdByName" => "Adam", "references" => "qwerty"],
        forwardAddressData: ["country" => "PL", "city" => "Warszawa", "street" => "Grzybowska", "houseNumber" => "4", "flatNumber" => "106", "postalCode" => "00-131"],
        businessAddressData: ["country" => "PL", "city" => "Warszawa", "street" => "Grzybowska", "houseNumber" => "4", "flatNumber" => "106", "postalCode" => "00-131"],
        accommodationAddressData: ["country" => "PL", "city" => "Warszawa", "street" => "Grzybowska", "houseNumber" => "4", "flatNumber" => "106", "postalCode" => "00-131"],
        personalContactData:["emailAdress" => "info@fiberpay.pl", "phoneCountry" => "48", "phoneNumber" => "123123123"],
        contactData: ["emailAdress" => "info@fiberpay.pl", "phoneCountry" => "48", "phoneNumber" => "123123123"]
    );
<!-- CREATE COMPANY PARTY -->
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
            ],
        companyData: [ "nationalBusinessRegistryNumber" => "147302566", "nationalCourtRegistryNumber" => "0000512707", "businessActivityForm" => "stock_company", "economicRelationStartDate" => "2020-01-01"],
        otherParams:[ "tradeNames" => ["FiberPay", "SystemAML"], "website" => "fiberpay.pl", "references" => "qwerty", "servicesDescription" => "Usługi płatnicze", "createdByName" => "Wojtek"],
        businessAddressData: [ "country" => "PL", "city" => "Warszawa", "street" => "Grzybowska", "houseNumber" => "4", "flatNumber" => "106", "postalCode" => "00-131"],
        contactData: ["emailAdress" => "info@fiberpay.pl", "phoneCountry" => "48", "phoneNumber" => "123123123"]
    );
    var_dump($ret);
<!-- GET PARTY -->
$ret = $client->getParty("8s4a617n3xgf");
<!-- CHANGE TRANSACTION STATUS -->
$ret = $client->updatePartyStatus("yvjhwpk4seu7", PartyStatus::INACTIVE);
<!-- DELETE PARTY -->
$ret = $client->deleteParty("8s4a617n3xgf");
<!-- SUGGESTED RISK & RULES RECALCULATE -->
$ret = $client->recalculateModelRulesAndSuggestedRisk("cwt74qxbuy5z", "party");

