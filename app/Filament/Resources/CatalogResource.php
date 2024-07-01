<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CatalogResource\Pages;
use App\Filament\Resources\CatalogResource\RelationManagers;
use App\Models\Catalog;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\View;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class CatalogResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Catalogo';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->contentGrid([
                'md' => 1,
                'xl' => 2,
            ])
            ->columns([
                Split::make([
                // Tables\Columns\ImageColumn::make('image_url')
                //     ->label('Imagen')
                //     ->size(80),
                Tables\Columns\TextColumn::make('name')
                    ->label('Producto'),
                Tables\Columns\TextColumn::make('item')
                    ->label('Item'),
                // Tables\Columns\TextColumn::make('description')
                //     ->label('Descripcion')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('stock_in')
                //     ->label('En Almacenes')
                //     ->numeric()
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('category.name')
                //     ->label('Categoria')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('subcategory.name')
                //     ->label('Subcategoria')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('sell_price')
                //     ->label('Precio Unitario')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('wholesale_price')
                //     ->label('Precio Mayor')
                //     ->numeric()
                //     ->sortable(),                
                // Tables\Columns\TextColumn::make('box_price')
                //     ->label('Precio Caja')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('user.name')
                //     ->label('Registrado por')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('type')
                //     ->label('Open Box')
                //     ->searchable(),
                ])->from('sm'),
                View::make('filament.components.card')
            ])
            // ->collapsible()
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('download')
                ->label('PDF')
                ->form([
                    Checkbox::make('is_unit')
                        ->label('Mostrar Precio Unitario')
                        ->live(),
                    Checkbox::make('is_wholesome')
                        ->label('Mostrar Precio por Mayor')
                        ->live(),
                    Checkbox::make('is_box')
                        ->label('Mostrar Precio por Caja')
                        ->live(),
                    // ->dehydrated()
                    // ->afterStateUpdated(fn(Livewire $livewire) => dd($livewire))
                ])
                // ->requiresConfirmation()
                ->action( function (Product $record, array $data): void {
                    $unit  = $data['is_unit'];
                    $box  = $data['is_box'];
                    $wholesome  = $data['is_wholesome'];
                    // $price2 = $data[1];
                    // dd($data['is_unit'], $data['is_box'], $data['is_wholesome']);
                    redirect()->route('download.product', ['id' => $record, 'unit' => $unit, 'box' => $box, 'wholesome' => $wholesome]);
                })
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
            'index' => Pages\ListCatalogs::route('/'),
            // 'create' => Pages\CreateCatalog::route('/create'),
            // 'edit' => Pages\EditCatalog::route('/{record}/edit'),
        ];
    }
}
