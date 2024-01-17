<?php

namespace App\Filament\Resources\WarehouseResource\Pages;

use App\Filament\Resources\WarehouseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWarehouse extends CreateRecord
{
    protected static string $resource = WarehouseResource::class;

    protected static ?string $title = 'Crear Deposito';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
