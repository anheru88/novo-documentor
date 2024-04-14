<?php

namespace App\Filament\Resources\VariableResource\Pages;

use App\Filament\Resources\VariableResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageVariables extends ManageRecords
{
    protected static string $resource = VariableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
