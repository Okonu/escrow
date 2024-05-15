<?php

namespace App\Filament\App\Widgets;

use App\Models\Account;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class AmountWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Current Amount', Account::getCurrentAmount())
                // ->icon('heroicon-dollar-sign'),
        ];
    }
}
