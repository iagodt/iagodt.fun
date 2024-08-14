<?php

namespace App\Filament\Resources\HighlightsResource\Pages;

use App\Filament\Resources\HighlightsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHighlights extends ListRecords
{
    protected static string $resource = HighlightsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
