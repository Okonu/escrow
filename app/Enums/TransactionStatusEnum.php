<?php

namespace App\Enums;

enum TransactionStatusEnum : string
{
    case COMPLETE = "completed";
    case FAILED = "failed";
    case PENDING = "pending";
}