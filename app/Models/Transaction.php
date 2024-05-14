<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Enums\TransactionTypeEnum;
use App\Enums\TransactionStatusEnum;

class Transaction extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = ['account_id', 'transaction_type', 'amount', 'transaction_status'];

    protected $casts = [
        "transaction_status" => TransactionStatusEnum::class,
        "transaction_type" => TransactionTypeEnum::class,
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
