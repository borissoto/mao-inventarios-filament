<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseResource\Pages;
use App\Filament\Resources\PurchaseResource\RelationManagers;
use App\Models\Purchase;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Grouping\Group as GroupingGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PurchaseResource extends Resource
{
    protected static ?string $model = Purchase::class;

    protected static ?string $navigationIcon = 'heroicon-s-shopping-cart';

    protected static ?string $navigationLabel = 'Productos ingresados';

    protected static ?string $navigationGroup = 'Ingresos Almacen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('income_id')
                    ->label('Id Comprobante')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('product_id')
                    ->label('Producto')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('unit_id')
                    ->label('Unidad')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('quantity')
                    ->label('Cantidad')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('pieces')
                    ->label('Piezas')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('weight')
                    ->label('Peso')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('dimensions')
                    ->label('Dimensiones')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('item_no')
                    ->label('Nro Item')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('type')
                    ->label('Abierto')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('expiration_date')
                    ->label('Expira')
                    ->required(),
                Forms\Components\TextInput::make('total_cost')
                    ->label('Costo total')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('unit_price')
                    ->label('Costo unitario')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('sell_price')
                    ->label('Precio unitario')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('box_price')
                    ->label('Precio docena')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('wholesale_price')
                    ->label('Precio x mayor')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // ->modifyQueryUsing(function (Builder $query) {
            //     $query->where('product_id', 2);
            // })
            ->columns([
                Tables\Columns\TextColumn::make('income_id')
                    ->label('Id Comprobante')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Producto')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('product.image_url')
                    ->size(80)
                    ->label('Imagen'),
                Tables\Columns\TextColumn::make('unit.name')
                    ->label('Unidad')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Cajas')
                    ->summarize(Sum::make()->label('Total Cajas'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pieces')
                    ->label('Piezas')
                    // ->summarize(Sum::make()->label('Total Piezas'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('weight')
                    ->label('Peso')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('dimensions')
                    ->label('Dimensiones')
                    ->searchable(),
                Tables\Columns\TextColumn::make('item_no')
                    ->label('Nro Item')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Abierto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('expiration_date')
                    ->label('Expira')
                    ->dateTime()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('total_cost')
                //     ->label('Costo total')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('unit_price')
                //     ->label('Costo unitario')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('sell_price')
                    ->label('Precio unitario')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('box_price')
                    ->label('Precio docena')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('wholesale_price')
                    ->label('Precio x mayor')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->groups([
                //
                GroupingGroup::make('product.name')
                ->label('Producto'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPurchases::route('/'),
            'create' => Pages\CreatePurchase::route('/create'),
            'edit' => Pages\EditPurchase::route('/{record}/edit'),
        ];
    }
}
