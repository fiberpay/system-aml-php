<?php

namespace FiberPay\SystemAML;

enum TransactionStatus: string
{
    case DRAFT = 'draft';
    case IN_ACCEPTANCE = 'in_acceptance';
    case ACCEPTED = 'accepted';
    case CANCELLED = 'cancelled';
}
