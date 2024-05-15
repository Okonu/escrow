<?php

namespace App\Enums;

enum TransactionStatusEnum : string
{
    case COMPLETED = "completed";
    case FAILED = "failed";
    case PENDING = "pending";
}