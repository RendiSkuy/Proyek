<?php

namespace App\Filament\Resources;

use App\Models\Poin;
use App\Models\Nasabah;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use App\Filament\Resources\PoinResource\Pages;

class PoinResource extends Resource
{
    protected static ?string $model = Poin::class;

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';
    protected static ?string $navigationGroup = 'Poin';
    protected static ?string $pluralLabel = 'Manajemen Poin';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('nasabah_id')
                    ->label('Nasabah')
                    ->relationship('nasabah', 'nama')
                    ->required()
                    ->searchable(),

                Forms\Components\TextInput::make('jumlah')
                    ->label('Total Poin')
                    ->numeric()
                    ->disabled()
                    ->default(0),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nasabah.nama')->label('Nama Nasabah')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('jumlah')->label('Jumlah Poin')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('nasabah_id')
                    ->label('Nasabah')
                    ->relationship('nasabah', 'nama'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPoins::route('/'),
            'create' => Pages\CreatePoin::route('/create'),
            'edit' => Pages\EditPoin::route('/{record}/edit'),
        ];
    }
}
