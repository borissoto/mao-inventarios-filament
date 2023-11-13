<?php

namespace App\Filament\Resources\IncomeResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PurchasesRelationManager extends RelationManager
{
    protected static string $relationship = 'purchases';

    public function form(Form $form): Form
    {
        return $form
            ->schema([                
                Forms\Components\Select::make('product_id')
                    ->label('Producto')
                    ->relationship('product','name')
                    ->required(),
                Forms\Components\Select::make('unit_id')
                    ->label('Unidad')
                    ->relationship('unit', 'name')
                    ->required(),
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
                Forms\Components\Select::make('type')
                    ->label('Tipo de Caja')
                    ->options([
                        'Armada' => 'Armada',
                        'Desarmada' => 'Desarmada'
                    ])
                    ->required(),
                Forms\Components\DateTimePicker::make('expiration_date')
                    ->label('Expira')    
                    ->required(),
                Forms\Components\TextInput::make('total_cost')
                    ->label('Costo Total')    
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Producto'),
                Tables\Columns\TextColumn::make('unit.name')
                    ->label('Unidad')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Cantidad')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pieces')
                    ->label('Piezas')
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
                    ->label('Open Box')
                    ->searchable(),
                Tables\Columns\TextColumn::make('expiration_date')
                    ->label('Expira')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_cost')
                    ->label('Costo Total')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('unit_price')
                    ->label('Costo unitario')
                    ->numeric()
                    ->sortable(),
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
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
