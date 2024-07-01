<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\EmailOverview;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            // ->brandName('MÃO Importaciones')
            // ->brandLogo(asset('img/logo_patita.png')) 
            ->brandLogo(fn()=> view('filament.components.logo'))
            ->darkModeBrandLogo(fn()=> view('filament.components.logo-dark'))
            ->colors([
                'primary' => Color::Amber,
            ])
            ->breadcrumbs(false)
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
                EmailOverview::class
            ])
            ->profile()
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->navigationGroups([
                'Ingresos Almacen',
                'Salidas Almacen',
                'Configuracion Almacen',
            ])
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Ingresos Almacen')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Salidas Almacen')
                    ->collapsed(),
                NavigationGroup::make()
                     ->label('Configuracion Almacen')
                     ->collapsed(),
            ]);;
    }
}
