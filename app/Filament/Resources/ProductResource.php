<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-s-gift';

    protected static ?string $navigationLabel = 'Productos';

    protected static ?string $navigationGroup = 'Ingresos Almacen';

    protected static ?int $navigationSort = 1;

    public $sell_price;
    public $sell_box;
    public $sell_wholesome;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([                
                Forms\Components\Select::make('category_id')
                    ->label('Categoria')
                    ->relationship('category', 'name')
                    ->preload()
                    ->live()
                    ->afterStateUpdated(fn (Set $set) => $set('subcategory_id', null))
                    ->required(),
                Forms\Components\Select::make('subcategory_id')
                    ->label('Subcategoria')
                    ->options(fn (Get $get): Collection => Subcategory::query()
                        ->where('category_id', $get('category_id'))
                        ->pluck('name','id'))
                    ->searchable()
                    ->live()
                    ->required(),                
                Forms\Components\TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('item')
                    ->label('Item Ingreso')
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                            ->label('Tipo de Caja')
                            ->options([
                                'Armada' => 'Armada',
                                'Desarmada' => 'Desarmada'
                            ]),              
                Forms\Components\TextInput::make('description')
                    ->label('Descripcion')
                    ->maxLength(255),                
                Forms\Components\TextInput::make('sell_price')
                    ->label('Precio Unitario')
                    ->numeric(),
                Forms\Components\TextInput::make('wholesale_price')
                    ->label('Precio x Mayor')
                    ->numeric(),
                Forms\Components\TextInput::make('box_price')
                    ->label('Precio x Caja')
                    ->numeric(),
                Forms\Components\TextInput::make('liquidation_price')
                    ->label('Precio Liquidacion')
                    ->numeric(),
                Forms\Components\FileUpload::make('image_url')
                    ->label('Imagen')
                    ->image()
                    ->maxSize(512)
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth('1280')
                    ->imageResizeTargetHeight('720')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Imagen')
                    ->square()
                    ->size(80),                
                Tables\Columns\TextColumn::make('item')
                    ->label('Item Nro')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('stock_in')
                    ->label('En Almacenes')
                    ->numeric()
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Categoria')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subcategory.name')
                    ->label('Subcategoria')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo')
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descripcion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sell_price')
                    ->label('Precio Unitario')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('wholesale_price')
                    ->label('Precio Mayor')
                    ->numeric()
                    ->sortable(),                
                Tables\Columns\TextColumn::make('box_price')
                    ->label('Precio Caja')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('liquidation_price')
                    ->label('Precio Liquidacion')
                    ->numeric()
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
                // ->url(fn (Get $get): bool => $get('is_unit'))
                // ->url(function(Product $record, Get $get): string { 
                //     // $unit = $get('is_unit');
                //     dd($get('is_unit'));
                //     return route('download.product', ['id' => $record, 'unit' => '0']);
                //     })
                // ->url(
                //     fn (Product $record): string => route('download.product', ['record' => $record]),
                //     shouldOpenInNewTab: true
                // )
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),                                 
                ]),                
            ])
            ->recordClasses(fn (Product $record) => match ($record->name) {
                'draft' => 'opacity-30',
                '11' => 'border-s-2 border-orange-600 dark:border-orange-300',
                'Juguetes' => 'border-s-2 border-green-600 dark:border-green-300',
                default => null,
            });
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool{
        $user = auth()->user()->roles->pluck('name')[0];
        // dd($user);
        if($user == 'SuperAdmin' || $user == 'Administrador'){
            return true;
        }else{
            return false;
        }
    }

}
