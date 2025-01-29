<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiDetailResource\Pages;
use App\Models\TransaksiDetail;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class TransaksiDetailResource extends Resource
{
    protected static ?string $model = TransaksiDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?int $navigationSort = 2;
    protected static ?string $pluralLabel = 'Data Transaksi Detail';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('transaksi_id')
                    ->label('Transaksi')
                    ->relationship('transaksi', 'kode_transaksi')
                    ->required(),

                Forms\Components\Select::make('sampah_id')
                    ->label('Sampah')
                    ->relationship('sampah', 'nama')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $sampah = \App\Models\Sampah::find($state);
                        $set('harga', $sampah ? $sampah->harga_per_kg : null);
                        $set('poin', $sampah ? $sampah->poin_per_kg : null);
                    }),

                Forms\Components\TextInput::make('berat')
                    ->label('Berat (Kg)')
                    ->numeric()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $set('harga', $get('harga') * $state);
                        $set('poin', $get('poin') * $state);
                    }),

                Forms\Components\TextInput::make('harga')
                    ->label('Harga (Rp)')
                    ->disabled(),

                Forms\Components\TextInput::make('poin')
                    ->label('Poin')
                    ->disabled(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transaksi.kode_transaksi')
                    ->label('Kode Transaksi')
                    ->searchable(),

                Tables\Columns\TextColumn::make('sampah.nama')
                    ->label('Sampah')
                    ->searchable(),

                Tables\Columns\TextColumn::make('berat')
                    ->label('Berat (Kg)')
                    ->sortable(),

                Tables\Columns\TextColumn::make('harga')
                    ->label('Harga (Rp)')
                    ->money('idr'),

                Tables\Columns\TextColumn::make('poin')
                    ->label('Poin'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('transaksi_id')
                    ->label('Transaksi')
                    ->relationship('transaksi', 'kode_transaksi'),

                Tables\Filters\SelectFilter::make('sampah_id')
                    ->label('Sampah')
                    ->relationship('sampah', 'nama'),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransaksiDetails::route('/'),
            'create' => Pages\CreateTransaksiDetail::route('/create'),
            'edit' => Pages\EditTransaksiDetail::route('/{record}/edit'),
        ];
    }
}
