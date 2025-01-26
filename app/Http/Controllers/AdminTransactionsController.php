<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Models\Transaksi;
use App\Models\Point;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-cash';
    protected static ?string $navigationGroup = 'Manajemen Transaksi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    // Nama User
                    Select::make('user_id')
                        ->label('Nama User')
                        ->relationship('user', 'username')
                        ->required()
                        ->searchable(),

                    // Nama Admin
                    Select::make('admin_id')
                        ->label('Nama Admin')
                        ->relationship('admin', 'name')
                        ->required()
                        ->searchable(),

                    // Jenis Sampah
                    Select::make('sampah_id')
                        ->label('Jenis Sampah')
                        ->relationship('sampah', 'name', function ($query) {
                            $query->select(['id', 'name', 'price_per_kg']);
                        })
                        ->required()
                        ->searchable()
                        ->reactive()
                        ->afterStateUpdated(fn ($state, callable $set) => $set('price_per_kg', $state->price_per_kg ?? 0)),

                    // Total Berat
                    TextInput::make('total_weight')
                        ->label('Total Berat (Kg)')
                        ->numeric()
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(fn ($state, callable $set) => $set('total_income', $state * 100)),

                    // Total Pendapatan
                    TextInput::make('total_income')
                        ->label('Total Pendapatan')
                        ->numeric()
                        ->required()
                        ->disabled(),

                    // Poin Didapat
                    TextInput::make('point_received')
                        ->label('Poin Didapat')
                        ->numeric()
                        ->required()
                        ->disabled(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.username')
                    ->label('Nama User')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('admin.name')
                    ->label('Nama Admin')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('sampah.name')
                    ->label('Jenis Sampah')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('total_weight')
                    ->label('Total Berat (Kg)')
                    ->sortable(),

                TextColumn::make('total_income')
                    ->label('Total Pendapatan')
                    ->sortable(),

                TextColumn::make('point_received')
                    ->label('Poin Didapat')
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
            'index' => Pages\ListTransaksi::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        return Transaksi::count();
    }
}
