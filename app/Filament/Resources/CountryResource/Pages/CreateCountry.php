<?php

namespace App\Filament\Resources\CountryResource\Pages;

use App\Filament\Resources\CountryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCountry extends CreateRecord
{
    protected static string $resource = CountryResource::class;

    protected static ?string $title = 'Crear Pais';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}