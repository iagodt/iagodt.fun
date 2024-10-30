<?php

namespace App\Filament\Resources\OrderItemResource\RelationManagers;




use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'items';
    protected static ?string $recordTitleAttribute = 'product_id';
    
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('price')
                    ->required()
                    ->maxLength(255)->label('Price'),
                TextInput::make('quatity')->label('Quantity')
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('product_id')
            ->columns([
                TextColumn::make('product_id')
                    ->label('Product ID')
                    ->sortable(),
                TextColumn::make('price')
                    ->label('Price')
                    ->money('brl') // Ou qualquer outra moeda, se estiver usando um formato de moeda
                    ->sortable(),
                TextColumn::make('quatity')
                    ->label('Quantity')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Added At')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
