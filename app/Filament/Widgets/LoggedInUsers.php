<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class LoggedInUsers extends BaseWidget
{
    protected function getStats(): array
    {
        $loggedInUsersCount = User::whereDate('last_login_at', Carbon::today())->count();

        return [
            Stat::make('Users Logged In Today', $loggedInUsersCount),
        ];
    }
}
