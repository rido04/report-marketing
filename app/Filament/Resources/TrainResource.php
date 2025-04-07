<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Train;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TrainResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TrainResource\RelationManagers;

class TrainResource extends Resource
{
    protected static ?string $model = Train::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('company_id', Auth::user()->company_id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('company_id')
                ->default(Auth::user()->company_id),
                TextInput::make('media_name')->required(),
                TextInput::make('station_name')->required(),
                DatePicker::make('display_date')->required(),
                TextInput::make('device_name'),
                TextInput::make('longitude'),
                TextInput::make('latitude'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('media_name')->searchable(),
                TextColumn::make('station_name'),
                TextColumn::make('display_date')->date(),
                TextColumn::make('device_name'),
                TextColumn::make('longitude'),
                TextColumn::make('latitude'),
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
            'index' => Pages\ListTrains::route('/'),
            'create' => Pages\CreateTrain::route('/create'),
            'edit' => Pages\EditTrain::route('/{record}/edit'),
        ];
    }
}
