<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TukarPoinResource\Pages;
use App\Models\TukarPoin;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;

class TukarPoinResource extends Resource
{
    protected static ?string $model = TukarPoin::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';
    protected static ?string $navigationGroup = 'Bank Sampah';
    protected static ?string $pluralLabel = 'Data Tukar Poin';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Select::make('nasabah_id')
                ->label('Nama Nasabah')
                ->relationship('nasabah', 'nama') // Menampilkan nama nasabah
                ->searchable()
                ->required(),

            Select::make('reward_id')
                ->label('Nama Reward')
                ->relationship('reward', 'nama_reward') // Menampilkan nama reward
                ->searchable()
                ->required(),

            TextInput::make('jumlah')
                ->label('Jumlah Poin')
                ->required()
                ->numeric()
                ->minValue(0),

            DatePicker::make('tanggal_tukar')
                ->label('Tanggal Tukar')
                ->required(),

            Select::make('status')
                ->label('Status Tukar')
                ->options([
                    'Pending' => 'Pending',
                    'On Proses' => 'On Proses',
                    'Diterima' => 'Diterima',
                ])
                ->required(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('nasabah.nama')
                ->label('Nama Nasabah')
                ->sortable()
                ->searchable(),

            TextColumn::make('reward.nama_reward')
                ->label('Nama Reward')
                ->sortable(),

            TextColumn::make('jumlah')
                ->label('Jumlah Poin')
                ->sortable(),

            TextColumn::make('status')
                ->label('Status Tukar')
                ->sortable(),

            TextColumn::make('tanggal_tukar')
                ->label('Tanggal Tukar')
                ->date()
                ->sortable(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTukarPoins::route('/'),
            'create' => Pages\CreateTukarPoin::route('/create'),
            'edit' => Pages\EditTukarPoin::route('/{record}/edit'),
        ];
    }
}
