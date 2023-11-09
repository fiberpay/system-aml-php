<?php

namespace FiberPay\SystemAML\RequestParams\Transaction;

enum TransactionType: string
{
	case BUYER = 'buyer'; //dodający transakcję jest kupującym
	case VENDER = 'vender'; //dodający transakcję jest sprzedającym
	case TRANSFER = 'transfer'; //transakcja płatnicza
	case OTHER = 'other';
}
