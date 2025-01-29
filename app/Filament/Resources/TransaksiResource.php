<?php

namespace App\Filament\Resources;

use App\Models\Transaksi;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use App\Filament\Resources\TransaksiResource\Pages;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = 'Transaksi';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('nasabah_id')
                            ->label('Nasabah')
                            ->relationship('nasabah', 'nama')
                            ->required()
                            ->searchable(),
    
                        Forms\Components\TextInput::make('kode_transaksi')
                            ->label('Kode Transaksi')
                            ->default(fn () => 'TRX-' . now()->format('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(6)))
                            ->disabled(),
    
                        Forms\Components\DatePicker::make('tanggal')
                            ->label('Tanggal')
                            ->default(now()->format('Y-m-d'))
                            ->required(),
    
                        Forms\Components\Repeater::make('details')
                            ->label('Detail Transaksi')
                            ->relationship()
                            ->schema([
                                Forms\Components\Select::make('sampah_id')
                                    ->label('Jenis Sampah')
                                    ->relationship('sampah', 'nama')
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, $set, $get) {
                                        $sampah = \App\Models\Sampah::find($state);
                                        $berat = $get('berat') ?? 0;
    
                                        if ($sampah) {
                                            $set('harga', $sampah->harga_per_kg * $berat);
                                            $set('poin', $sampah->poin_per_kg * $berat);
                                        }
                                    }),
    
                                Forms\Components\TextInput::make('berat')
                                    ->label('Berat (Kg)')
                                    ->numeric()
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, $set, $get) {
                                        $sampah = \App\Models\Sampah::find($get('sampah_id'));
    
                                        if ($sampah) {
                                            $set('harga', $sampah->harga_per_kg * $state);
                                            $set('poin', $sampah->poin_per_kg * $state);
                                        }
                                    }),
    
                                Forms\Components\TextInput::make('harga')
                                    ->label('Harga (Rp)')
                                    ->reactive(),
    
                                Forms\Components\TextInput::make('poin')
                                    ->label('Poin')
                                    ->reactive(),
                            ])
                            ->columns(4),
    
                        Forms\Components\Textarea::make('keterangan')
                            ->label('Keterangan')
                            ->maxLength(65535),
    
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'sedang di proses' => 'Sedang Diproses',
                                'selesai' => 'Selesai',
                            ])
                            ->default('sedang di proses')
                            ->required(),
                    ]),
            ]);
    }
    

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_transaksi')->label('Kode Transaksi'),
                Tables\Columns\TextColumn::make('nasabah.nama')->label('Nasabah'),
                Tables\Columns\TextColumn::make('tanggal')->label('Tanggal')->date(),
                Tables\Columns\TextColumn::make('total_berat')->label('Total Berat (Kg)'),
                Tables\Columns\TextColumn::make('total_harga')->label('Total Harga (Rp)')->money('idr'),
                Tables\Columns\TextColumn::make('total_poin')->label('Total Poin'),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'sedang di proses',
                        'success' => 'selesai',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status Transaksi')
                    ->options([
                        'sedang di proses' => 'Sedang Diproses',
                        'selesai' => 'Selesai',
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
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }
}
