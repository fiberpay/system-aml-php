<?php

namespace FiberPay\SystemAML;

enum PartyStatus: string
{
    case DRAFT = 'draft';
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case IN_ACCEPTANCE = 'in_acceptance';
}
