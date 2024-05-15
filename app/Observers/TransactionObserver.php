<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Enums\TransactionStatusEnum;
use Filament\Notifications\Notification;

class TransactionObserver
{
    public function created(Transaction $transaction): void
    {
        $recipient = auth()->user();

        Notification::make()
            ->title('Transaction started' . $transaction->amount)
            ->sendToDatabase($recipient);
    }
    public function updated(Transaction $transaction): void
    {
        $recipient = auth()->user();

        switch ($transaction->transaction_status) {
            case TransactionStatusEnum::COMPLETED:
                Notification::make()
                    ->title('Transaction completed')
                    ->sendToDatabase($recipient);
                break;
            case TransactionStatusEnum::FAILED:
                Notification::make()
                    ->title('Transaction failed')
                    ->sendToDatabase($recipient);
                break;
            case TransactionStatusEnum::PENDING:
                Notification::make()
                    ->title('Transaction pending')
                    ->sendToDatabase($recipient);
                break;
        }
    }

}
