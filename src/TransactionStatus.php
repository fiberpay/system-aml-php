<?php

namespace FiberPay\SystemAML;

enum TransactionStatus: string
{
	case DRAFT = 'draft';
	case NEW = 'new';
}
