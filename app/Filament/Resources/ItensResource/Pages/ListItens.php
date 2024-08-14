<?php

namespace App\Filament\Resources\ItensResource\Pages;

use App\Filament\Resources\ItensResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItens extends ListRecords
{
    protected static string $resource = ItensResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
