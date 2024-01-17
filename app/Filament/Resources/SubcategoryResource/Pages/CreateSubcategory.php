<?php

namespace App\Filament\Resources\SubcategoryResource\Pages;

use App\Filament\Resources\SubcategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSubcategory extends CreateRecord
{
    protected static string $resource = SubcategoryResource::class;

    protected static ?string $title = 'Crear Subcategoria';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
