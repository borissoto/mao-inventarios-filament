<?php

namespace App\Filament\Resources\CountryResource\Pages;

use App\Filament\Resources\CountryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCountries extends ManageRecords
{
    protected static string $resource = CountryResource::class;

    protected static ?string $navigationLabel = 'Paises';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Crear Pais'),
        ];
    }
}
