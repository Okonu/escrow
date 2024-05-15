<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Enums\AccountTypeEnum;
use Illuminate\Support\Facades\Auth;

class Account extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = ['user_id', 'account_type', 'target_amount', 'current_amount'];

    protected $casts = [
        "account_type" => AccountTypeEnum::class,
    ];

    public static function getCurrentAmount(): int
    {
        $user = Auth::user();

        if($user && $user->account) {
            return $user->account->current_amount;
        }

        return 0;
    }
    public static function getTargetAmount(): int
    {
        $user = Auth::user();

        if($user && $user->account) {
            return $user->account->target_amount;
        }

        return 0;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
