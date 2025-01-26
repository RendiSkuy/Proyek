<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PoinResource\Pages;
use App\Models\Poin;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class PoinResource extends Resource
{
    protected static ?string $model = Poin::class;
    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';
    protected static ?string $navigationGroup = 'Manajemen Data';
    protected static ?string $label = 'Poin';
    protected static ?string $pluralLabel = 'Poin';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('nasabah_id')
                    ->relationship('nasabah','nama') // Relasi ke model Nasabah, kolom 'nama'
                    ->searchable()
                    ->required()
                    ->label('Nasabah'),

                TextInput::make('nama_poin')
                    ->label('Nama Poin')
                    ->required()
                    ->maxLength(255)
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $categories = [
                            'plastik' => ['kategori' => 'anorganik', 'jumlah' => 10],
                            'kertas' => ['kategori' => 'anorganik', 'jumlah' => 15],
                            'kaca' => ['kategori' => 'anorganik', 'jumlah' => 20],
                            'kompos' => ['kategori' => 'organik', 'jumlah' => 25],
                            'logam' => ['kategori' => 'anorganik', 'jumlah' => 30],
                            'baterai' => ['kategori' => 'elektronik', 'jumlah' => 50],
                            'elektronik' => ['kategori' => 'elektronik', 'jumlah' => 50],
                            'sisa makanan' => ['kategori' => 'organik', 'jumlah' => 20],
                            'daun kering' => ['kategori' => 'organik', 'jumlah' => 15],
                            'besi' => ['kategori' => 'anorganik', 'jumlah' => 40],
                            'karton' => ['kategori' => 'anorganik', 'jumlah' => 10],
                            'minyak jelantah' => ['kategori' => 'lainnya', 'jumlah' => 35],
                            'kayu' => ['kategori' => 'lainnya', 'jumlah' => 15],
                            'kaleng' => ['kategori' => 'anorganik', 'jumlah' => 30],
                            'sisa sayur' => ['kategori' => 'organik', 'jumlah' => 20],
                            'limbah medis' => ['kategori' => 'lainnya', 'jumlah' => 60],
                            'pakaian bekas' => ['kategori' => 'lainnya', 'jumlah' => 25],
                            'botol plastik' => ['kategori' => 'anorganik', 'jumlah' => 10],
                            'stereofoam' => ['kategori' => 'anorganik', 'jumlah' => 5],
                        ];

                        $state = strtolower($state);
                        if (isset($categories[$state])) {
                            $set('kategori', $categories[$state]['kategori']);
                            $set('jumlah', $categories[$state]['jumlah']);
                        } else {
                            $set('kategori', 'lainnya');
                            $set('jumlah', 5);
                        }
                    }),

                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->maxLength(500),

                Select::make('kategori')
                    ->label('Kategori Poin')
                    ->options([
                        'organik' => 'Organik',
                        'anorganik' => 'Anorganik',
                        'elektronik' => 'Elektronik',
                        'lainnya' => 'Lainnya',
                    ])
                    ->required()
                    ->disabled(),

                TextInput::make('jumlah')
                    ->label('Jumlah Poin')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nasabah.nama')
                    ->label('Nama Nasabah')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('nasabah.email')
                    ->label('Email Nasabah')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('nama_poin')
                    ->label('Nama Poin')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(50),

                TextColumn::make('jumlah')
                    ->label('Jumlah Poin')
                    ->sortable(),

                BadgeColumn::make('kategori')
                    ->label('Kategori')
                    ->colors([
                        'success' => 'organik',
                        'warning' => 'anorganik',
                        'info' => 'elektronik',
                        'secondary' => 'lainnya',
                    ])
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('kategori')
                    ->label('Filter Kategori')
                    ->options([
                        'organik' => 'Organik',
                        'anorganik' => 'Anorganik',
                        'elektronik' => 'Elektronik',
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

    public static function getRelations(): array
    {
        return [];
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