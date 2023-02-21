<?php

namespace FiberPay\SystemAML;

enum TransactionType: string
{
	case BROKER = 'broker'; //dodający transakcję jest pośrednikiem
	case BUYER = 'buyer'; //dodający transakcję jest kupującym
	case VENDER = 'vender'; //dodający transakcję jest sprzedającym
}
