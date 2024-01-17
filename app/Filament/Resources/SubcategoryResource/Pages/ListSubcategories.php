<?php

namespace App\Filament\Resources\SubcategoryResource\Pages;

use App\Filament\Resources\SubcategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubcategories extends ListRecords
{
    protected static string $resource = SubcategoryResource::class;

    protected static ?string $title = 'Subcategorias';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Crear Subcategoria'),
        ];
    }
}
