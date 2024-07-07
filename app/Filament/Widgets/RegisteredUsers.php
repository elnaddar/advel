<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class RegisteredUsers extends BaseWidget
{
    protected function getStats(): array
    {
        $registeredUsersCount = User::count();

        return [
            Stat::make('Registered Users', $registeredUsersCount),
        ];
    }

    public static function canView(): bool
    {
        return Auth::user()->can('view user states');
    }
}
