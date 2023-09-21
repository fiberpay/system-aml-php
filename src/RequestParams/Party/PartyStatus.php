<?php

namespace FiberPay\SystemAML\RequestParams\Party;

enum PartyStatus: string
{
    case DRAFT = 'draft';
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case IN_ACCEPTANCE = 'in_acceptance';
}
