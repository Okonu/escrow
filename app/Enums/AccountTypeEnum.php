<?php

namespace App\Enums;

enum AccountTypeEnum : string
{
    case ESCROW = "escrow";
    case DEPOSIT = "deposit";
}