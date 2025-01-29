<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PoinResource\Pages;
use App\Models\Poin;
use App\Models\KategoriSampah;
use App\Models\Sampah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Section;
use Illuminate\Support\Facades\Log;

class PoinResource extends Resource
{
    protected static ?string $model = Poin::class;
    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';
    protected static ?string $navigationGroup = 'Poin';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Select::make('nasabah_id')
                            ->relationship('nasabah', 'nama')
                            ->searchable()
                            ->required()
                            ->label('Nasabah'),

                        Select::make('kategori_sampahs')
                            ->label('Kategori Sampah')
                            ->relationship('kategoriSampahs', 'nama_kategori')
                            ->multiple()
                            ->searchable()
                            ->live()
                            ->afterStateUpdated(fn($state, callable $set, callable $get) => self::hitungTotalPoin($set, $get)),

                        Select::make('sampahs')
                            ->label('Sampah')
                            ->relationship('sampahs', 'nama')
                            ->multiple()
                            ->searchable()
                            ->live()
                            ->afterStateUpdated(fn($state, callable $set, callable $get) => self::hitungTotalPoin($set, $get)),

                        TextInput::make('jumlah')
                        ->label('Total Poin')
                        ->numeric()
                        ->required()
                        ->default(0)
                        ->readonly()  // Gunakan ini sebagai alternatif disabled()
                        ->live(),
                    ])
            ]);
    }

    public static function hitungTotalPoin(callable $set, callable $get)
    {
        $kategoriIds = $get('kategori_sampahs') ?? [];
        $sampahIds = $get('sampahs') ?? [];

        $kategoriPoin = KategoriSampah::whereIn('id', $kategoriIds)->sum('poin_per_kg');
        $sampahPoin = Sampah::whereIn('id', $sampahIds)->sum('poin_per_kg');

        $totalPoin = $kategoriPoin + $sampahPoin;

        Log::info("Total Poin Dihitung di Form: $totalPoin");

        $set('jumlah', $totalPoin);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nasabah.nama')->label('Nama Nasabah')->sortable()->searchable(),
                TextColumn::make('kategoriSampahs.nama_kategori')->label('Kategori Sampah')->badge()->separator(','),
                TextColumn::make('sampahs.nama')->label('Sampah')->badge()->separator(','),
                TextColumn::make('jumlah')->label('Jumlah Poin'),
            ])
            ->filters([
                SelectFilter::make('kategoriSampahs')->label('Kategori Sampah')->relationship('kategoriSampahs', 'nama_kategori'),
                SelectFilter::make('sampahs')->label('Sampah')->relationship('sampahs', 'nama'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Tambah Poin'),
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
