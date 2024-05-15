<?php

namespace App\Models;

use App\Enums\TransactionTypeEnum;
use App\Enums\TransactionStatusEnum;
use Filament\Forms\Components\Section;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = ['account_id', 'transaction_type', 'amount', 'transaction_status'];

    protected $casts = [
        "transaction_status" => TransactionStatusEnum::class,
        "transaction_type" => TransactionTypeEnum::class,
    ];

    public static function getForm()
    {
        return [
            Section::make()->columns(2)->schema([
                Select::make('account_id')
                    ->searchable()
                    ->preload()
                    ->createOptionForm(Account::getForm())
                    ->editOptionForm(Account::getForm())
                    ->relationship('account', 'account_type')
                    ->required(),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Select::make('transaction_type')
                    ->options(TransactionTypeEnum::class)
                    ->enum(TransactionTypeEnum::class)
                    ->required(),
                TextInput::make('transaction_status')
                    ->readOnly()
                    ->default(TransactionStatusEnum::PENDING),
            ])
        ];
    }

    public static function getTransactions()
    {
        $user = Auth::user();
        if($user && $user->account) {
            return $user->account->transactions;
        }
        return self::all()->sum();
    }

    public static function getTotalAmountDeposited(): int
    {
        $user = Auth::user();

        if ($user && $user->account) {
            $transactions = $user->account->transactions()
                                       ->where('transaction_type', TransactionTypeEnum::DEPOSIT_TO_ESCROW)
                                       ->where('transaction_status', TransactionStatusEnum::COMPLETED)
                                       ->get();

            return $transactions->sum('amount');
        }

        return 0;
    }
    
    public static function getTotalAmountTransacted()
    {
        return self::all()->sum();
    } 

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
