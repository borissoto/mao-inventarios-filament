<?php

namespace App\Filament\Resources\IncomeResource\RelationManagers;

use App\Models\Product;
use App\Models\Purchase;
use Filament\Actions\CreateAction;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class PurchasesRelationManager extends RelationManager
{
    protected static string $relationship = 'purchases';

    
    public function form(Form $form): Form
    {
        return $form
            ->schema([             
                Tabs::make('Compras')
                ->tabs([
                    Tabs\Tab::make('Informacion Caja')
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            Forms\Components\Select::make('product_id')
                                ->label('Producto')
                                ->relationship('product','name')
                                ->allowHtml()
                                ->searchable()
                                ->getSearchResultsUsing(function (string $search) {
                                    $users = Product::where('name', 'like', "%{$search}%")->limit(50)->get();
                                    return $users->mapWithKeys(function ($user) {
                                        return [$user->getKey() => static::getCleanOptionString($user)];
                                    })->toArray();
                                })
                                ->getOptionLabelUsing(function ($value): string {
                                    $user = Product::find($value);
                                    return static::getCleanOptionString($user);
                                })
                                ->required(),              
                            Forms\Components\Select::make('unit_id')
                                ->label('Unidad')
                                ->relationship('unit', 'name')
                                ->required(),
                            Forms\Components\TextInput::make('quantity')
                                ->label('Cantidad de Cajas')
                                ->required()
                                ->live()
                                ->numeric(),
                            Forms\Components\TextInput::make('weight')
                                ->label('Peso(Kg)')
                                ->required()
                                ->numeric(),
                            Forms\Components\TextInput::make('dimensions')
                                ->label('Dimensiones (ej: 30x30x30)')
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
                            Forms\Components\DatePicker::make('expiration_date')
                                ->label('Expira')    
                                ->required(),
                        ]),
                    Tabs\Tab::make('Costo Origen')
                        ->icon('heroicon-o-truck')
                        ->schema([
                            Forms\Components\TextInput::make('int_custom_cost')
                                ->label('Aduana Internacional')
                                ->live()    
                                ->numeric(),
                            Forms\Components\TextInput::make('national_custom_cost')
                                ->label('Aduana Nacional')    
                                ->live()
                                ->numeric(),
                            Forms\Components\TextInput::make('int_trans_cost')
                                ->label('Transporte Internacional')
                                ->live()
                                ->numeric(),
                            Forms\Components\TextInput::make('national_trans_cost')
                                ->label('Transporte Nacional')
                                ->live()
                                ->numeric(),
                            Forms\Components\TextInput::make('container_cost')
                                ->label('Contenedor')
                                ->live()
                                ->numeric(),
                            Forms\Components\Placeholder::make('total_origen')
                                ->label('Costo Total Origen x Caja')    
                                ->live()
                                ->reactive()
                                ->content(function($get){
                                    if($get('quantity')==0){
                                        return 'Inserte cantidad de cajas';
                                    }else{
                                        return ($get('int_custom_cost') + $get('national_custom_cost') + $get('int_trans_cost') + $get('national_trans_cost') + $get('container_cost'))/ $get('quantity');
                                    }
                                }), 
                                Forms\Components\TextInput::make('source_cost')
                                ->label('Costo Total Origen x Caja')
                                ->live()
                                ->numeric(),                           
                        ]),
                    Tabs\Tab::make('Precios')
                        ->icon('heroicon-o-currency-dollar')
                        ->schema([
                            Forms\Components\TextInput::make('total_cost')
                                ->label('Costo x Caja')    
                                ->required()
                                ->live()
                                ->numeric(),
                            Forms\Components\TextInput::make('pieces')
                                ->label('Piezas x Caja')
                                ->required()
                                ->live()
                                ->numeric(),
                            Forms\Components\Placeholder::make('costo_unitario')
                                ->label('Costo x Pieza')   
                                ->live() 
                                ->reactive()
                                ->content(function($get){
                                    if($get('total_cost') == 0 || $get('pieces') == 0){
                                       return 0;
                                    }else{
                                        return $get('total_cost') / $get('pieces');
                                    }
                                }),
                            Forms\Components\TextInput::make('unit_cost')
                                ->label('Costo x Pieza')
                                ->required()
                                ->live()
                                ->numeric(),
                            // Forms\Components\Placeholder::make('costo_origen')
                            //     ->label('Costo Origen'), 
                                // ->content(function($get){
                                //     return $get('source_cost') + $get('unit_cost');
                                //  }),
                            Forms\Components\Placeholder::make('costo_minimo')
                                ->label('Costo Minimo x Pieza')  
                                ->live()  
                                ->content(function($get){
                                    if($get('pieces')==0 || $get('source_cost')==0){
                                        return 'Inserte cantidad de cajas';
                                    }else{
                                        return ($get('source_cost') / $get('pieces')) + $get('unit_cost');
                                    }
                                }),
                            Forms\Components\TextInput::make('minimum_cost')
                                ->label('Costo Minimo x Pieza')
                                ->required()
                                ->live()
                                ->numeric(),
                            Forms\Components\TextInput::make('profit_percentage')
                                ->label('Ganancia x Caja (Porcentaje)')
                                ->required()
                                ->live()
                                ->numeric(),
                            Forms\Components\Placeholder::make('costo_minimo')
                                ->label('Precio a la Venta')  
                                ->live()  
                                ->content(function($get){
                                    if($get('total_cost')==0 || $get('pieces')==0 || $get('profit_percentage')==0){
                                        return 'Inserte Costo por Caja';
                                    }else{
                                        return (($get('total_cost') / $get('pieces')) * $get('profit_percentage') / 100)+$get('minimum_cost').'Bs.';
                                    }
                                }),
                            
                            Forms\Components\TextInput::make('sell_price')
                                ->label('Precio Pieza')    
                                ->required()
                                ->numeric(),
                            Forms\Components\TextInput::make('box_price')
                                ->label('Precio Pieza Docena')    
                                ->required()
                                ->numeric(),
                            Forms\Components\TextInput::make('wholesale_price')
                                ->label('Precio Pieza x Mayor')    
                                ->required()
                                ->numeric(),
                        ]),
                        
                  
                ])->columnSpanFull()
                
            ])->columns(3);
    }

    public static function getCleanOptionString(Product $model): string
    {
        return view('filament.components.select-user-result')
                    ->with('name', $model?->name)
                    ->with('category', $model?->category->name)
                    ->with('subcategory', $model?->subcategory->name)
                    ->with('image_url', $model?->image_url)
                    ->render();
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\ImageColumn::make('product.image_url')
                    ->label('Imagen')
                    ->size(80),
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Producto'),
                Tables\Columns\TextColumn::make('product.category.name')
                    ->label('Categoria'),
                Tables\Columns\TextColumn::make('unit.name')
                    ->label('Unidad')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Cajas')
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
                    ->date()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('total_cost')
                //     ->label('Costo Total')
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
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        // This is the test.
                        $pcs = $data['pieces'];
                        $boxs = $data['quantity'];
                        $unit = $data['sell_price'];
                        $box = $data['box_price'];
                        $wholesale = $data['wholesale_price'];
                        $product_id = $data['product_id'];

                        $sumpcs = Purchase::where('product_id','=',$product_id)->sum('pieces');
                        $sumboxs = Purchase::where('product_id','=',$product_id)->sum('quantity');

                        $totalpcs = $pcs+$sumpcs;
                        $totalbox = $boxs+$sumboxs;
                        $total = $totalpcs * $totalbox;
                        // dump($pcs, $product_id, $total);
                        // Product::updateOrCreate( ['id' => $product_id], ['stock_in' => $total]);
                        DB::table('products')->updateOrInsert(['id' => $product_id], ['stock_in'=>$total]);
                        DB::table('products')->updateOrInsert(['id' => $product_id], ['sell_price'=>$unit]);
                        DB::table('products')->updateOrInsert(['id' => $product_id], ['box_price'=>$box]);
                        DB::table('products')->updateOrInsert(['id' => $product_id], ['wholesale_price'=>$wholesale]);

                       
                        return $data;
                    }),
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
