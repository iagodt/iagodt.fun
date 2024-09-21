<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItensResource\Pages;
use App\Filament\Resources\ItensResource\RelationManagers;
use App\Models\Itens;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Categories;

class ItensResource extends Resource
{
    protected static ?string $model = Itens::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')->required()->minLength(2),
                Select::make('Category')->required()->options(Categories::all()->pluck('title','id'))->searchable(),
                TextInput::make('Price')->required()->numeric(),
                FileUpload::make('Icon')->image()->required()->directory('item-images'),
                FileUpload::make('Image1')->image()->directory('item-images'),
                FileUpload::make('Image2')->image()->directory('item-images'),
                FileUpload::make('Image3')->image()->directory('item-images'),
                FileUpload::make('Image4')->image()->directory('item-images'),
                FileUpload::make('Image5')->image()->directory('item-images'),
                FileUpload::make('Image6')->image()->directory('item-images'),
                Toggle::make('HOME'),
                TextInput::make('installment'),
                TextInput::make('discount'),
                RichEditor::make('Description')->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                ImageColumn::make('Icon'),
                TextColumn::make('name')->searchable(),
                TextColumn::make('Price')->sortable(),
                ToggleColumn::make('HOME'),
                TextColumn::make('discount')->sortable()
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
            'index' => Pages\ListItens::route('/'),
            'create' => Pages\CreateItens::route('/create'),
            'edit' => Pages\EditItens::route('/{record}/edit'),
        ];
    }
}
