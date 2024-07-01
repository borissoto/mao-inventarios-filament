<?php

namespace App\Filament\Resources\DispatchResource\Pages;

use App\Filament\Resources\DispatchResource;
use App\Models\Dispatch;
use App\Models\Product;
use App\Models\Purchase;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;

class CreateDispatch extends CreateRecord
{
    protected static string $resource = DispatchResource::class;

    protected static ?string $title = 'Crear Salida';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // dd($data);
        $data['user_id'] = auth()->id();
        $purchase = $data['purchase_id'];
        $quantity = $data['quantity'];

        $product = Purchase::select('product_id')->where('id','=',$purchase);

        $sum_quantity_out = Dispatch::where('purchase_id','=',$purchase)->sum('quantity');

        $sum_stock_out = $quantity + $sum_quantity_out;    

        
        // $stock_in = Product::select('stock_in')->where('product_id','=',$product);
        
        DB::table('products')->updateOrInsert(['id' => $product], ['stock_out'=>$sum_stock_out]);

        // DB::table('products')->updateOrInsert(['id'=>$product], ['stock_out'=>$stock_out]);
    
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
