<?php

namespace App\Filament\Resources\DatoResource\Pages;

use App\Filament\Resources\DatoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDato extends EditRecord
{
    protected static string $resource = DatoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
