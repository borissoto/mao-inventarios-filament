<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IncomeResource\Pages;
use App\Filament\Resources\IncomeResource\RelationManagers;
use App\Models\Income;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IncomeResource extends Resource
{
    protected static ?string $model = Income::class;

    protected static ?string $navigationIcon = 'heroicon-s-clipboard-document-list';

    protected static ?string $navigationLabel = 'Comprobantes Ingreso';

    protected static ?string $navigationGroup = 'Ingresos Almacen';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->label('Tipo Comprobante')
                    ->options([
                        'BL (Bill of lading)' => 'BL (Bill of lading)',
                        'Invoice' => 'Invoice',
                        'Factura' => 'Factura',
                        'Recibo' => 'Recibo',
                        'Nota de Venta' => 'Nota de Venta',
                        'Ingreso Inicial' => 'Ingreso Inicial',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('code')
                    ->label('Nro')
                    ->required(),
                Forms\Components\DatePicker::make('arrival_date')
                    ->label('Fecha Despacho Origen')
                    ->required(),
                Forms\Components\DatePicker::make('shipping_date')
                    ->label('Fecha Ingreso Almacenes')
                    ->required(),
                Forms\Components\Select::make('warehouse_id')
                    ->label('Deposito')
                    ->relationship('warehouse','name')
                    ->required(),
                Forms\Components\Select::make('season_id')
                    ->label('Temporada')
                    ->relationship(name: 'season', titleAttribute:'name', modifyQueryUsing: fn (Builder $query) => $query->orderBy('id'),
                    )
                    ->required(),                
                Forms\Components\Select::make('supplier_id')
                            ->label('Proveedor')
                            ->relationship('supplier', 'name')
                            ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Id Comprobante')
                    ->numeric(),
                Tables\Columns\TextColumn::make('warehouse.name')
                    ->label('Almacen')
                    ->numeric(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo Comp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->label('Nro')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('shipping_date')
                    ->label('Fecha Despacho Origen')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('arrival_date')
                    ->label('Fecha Ingreso Almacen')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('supplier.name')
                    ->label('Proveedor')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('supplier.country.name')
                    ->label('Proveedor Pais')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Registrado por')
                    ->numeric()
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
            ->actions([
                Tables\Actions\EditAction::make()->label('Editar'),
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
            RelationManagers\PurchasesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIncomes::route('/'),
            'create' => Pages\CreateIncome::route('/create'),
            'edit' => Pages\EditIncome::route('/{record}/edit'),
        ];
    }
}
