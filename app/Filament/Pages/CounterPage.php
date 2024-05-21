<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class CounterPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Catalogo Vendedores';
    
    protected static ?string $title = 'Catalogo Vendedores';

    protected static string $view = 'filament.pages.counter-page';
}
 