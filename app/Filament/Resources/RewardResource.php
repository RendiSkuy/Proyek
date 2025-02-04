<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RewardResource\Pages;
use App\Models\Reward;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;

class RewardResource extends Resource
{
    protected static ?string $model = Reward::class;
    protected static ?string $navigationIcon = 'heroicon-o-gift';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 3;
    protected static ?string $label = 'Reward';
    protected static ?string $pluralLabel = 'Data Reward';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama_reward')
                            ->label('Nama Reward')
                            ->required()
                            ->maxLength(255),

                        Textarea::make('deskripsi')
                            ->label('Deskripsi Reward')
                            ->maxLength(65535)
                            ->placeholder('// Deskripsi Reward'),

                        TextInput::make('poin_dibutuhkan')
                            ->label('Poin yang Dibutuhkan')
                            ->required()
                            ->numeric()
                            ->helperText('Jumlah poin yang dibutuhkan untuk menukarkan reward ini.'),

                        TextInput::make('stok')
                            ->label('Jumlah Stok')
                            ->required()
                            ->numeric()
                            ->helperText('Jumlah stok yang tersedia untuk reward ini.'),

                        Select::make('kategori')
                            ->label('Kategori Reward')
                            ->options([
                                'Hiasan' => 'Hiasan',
                                'Peralatan' => 'Peralatan Alat Rumah Tangga',
                                'Kebutuhan Keluarga' => 'Kebutuhan Keluarga',
                                'lainnya' => 'Lainnya',
                            ])
                            ->required()
                            ->searchable(),

                        FileUpload::make('gambar')
                            ->label('Gambar Reward')
                            ->image()
                            ->directory('uploads/rewards')
                            ->maxSize(2048)
                            ->nullable(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('gambar')
                    ->label('Gambar')
                    ->circular(),

                TextColumn::make('nama_reward')
                    ->label('Nama Reward')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('kategori')
                    ->label('Kategori Reward')
                    ->sortable(),

                TextColumn::make('poin_dibutuhkan')
                    ->label('Poin Dibutuhkan'),

                TextColumn::make('stok')
                    ->label('Jumlah Stok'),
            ])
            ->filters([
                SelectFilter::make('kategori')
                    ->label('Filter Kategori')
                    ->options([
                        'Hiasan' => 'Hiasan',
                        'Peralatan' => 'Peralatan Alat Rumah Tangga',
                        'Kebutuhan' => 'Kebutuhan Keluarga',
                        'lainnya' => 'Lainnya',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
