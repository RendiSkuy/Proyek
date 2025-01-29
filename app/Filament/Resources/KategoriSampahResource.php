<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriSampahResource\Pages;
use App\Models\KategoriSampah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KategoriSampahResource extends Resource
{
    
    protected static ?string $model = KategoriSampah::class;
    protected static ?string $navigationIcon = 'heroicon-o-trash';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $pluralLabel = 'Data Kategori Sampah';
    protected static ?string $label = 'Kategori Sampah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_kategori')
                    ->label('Nama Kategori')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->maxLength(65535),

                Forms\Components\Select::make('jenis')
                    ->label('Jenis Sampah')
                    ->options([
                        'organik' => 'Organik',
                        'anorganik' => 'Anorganik',
                        'lainnya' => 'Lainnya',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('poin_per_kg')
                    ->label('Poin per Kilogram')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_kategori')
                    ->label('Nama Kategori')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jenis')
                    ->label('Jenis Sampah')
                    ->sortable(),

                Tables\Columns\TextColumn::make('poin_per_kg')
                    ->label('Poin per KG')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d-M-Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis')
                    ->label('Filter Jenis Sampah')
                    ->options([
                        'organik' => 'Organik',
                        'anorganik' => 'Anorganik',
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
            'index' => Pages\ListKategoriSampah::route('/'),
            'create' => Pages\CreateKategoriSampah::route('/create'),
            'edit' => Pages\EditKategoriSampah::route('/{record}/edit'),
        ];
    }
}

