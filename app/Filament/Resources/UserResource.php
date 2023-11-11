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

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    protected static ?string $navigationLabel = 'Usuarios';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')
                ->label('Usuario'),
                TextInput::make('forename')
                ->label('Nombres'),
                TextInput::make('p_surname')
                ->label('Ap Paterno'),
                TextInput::make('m_surname')
                ->label('Ap Materno'),
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
                TextInput::make('email'),
                TextInput::make('password'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('forename')
                    ->searchable(),
                Tables\Columns\TextColumn::make('p_surname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('m_surname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sex')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mobile')
                    ->searchable(),

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
