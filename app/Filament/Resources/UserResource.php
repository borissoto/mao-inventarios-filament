<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-s-users';

    protected static ?string $navigationLabel = 'Usuarios';

    protected static ?string $navigationGroup = 'Configuracion Usuarios';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')
                    ->label('Nombres'),
                // TextInput::make('forename')
                //     ->label('Nombres'),
                TextInput::make('p_surname')
                    ->label('Apellido Paterno'),
                TextInput::make('m_surname')
                    ->label('Apellido Materno'),
                TextInput::make('id_number')
                    ->label('CI')
                    ->numeric(),
                Select::make('sex')
                    ->label('Genero')
                    ->options([
                        'Masculino' => 'Masculino',
                        'Femenino' => 'Femenino',
                    ]),
                TextInput::make('mobile')
                    ->label('Celular')
                    ->numeric(),
                TextInput::make('address')
                    ->label('Domicilio'),
                DatePicker::make('start')
                    ->label('Ingreso'),
                TextInput::make('email')
                    ->required(),
                Select::make('status')
                    ->label('Estado')
                    ->options([
                        1 => 'Activo',
                        2 => 'Inactivo',
                    ]),    
                TextInput::make('password')
                    ->required()
                    ->password()
                    ->hiddenOn('edit'),
                Select::make('roles')
                    ->relationship('roles', 'name')
                    ->required()
                   
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('email')
                    ->icon('heroicon-m-envelope')
                    // ->iconColor('primary')
                    ->searchable()
                    ->label('Email'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Nombres'),
                Tables\Columns\TextColumn::make('p_surname')
                    ->searchable()
                    ->label('Ap Paterno'),
                Tables\Columns\TextColumn::make('m_surname')
                    ->searchable()
                    ->label('Ap Materno'),
                Tables\Columns\TextColumn::make('roles.name')
                    ->searchable()
                    ->label('Rol')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'SuperAdmin' => 'success',
                        'Administrador' => 'primary',
                        'Vendedor' => 'gray',
                    }),
                Tables\Columns\TextColumn::make('id_number')
                    ->searchable()
                    ->label('CI'),
                Tables\Columns\TextColumn::make('sex')
                    ->searchable()
                    ->label('Sexo'),
                Tables\Columns\TextColumn::make('mobile')
                    ->searchable()
                    ->label('Cel'),
                Tables\Columns\TextColumn::make('address')
                    ->searchable()
                    ->label('Domicilio'),
                Tables\Columns\TextColumn::make('start')
                    ->searchable()
                    ->label('Ingreso')
                    ->date(),   
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->label('Estado')
                    ->badge()   
                    ->formatStateUsing(function ($record){
                        if ($record->status == 1) {
                            return 'Activo';
                        }elseif ($record->status == 2) {
                            return 'Inactivo';
                        }else{
                            return 's/n';
                        }
                    })                
                    ->color(fn (string $state): string => match ($state) {
                        '1' => 'success',
                        '2' => 'danger',
                    }),
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
