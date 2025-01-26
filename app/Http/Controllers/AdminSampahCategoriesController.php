<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriSampahResource\Pages;
use App\Models\KategoriSampah;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

class SampahCategoriesResource extends Resource
{
    protected static ?string $model = KategoriSampah::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive';
    protected static ?string $navigationGroup = 'Data Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        // Nama Kategori
                        TextInput::make('name')
                            ->label('Nama Kategori')
                            ->required()
                            ->minLength(3)
                            ->maxLength(70)
                            ->placeholder('Masukkan nama kategori sampah'),

                        // Deskripsi
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Masukkan deskripsi kategori sampah'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Nama Kategori
                TextColumn::make('name')
                    ->label('Nama Kategori')
                    ->sortable()
                    ->searchable(),

                // Deskripsi
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->sortable(),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Tambahkan relasi jika diperlukan
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKategoriSampahs::route('/'),
            'create' => Pages\CreateKategoriSampahs::route('/create'),
            'edit' => Pages\EditKategoriSampahs::route('/{record}/edit'),
        ];
    }
}
