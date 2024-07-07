<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LoggedInUsers extends BaseWidget
{
    protected function getStats(): array
    {
        $loggedInUsersCount = User::whereDate('last_login_at', Carbon::today())->count();

        return [
            Stat::make('Users Logged In Today', $loggedInUsersCount),
        ];
    }

    public static function canView(): bool
    {
        return Auth::user()->can('view user states');
    }
}
