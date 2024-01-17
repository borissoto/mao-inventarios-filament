<?php

namespace App\Filament\Resources\SeasonResource\Pages;

use App\Filament\Resources\SeasonResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSeason extends CreateRecord
{
    protected static string $resource = SeasonResource::class;

    protected static ?string $title = 'Crear Temporada';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
