<?php

namespace App\Filament\Resources\TrainResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\TrainResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTrain extends CreateRecord
{
    protected static string $resource = TrainResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['company_id'] = Auth::user()->company_id;
        return $data;
    }

}
