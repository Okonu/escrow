<?php

namespace App\Filament\App\Widgets;

use App\Models\Account;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class AmountWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Current Amount', Account::getCurrentAmount())
            ->icon('heroicon-o-currency-dollar'),
            Stat::make('Target Amount', Account::getTargetAmount())
                ->icon('heroicon-o-currency-dollar'),
            Stat::make('Total Transactions', Transaction::getTransactions()),
            // Stat::make('Pending Transactions', Transaction::getPendingTransactions()),
            // Stat::make('Completed Transactions', Transaction::getCompletedTransactions()),
            Stat::make('Total Amount Deposited', Transaction::getTotalAmountDeposited()),
            // Stat::make('Total Amount', Transaction::getTotalAmount()),
        ];
    }
}
