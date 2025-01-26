<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SampahResource\Pages;
use App\Models\Sampah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class SampahResource extends Resource
{
    protected static ?string $model = Sampah::class;

    protected static ?string $navigationIcon = 'heroicon-o-trash';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 2;

    protected static ?string $label = 'Sampah';
    protected static ?string $pluralLabel = 'Data Sampah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('kategori_sampah_id')
                            ->label('Kategori Sampah')
                            ->relationship('kategori', 'nama_kategori')
                            ->required()
                            ->searchable(),

                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Sampah')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->maxLength(65535)
                            ->placeholder('Deskripsi singkat mengenai sampah ini.'),

                        Forms\Components\TextInput::make('harga_per_kg')
                            ->label('Harga per Kilogram')
                            ->numeric()
                            ->required()
                            ->prefix('Rp'),

                        Forms\Components\TextInput::make('poin_per_kg')
                            ->label('Poin per Kilogram')
                            ->numeric()
                            ->required()
                            ->helperText('Jumlah poin yang diperoleh untuk setiap kilogram sampah.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kategori.nama_kategori')
                    ->label('Kategori Sampah'),

                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Sampah')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('harga_per_kg')
                    ->label('Harga per Kilogram')
                    ->money('idr'),

                Tables\Columns\TextColumn::make('poin_per_kg')
                    ->label('Poin per Kilogram'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori_sampah_id')
                    ->label('Kategori Sampah')
                    ->relationship('kategori', 'nama_kategori'),
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
            // Additional relationships can be added here
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSampahs::route('/'),
            'create' => Pages\CreateSampah::route('/create'),
            'edit' => Pages\EditSampah::route('/{record}/edit'),
        ];
    }
}
