<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HighlightsResource\Pages;
use App\Filament\Resources\HighlightsResource\RelationManagers;
use App\Models\Highlights;
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

class HighlightsResource extends Resource
{
    protected static ?string $model = Highlights::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')->required(),
                FileUpload::make('Image')->image()->directory('Highlights-images')->required(),
                TextInput::make('Description')->required(),
                TextInput::make('Link')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('Image'),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('Link')
                //
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
            'index' => Pages\ListHighlights::route('/'),
            'create' => Pages\CreateHighlights::route('/create'),
            'edit' => Pages\EditHighlights::route('/{record}/edit'),
        ];
    }
}
