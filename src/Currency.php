<?php

namespace FiberPay\SystemAML;

enum Currency: string
{
	case PLN = 'PLN';
	case EUR = 'EUR';
	case USD = 'USD';
	case JPY = 'JPY';
	case GBP = 'GBP';
	case AUD = 'AUD';
	case CAD = 'CAD';
	case CHF = 'CHF';
	case CNY = 'CNY';
}
