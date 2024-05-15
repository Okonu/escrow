<?php

namespace App\Enums;

enum TransactionTypeEnum : string
{
    case DEPOSIT_TO_ESCROW = "deposit to escrow account";
    case WITHDRAW_FROM_ESCROW = "withdraw from escrow account";
    case MOBILE_MONEY_WITHDRAWAL = "mobile money withdrawal";
}