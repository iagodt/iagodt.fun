<?php

namespace App\Filament\Resources\ItensResource\Pages;

use App\Filament\Resources\ItensResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItens extends EditRecord
{
    protected static string $resource = ItensResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
