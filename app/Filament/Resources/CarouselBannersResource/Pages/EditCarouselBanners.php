<?php

namespace App\Filament\Resources\CarouselBannersResource\Pages;

use App\Filament\Resources\CarouselBannersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCarouselBanners extends EditRecord
{
    protected static string $resource = CarouselBannersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
