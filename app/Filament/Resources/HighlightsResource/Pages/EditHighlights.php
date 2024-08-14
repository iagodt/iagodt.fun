<?php

namespace App\Filament\Resources\HighlightsResource\Pages;

use App\Filament\Resources\HighlightsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHighlights extends EditRecord
{
    protected static string $resource = HighlightsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
