<?php

namespace FiberPay\SystemAML;

enum PaymentMethod: string
{
	case CASH = 'cash';
	case BANK_TRANSFER = 'bank_transfer';
}
