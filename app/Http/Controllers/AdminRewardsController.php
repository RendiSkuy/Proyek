<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RewardsResource\Pages;
use App\Models\Reward; // Pastikan model ini sesuai dengan tabel rewards
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class RewardsResource extends Resource
{
    protected static ?string $model = Reward::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';
    protected static ?string $navigationGroup = 'Reward Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        // Nama Reward
                        TextInput::make('name')
                            ->label('Nama Reward')
                            ->required()
                            ->minLength(3)
                            ->maxLength(70),

                        // Kategori Reward
                        TextInput::make('category')
                            ->label('Kategori Reward')
                            ->required()
                            ->helperText('Masukkan salah satu dari: hiasan, peralatan, atau perlengkapan.'),

                        // Deskripsi Reward
                        Textarea::make('description')
                            ->label('Deskripsi Reward')
                            ->required()
                            ->maxLength(255),

                        // Harga dalam Poin
                        TextInput::make('price')
                            ->label('Harga (Poin)')
                            ->required()
                            ->numeric()
                            ->minValue(0),

                        // Foto Reward
                        FileUpload::make('image')
                            ->label('Foto Reward')
                            ->image()
                            ->required()
                            ->maxSize(3000) // 3MB limit
                            ->helperText('Format file yang didukung: JPG, JPEG, PNG, GIF, BMP.'),

                        // Jumlah Stok
                        TextInput::make('stock')
                            ->label('Jumlah Stok')
                            ->required()
                            ->numeric()
                            ->minValue(0),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Nama Reward
                TextColumn::make('name')
                    ->label('Nama Reward')
                    ->sortable()
                    ->searchable(),

                // Kategori Reward
                TextColumn::make('category')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),

                // Deskripsi Reward
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50),

                // Harga (Poin)
                TextColumn::make('price')
                    ->label('Harga (Poin)')
                    ->sortable(),

                // Foto Reward
                ImageColumn::make('image')
                    ->label('Foto')
                    ->rounded(),

                // Jumlah Stok
                TextColumn::make('stock')
                    ->label('Jumlah Stok')
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
            'index' => Pages\ListRewards::route('/'),
            'create' => Pages\CreateReward::route('/create'),
            'edit' => Pages\EditReward::route('/{record}/edit'),
        ];
    }
}
