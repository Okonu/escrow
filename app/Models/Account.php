<?php

namespace App\Models;

use App\Enums\AccountTypeEnum;
use Filament\Forms\Components\Hidden;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = ['user_id', 'account_type', 'target_amount', 'current_amount'];

    // protected $casts = [
    //     "account_type" => AccountTypeEnum::class,
    // ];

    public static function getForm()
    {
        return [
            Hidden::make('user_id')
                ->default(function () {
                    $userId = Auth::id();
                    return $userId;
                }),
            TextInput::make('name')
                ->label('Name')
                ->readOnly()
                ->default(function () {
                    $userName = Auth::user()->name;
                    return $userName;
                }),
            Select::make('account_type')
                ->options(AccountTypeEnum::class)
                ->enum(AccountTypeEnum::class)
                ->required(),
            TextInput::make('target_amount')
                ->required()
                ->numeric(),
            TextInput::make('current_amount')
                ->required()
                ->numeric(),
            // TextInput::make('amount')
            //     ->label('Transfer Amount')
            //     ->required()
            //     ->numeric(),
        ];
    }

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
