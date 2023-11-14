<?php

namespace App\Filament\Resources\PurchaseResource\Pages;

use App\Filament\Resources\PurchaseResource;
use App\Models\Purchase;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPurchase extends EditRecord
{
    protected static string $resource = PurchaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $pcs = $data['pieces'];
        $product_id = $data['product_id'];

        $sumpcs = Purchase::sum('pieces')->where('id', $product_id);

        dd($data);
    
        return $data;
    }
}
