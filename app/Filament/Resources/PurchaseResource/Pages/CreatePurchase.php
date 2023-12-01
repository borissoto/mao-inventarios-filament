<?php

namespace App\Filament\Resources\PurchaseResource\Pages;

use App\Filament\Resources\PurchaseResource;
use App\Models\Purchase;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreatePurchase extends CreateRecord
{
    protected static string $resource = PurchaseResource::class;

    protected static ?string $title = 'Crear Compra';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // $pcs = $data['pieces'];
        // $product_id = $data['product_id'];

        // $sumpcs = Purchase::sum('pieces')->where('id', $product_id);

        dump($data);
    
        return $data;
        dump($data);
    }

    protected function handleRecordCreation(array $data): Model
    
    {
        dump($data);
        return static::getModel()::create($data);
    }
}
 