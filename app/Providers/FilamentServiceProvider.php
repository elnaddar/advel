<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\UserResource;
use App\Filament\Resources\RoleResource;
use App\Filament\Resources\PermissionResource;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Filament::serving(function () {
            if (Auth::user() != null && !Auth::user()->hasAnyPermission(['manage users', 'manage roles', 'manage permissions'])) {
                redirect('/')->send();
            }

            Filament::registerNavigationGroups([
                NavigationGroup::make('User Management')
                    ->items([
                        NavigationItem::make('Users')
                            ->url(UserResource::getUrl())
                            ->icon('heroicon-o-users')
                            ->visible(fn () => Auth::user()->can('manage users')),

                        NavigationItem::make('Roles')
                            ->url(RoleResource::getUrl())
                            ->icon('heroicon-o-shield-check')
                            ->visible(fn () => Auth::user()->can('manage roles')),

                        NavigationItem::make('Permissions')
                            ->url(PermissionResource::getUrl())
                            ->icon('heroicon-o-lock-closed')
                            ->visible(fn () => Auth::user()->can('manage permissions')),
                    ]),
            ]);
        });
    }

    public function register()
    {
        //
    }
}
