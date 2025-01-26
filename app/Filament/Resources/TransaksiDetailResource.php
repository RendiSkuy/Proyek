<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiDetailResource\Pages;
use App\Models\TransaksiDetail;
use App\Models\Sampah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TransaksiDetailResource extends Resource
{
    protected static ?string $model = TransaksiDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('transaksi_id')
                            ->label('Transaksi')
                            ->relationship('transaksi', 'kode_transaksi')
                            ->required(),

                        Forms\Components\Select::make('sampah_id')
                            ->label('Jenis Sampah')
                            ->relationship('sampah', 'nama')
                            ->required(),

                        Forms\Components\TextInput::make('berat')
                            ->label('Berat Sampah (Kg)')
                            ->required()
                            ->numeric()
                            ->helperText('Masukkan berat sampah dalam kilogram.'),

                        Forms\Components\TextInput::make('harga_per_kg')
                            ->label('Harga per Kg (Rp)')
                            ->required()
                            ->numeric()
                            ->prefix('Rp'),

                        Forms\Components\TextInput::make('subtotal')
                            ->label('Subtotal (Rp)')
                            ->disabled()
                            ->numeric()
                            ->prefix('Rp')
                            ->helperText('Subtotal dihitung secara otomatis berdasarkan berat dan harga per kg.'),

                        Forms\Components\TextInput::make('poin')
                            ->label('Poin Diperoleh')
                            ->disabled()
                            ->numeric()
                            ->helperText('Poin dihitung secara otomatis berdasarkan berat sampah.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transaksi.kode_transaksi')
                    ->label('Kode Transaksi')
                    ->searchable(),

                Tables\Columns\TextColumn::make('sampah.nama')
                    ->label('Jenis Sampah')
                    ->searchable(),

                Tables\Columns\TextColumn::make('berat')
                    ->label('Berat (Kg)')
                    ->sortable(),

                Tables\Columns\TextColumn::make('harga_per_kg')
                    ->label('Harga per Kg (Rp)')
                    ->money('idr')
                    ->sortable(),

                Tables\Columns\TextColumn::make('subtotal')
                    ->label('Subtotal (Rp)')
                    ->money('idr'),

                Tables\Columns\TextColumn::make('poin')
                    ->label('Poin Diperoleh')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Transaksi')
                    ->dateTime('d-M-Y H:i'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('sampah_id')
                    ->label('Filter Sampah')
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
        return [
            //
        ];
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
