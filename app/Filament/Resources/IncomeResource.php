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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->label('Tipo Comp')
                    ->options([
                        'Factura' => 'Factura',
                        'Recibo' => 'Recibo',
                        'Nota de Venta' => 'Nota de Venta',
                        'Ingreso Inicial' => 'Ingreso Inicial',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('code')
                    ->label('Nro')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('warehouse_id')
                    ->relationship('warehouse','name')
                    ->required(),
                
                Forms\Components\Select::make('season_id')
                    ->relationship(name: 'season', titleAttribute:'name', modifyQueryUsing: fn (Builder $query) => $query->orderBy('id'),
                    )
                    ->required(),
                
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\Select::make('country')
                    ->label('Pais')
                    ->options([
                        'CHINA' => 'China',
                        'PERU' => 'Peru',
                        'COLOMBIA' => 'Colombia',
                    ])
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
                Tables\Columns\TextColumn::make('warehouse_id')
                    ->label('Deposito')
                    ->numeric(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo Comp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->label('Nro')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Fecha ingreso')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('country')
                    ->label('Pais')
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
