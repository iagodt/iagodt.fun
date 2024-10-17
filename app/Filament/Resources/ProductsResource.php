<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductsResource\Pages;
use App\Filament\Resources\ProductsResource\RelationManagers;
use App\Models\attributes;
use App\Models\Categories;
use App\Models\products;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductsResource extends Resource
{
    protected static ?string $model = products::class;

    //protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Produtos';
    protected static ?string $pluralModelLabel = 'Produtos';
    protected static ?string $modelLabel = 'Produto';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')->required()->minLength(2),
                Repeater::make('category')->schema([
                    Select::make('category')->required()->options(Categories::all()->pluck('title','id'))->searchable()
                ]),
                TextInput::make('price')->required()->numeric(),
                TextInput::make('discount'),
                TextInput::make('installment')->required(),
                Repeater::make('images')
                    ->label('Imagens')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Imagem')
                            ->image()
                            ->directory('item-images')
                    ])
                    ->minItems(1)
                    ->maxItems(6) 
                    ->collapsible() 
                    ->required(), 

                Repeater::make('attributeValues')
                    ->relationship()
                    ->schema([
                        Select::make('attribute_id')
                            ->label('Atributo')
                            ->options(attributes::all()->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('value')
                            ->label('Valor')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->createItemButtonLabel('Adicionar Atributo')
                    ->columns(2)
                    ->required(),
                    
                RichEditor::make('description')->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name')->searchable(),
                TextColumn::make('price')->sortable(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProducts::route('/create'),
            'edit' => Pages\EditProducts::route('/{record}/edit'),
        ];
    }
}
