<?php

namespace App\Filament\Resources\IncomeResource\Pages;

use App\Filament\Resources\IncomeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateIncome extends CreateRecord
{
    protected static string $resource = IncomeResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
    
        return $data;
    }

    // protected function handleRecordCreation(array $data): Model
    // {
    //     dump($data);
    //     return static::getModel()::create($data);
    // }

}
