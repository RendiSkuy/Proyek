<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaporanBulananResource\Pages;
use App\Models\LaporanBulanan;
use App\Models\Nasabah;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Barryvdh\DomPDF\Facade\Pdf; // Tambahkan ini

class LaporanBulananResource extends Resource
{
    protected static ?string $model = LaporanBulanan::class;
    protected static ?string $navigationIcon = 'heroicon-o-document';
    protected static ?string $navigationGroup = 'Laporan';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('nasabah_id')
                    ->label('Pilih Nasabah')
                    ->options(Nasabah::pluck('nama', 'id'))
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set, $get) => self::updateLaporan($set, $get)),

                Forms\Components\DatePicker::make('bulan')
                    ->label('Bulan')
                    ->displayFormat('Y-m')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set, $get) => self::updateLaporan($set, $get)),

                Forms\Components\TextInput::make('total_berat')
                    ->label('Total Berat (Kg)')
                    ->numeric()
                    ->disabled(),

                Forms\Components\TextInput::make('total_harga')
                    ->label('Total Harga (Rp)')
                    ->numeric()
                    ->disabled(),

                Forms\Components\TextInput::make('total_poin')
                    ->label('Total Poin')
                    ->numeric()
                    ->disabled(),

                Forms\Components\TextInput::make('keuntungan_bank')
                    ->label('Keuntungan Bank (Rp)')
                    ->numeric()
                    ->disabled(),
            ]);
    }

    private static function updateLaporan(callable $set, $get)
    {
        $nasabah_id = $get('nasabah_id');
        $bulan = $get('bulan');

        if ($nasabah_id && $bulan) {
            $laporan = LaporanBulanan::generateLaporan($nasabah_id, $bulan);

            $set('total_berat', $laporan['total_berat'] ?? 0);
            $set('total_harga', $laporan['total_harga'] ?? 0);
            $set('total_poin', $laporan['total_poin'] ?? 0);
            $set('keuntungan_bank', $laporan['keuntungan_bank'] ?? 0);
        } else {
            $set('total_berat', 0);
            $set('total_harga', 0);
            $set('total_poin', 0);
            $set('keuntungan_bank', 0);
        }
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nasabah.nama')
                    ->label('Nama Nasabah')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('bulan')
                    ->label('Bulan')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_berat')
                    ->label('Total Berat (Kg)')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_harga')
                    ->label('Total Harga (Rp)')
                    ->money('idr')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_poin')
                    ->label('Total Poin')
                    ->sortable(),

                Tables\Columns\TextColumn::make('keuntungan_bank')
                    ->label('Keuntungan Bank (Rp)')
                    ->money('idr')
                    ->sortable(),
            ])
            ->headerActions([
                Tables\Actions\ButtonAction::make('Export Semua ke PDF')
                    ->icon('heroicon-o-document-text')
                    ->action(function () {
                        $laporans = LaporanBulanan::all(); // Mengambil semua data
                        $pdf = Pdf::loadView('exports.laporan-bulanan', compact('laporans'));
                        return response()->streamDownload(
                            fn () => print($pdf->output()),
                            'laporan-bulanan-semua.pdf'
                        );
                    }),
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
            'index' => Pages\ListLaporanBulanans::route('/'),
            'create' => Pages\CreateLaporanBulanan::route('/create'),
            'edit' => Pages\EditLaporanBulanan::route('/{record}/edit'),
        ];
    }
}
