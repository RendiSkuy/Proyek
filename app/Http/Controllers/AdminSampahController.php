<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SampahResource\Pages;
use App\Models\Sampah;
use App\Models\SampahCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class SampahResource extends Resource
{
    protected static ?string $model = Sampah::class;

    protected static ?string $navigationIcon = 'heroicon-o-trash';
    protected static ?string $navigationGroup = 'Manajemen Sampah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    // Nama Sampah
                    TextInput::make('name')
                        ->label('Nama Sampah')
                        ->required()
                        ->minLength(3)
                        ->maxLength(70)
                        ->placeholder('Masukkan nama sampah'),

                    // Kategori Sampah
                    Select::make('category_id')
                        ->label('Kategori Sampah')
                        ->relationship('category', 'name') // Relasi ke tabel kategori
                        ->required()
                        ->searchable(),

                    // Gambar Sampah
                    FileUpload::make('image')
                        ->label('Gambar Sampah')
                        ->image()
                        ->directory('sampah-images')
                        ->maxSize(3000)
                        ->helperText('File yang didukung: JPG, PNG, GIF. Maksimal 3MB.')
                        ->required(),

                    // Harga per Kg
                    TextInput::make('price_per_kg')
                        ->label('Harga per Kg')
                        ->numeric()
                        ->minValue(0)
                        ->required()
                        ->placeholder('Masukkan harga sampah per kilogram'),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom Nama Sampah
                TextColumn::make('name')
                    ->label('Nama Sampah')
                    ->sortable()
                    ->searchable(),

                // Kolom Kategori Sampah
                TextColumn::make('category.name')
                    ->label('Kategori Sampah')
                    ->sortable()
                    ->searchable(),

                // Kolom Gambar
                ImageColumn::make('image')
                    ->label('Gambar'),

                // Kolom Harga per Kg
                TextColumn::make('price_per_kg')
                    ->label('Harga per Kg')
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
            'index' => Pages\ListSampah::route('/'),
            'create' => Pages\CreateSampah::route('/create'),
            'edit' => Pages\EditSampah::route('/{record}/edit'),
        ];
    }
}
