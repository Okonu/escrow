<?php

namespace App\Filament\App\Resources\AccountResource\Widgets;

use App\Models\Account;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CurrentAmountWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Current Amount', Account::getCurrentAmount())
                ->icon('heroicon-o-dollar-sign'),
        ];
    }
}
