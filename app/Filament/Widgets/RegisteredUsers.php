<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RegisteredUsers extends BaseWidget
{
    protected function getStats(): array
    {
        $registeredUsersCount = User::count();

        return [
            Stat::make('Registered Users', $registeredUsersCount),
        ];
    }
}
