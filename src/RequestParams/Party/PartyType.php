<?php

namespace FiberPay\SystemAML;

enum PartyType: string
{
	case INDIVIDUAL = 'individual'; //dodający transakcję jest pośrednikiem
	case SOLE_PROPRIETORSHIP = 'sole_proprietorship'; //dodający transakcję jest kupującym
	case COMPANY = 'company'; //dodający transakcję jest sprzedającym
}
