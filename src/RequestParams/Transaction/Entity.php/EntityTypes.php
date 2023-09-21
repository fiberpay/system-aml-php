<?php

namespace FiberPay\SystemAML\RequestParams\Transaction\Entity;

enum EntityType: string
{
    case RECEIVER = 'receiver';
    case SENDER = 'sender';
    case SELLER = 'seller';
    case BUYER = 'buyer';
    case PAYER = 'payer';
}
