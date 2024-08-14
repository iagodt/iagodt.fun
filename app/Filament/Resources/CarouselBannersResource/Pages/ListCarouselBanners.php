<?php

namespace App\Filament\Resources\CarouselBannersResource\Pages;

use App\Filament\Resources\CarouselBannersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCarouselBanners extends ListRecords
{
    protected static string $resource = CarouselBannersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
