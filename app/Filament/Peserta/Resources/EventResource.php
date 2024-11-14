<?php

namespace App\Filament\Peserta\Resources;

use App\Filament\Peserta\Resources\EventResource\Pages;
use App\Filament\Peserta\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Event Name')->sortable()->searchable(),
                TextColumn::make('location')->label('Location')->sortable()->searchable(),
                TextColumn::make('start_time')->label('Start Time')->sortable(),
                BadgeColumn::make('status')
                    ->colors([
                        'primary' => 'Coming Soon',
                        'success' => 'Open',
                        'danger' => 'Closed',
                    ])
                    ->sortable()
                    ->label('Status'),
                TextColumn::make('participant_quota')->label('Quota')->sortable(),
                TextColumn::make('registration_fee')->label('Fee')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'view' => Pages\ViewEvent::route('/{record}'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
