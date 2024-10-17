<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarouselBannersResource\Pages;
use App\Filament\Resources\CarouselBannersResource\RelationManagers;
use App\Models\CarouselBanners;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CarouselBannersResource extends Resource
{
    protected static ?string $model = CarouselBanners::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image')->image(),
                TextInput::make('text above')->required()->minLength(10),
                TextInput::make('main text')->required(),
                TextInput::make('button text')->required(),
                TextInput::make('link')->required(),
                // 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                ImageColumn::make('image'),
                TextColumn::make('main text')->searchable()->sortable(),
                TextColumn::make('link')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCarouselBanners::route('/'),
            'create' => Pages\CreateCarouselBanners::route('/create'),
            'edit' => Pages\EditCarouselBanners::route('/{record}/edit'),
        ];
    }
}
