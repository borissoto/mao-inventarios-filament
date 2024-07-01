<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DispatchResource\Pages;
use App\Filament\Resources\DispatchResource\RelationManagers;
use App\Models\Dispatch;
use App\Models\Product;
// use App\Models\Dispatch;
use App\Models\Purchase;
use Closure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Grouping\Group as GroupingGroup;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DispatchResource extends Resource
{
    protected static ?string $model = Dispatch::class;

    protected static ?string $navigationIcon = 'heroicon-s-arrow-up-tray';

    protected static ?string $navigationLabel = 'Salida de Productos';

    protected static ?string $navigationGroup = 'Salidas Almacen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('purchase_id')
                    ->label('Producto')
                    ->relationship('purchase', 'id')
                    ->allowHtml()
                    ->getSearchResultsUsing(function (string $search) {
                            $products = Purchase::whereHas('product', function (Builder $query) use($search) {
                            $query->where('name', 'like', "%{$search}%");
                        })->get();
                        // dd($products);
                        return $products->mapWithKeys(function ($product) {
                            return [$product->getKey() => static::getCleanOptionString($product)];
                        })->toArray();
                    })

                    ->getOptionLabelUsing(function ($value): string {
                        $product = Purchase::find($value);
                        return static::getCleanOptionString($product);
                    })
                    ->searchable()
                    ->required(),

                
                // Forms\Components\TextInput::make('total')
                //     ->default(fn ($livewire) => $livewire->product->count() + 1),
                // Forms\Components\Placeholder::make('saldo')
                //     ->label('Saldo')
                //     ->content(fn (Product $record): string => $record->created_at->toFormattedDateString()),
                Forms\Components\TextInput::make('quantity')
                    ->label('Cantidad')
                    ->numeric()
                    // ->rules(['numeric', 'min:1'])                    
                    ->rules([
                        fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                            $purchase_id = $get('purchase_id');
                            $sumquantityout = Dispatch::where('purchase_id', '=', $purchase_id)->sum('quantity');
                            // dd($total_pieces = Purchase::where('id','=',$purchase_id))->value('total_pieces');
                            $total_pieces =  Purchase::where('id', $purchase_id)->pluck('total_pieces')->first();
                            $total_quantity = $value + $sumquantityout;

                            if($value < 1 ){
                                $fail("La cantidad debe ser mayor a 0");
                            }


                            if ($total_quantity > $total_pieces) {
                                $fail("La cantidad sobrepasa el stock");
                            }


                        },                       
                    ])                 
                    // ->maxValue(100)
                    ->required(),
                Forms\Components\DatePicker::make('release_date'),
                // Forms\Components\Select::make('warehouse_id')
                //     ->relationship('warehouse', 'name')
                //     ->required(),
                
            ]);
    }

    public static function getCleanOptionString(Purchase $model): string
    {
        $purchase_id = $model?->id;
        $sumquantityout = Dispatch::where('purchase_id', '=', $purchase_id)->sum('quantity');
        // dd($total_pieces = Purchase::where('id','=',$purchase_id))->value('total_pieces');
        $total_pieces =  Purchase::where('id', $purchase_id)->pluck('total_pieces')->first();
        $total_quantity = $total_pieces - $sumquantityout;

        return view('filament.components.select-purchase')
                    ->with('name', $model?->product->name)
                    ->with('category', $model?->product->category->name)
                    ->with('subcategory', $model?->product->subcategory->name)
                    ->with('image_url', $model?->product->image_url) 
                    ->with('item_mao', $model?->product->item) 
                    ->with('item_source', $model?->item_no) 
                    ->with('total_pieces', $total_quantity) 
                    ->render();
    }
 
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('purchase.product.image_url')
                    ->label('Imagen')
                    ->square()
                    ->size(80), 
                Tables\Columns\TextColumn::make('purchase.income.id')
                    ->label('Comp')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('purchase.income.code')
                    ->label('Codigo')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('purchase.product.name')
                    ->label('Producto')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('purchase.product.item')
                    ->label('Nro Item MAO')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('purchase.item_no')
                    ->label('Nro Item Origen')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Cantidad (Salida)')
                    ->numeric()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('purchase.total_pieces')
                //     ->label('Saldo Piezas')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('release_date')
                    ->label('Fecha')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Usuario')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->defaultSort('created_at', 'desc')
            ->groups([
                //
                GroupingGroup::make('purchase.product.name')
                ->label('Producto'),
                GroupingGroup::make('purchase.income.code')
                ->label('Codigo'),
                GroupingGroup::make('purchase.product.item')
                ->label('Nro Item MAO'),
                GroupingGroup::make('purchase.item_no')
                ->label('Nro Item Origen'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDispatches::route('/'),
            'create' => Pages\CreateDispatch::route('/create'),
            'edit' => Pages\EditDispatch::route('/{record}/edit'),
        ];
    }
}
