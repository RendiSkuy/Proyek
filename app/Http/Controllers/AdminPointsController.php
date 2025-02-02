<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PoinResource\Pages;
use App\Models\Poin; // Ganti dengan model yang benar jika berbeda
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class PointsResource extends Resource
{
    protected static ?string $model = Poin::class;

    protected static ?string $navigationIcon = 'heroicon-o-calculator';
    protected static ?string $navigationGroup = 'Data Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        // Field Nama User
                        Select::make('user_id')
                            ->label('Nama User')
                            ->relationship('user', 'username') // Relasi ke model User, kolom username
                            ->required()
                            ->searchable(),

                        // Field Jumlah Poin
                        TextInput::make('total_points')
                            ->label('Jumlah Poin')
                            ->numeric()
                            ->required()
                            ->minValue(0),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Nama User
                TextColumn::make('user.username')
                    ->label('Nama User')
                    ->sortable()
                    ->searchable(),

                // Jumlah Poin
                TextColumn::make('total_points')
                    ->label('Jumlah Poin')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListPoins::route('/'),
            'create' => Pages\CreatePoin::route('/create'),
            'edit' => Pages\EditPoin::route('/{record}/edit'),
        ];
    }
}
