<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderItemResource\RelationManagers\OrdersRelationManager;
use App\Filament\Resources\OrdersResource\Pages;
use App\Models\order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrdersResource extends Resource
{
    protected static ?string $model = order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('user_id')->label('User ID')->disabled(),
            Forms\Components\TextInput::make('contact')->label('Contact')->required(),
            Forms\Components\TextInput::make('ship_info')->label('Shipping Location')->required(),
            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'processing' => 'Processing',
                    'processed' => 'Processed',
                    'shipped' => 'Shipped',
                    'completed' => 'Completed',
                ])->label('Status')->required(),
            Forms\Components\TextInput::make('total_amount')->label('Total Amount')->disabled(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('id')->label('Order ID')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('user_id')->label('User ID')->searchable(),
            Tables\Columns\TextColumn::make('contact')->label('Contact')->searchable(),
            Tables\Columns\TextColumn::make('ship_info')->label('Shipping Location'),
            Tables\Columns\BadgeColumn::make('status')
                ->label('Status')
                ->formatStateUsing(function ($state) {
                    $statuses = [
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'processed' => 'Processed',
                        'shipped' => 'Shipped',
                        'completed' => 'Completed',
                    ];
                    return $statuses[$state] ?? $state;
                })
                ->colors([
                    'primary',
                    'warning' => 'pending',
                    'info' => 'processing',
                    'gray' => 'processed',
                    'success' => 'completed',
                ]),
            Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
        ])
        ->filters([
            // Exemplo de filtro para pedidos concluídos
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'pending' => 'Pending',
                    'processing' => 'Processing',
                    'processed' => 'Processed',
                    'shipped' => 'Shipped',
                    'completed' => 'Completed',
                ]),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getRelations(): array
    {   
        return [
            OrdersRelationManager::class
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrders::route('/create'),
            'edit' => Pages\EditOrders::route('/{record}/edit'),
        ];
    }
}
