<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
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
                TextInput::make('name')
                    ->required()
                    ->label('Event Name'),
                TextInput::make('location')
                    ->required()
                    ->label('Location'),
                DateTimePicker::make('start_time')
                    ->required()
                    ->label('Start Time'),
                Select::make('status')
                    ->options([
                        'Coming Soon' => 'Coming Soon',
                        'Open' => 'Open',
                        'Closed' => 'Closed',
                    ])
                    ->default('Coming Soon')
                    ->label('Status')
                    ->required(),
                TextInput::make('participant_quota')
                    ->numeric()
                    ->required()
                    ->label('Participant Quota'),
                TextInput::make('registration_fee')
                    ->numeric()
                    ->required()
                    ->label('Registration Fee'),
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
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
