<?php

namespace App\Filament\Resources\DatoResource\Pages;

use App\Filament\Resources\DatoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDatos extends ListRecords
{
    protected static string $resource = DatoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
