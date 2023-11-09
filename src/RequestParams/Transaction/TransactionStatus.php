<?php

namespace FiberPay\SystemAML\RequestParams\Transaction;

enum TransactionStatus: string
{
    case DRAFT = 'draft';
    case IN_ACCEPTANCE = 'in_acceptance';
    case ACCEPTED = 'accepted';
    case CANCELLED = 'cancelled';
}
