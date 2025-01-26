<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiResource\Pages;
use App\Models\Transaksi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('nasabah', 'nama')
                            ->label('Nasabah')
                            ->required()
                            ->searchable(),
                        Forms\Components\TextInput::make('kode_transaksi')
                            ->label('Kode Transaksi')
                            ->required()
                            ->unique(ignorable: fn ($record) => $record)
                            // ->disabled()
                            ->dehydrated(),
                        Forms\Components\DatePicker::make('tanggal')
                            ->label('Tanggal')
                            ->required(),
                        Forms\Components\Repeater::make('details')
                            ->label('Detail Transaksi')
                            ->relationship()
                            ->schema([
                                Forms\Components\Select::make('sampah_id')
                                    ->relationship('sampah', 'nama')
                                    ->label('Jenis Sampah')
                                    ->required()
                                    ->reactive(),
                                Forms\Components\TextInput::make('berat')
                                    ->label('Berat (Kg)')
                                    ->required()
                                    ->numeric()
                                    ->reactive(),
                                Forms\Components\TextInput::make('harga')
                                    ->label('Harga (Rp)')
                                    ->disabled()
                                    ->dehydrated(),
                                Forms\Components\TextInput::make('poin')
                                    ->label('Poin')
                                    ->disabled()
                                    ->dehydrated(),
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
                            ->required()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_transaksi')
                    ->label('Kode Transaksi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nasabah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date(),
                Tables\Columns\TextColumn::make('total_berat')
                    ->label('Total Berat (Kg)'),
                Tables\Columns\TextColumn::make('total_harga')
                    ->label('Total Harga (Rp)')
                    ->money('idr'),
                Tables\Columns\TextColumn::make('total_poin')
                    ->label('Total Poin'),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    // Remove enum() and use custom logic for colors
                    ->getStateUsing(fn ($record) => $record->status)
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

    public static function getRelations(): array
    {
        return [
            //
        ];
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
