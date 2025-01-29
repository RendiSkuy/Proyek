<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NasabahResource\Pages;
use App\Models\Nasabah;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NasabahResource extends Resource
{
    protected static ?string $model = Nasabah::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Nasabah';
    protected static ?string $pluralLabel = 'Nasabah';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        // Relasi User
                        Forms\Components\Select::make('user_id')
                        ->label('User')
                        ->relationship('user', 'name') // Relasi ke model User, menampilkan nama user
                        ->required()
                        ->searchable()
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $set) {
                            // Isi otomatis nama berdasarkan user yang dipilih
                            if ($user = User::find($state)) {
                                $set('nama', $user->name); // Ambil nama dari model User
                                $set('email', $user->email); // Isi otomatis email (opsional)
                            }
                        }),
                    

                        // Nama Nasabah
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Nasabah')
                            ->required()
                            ->maxLength(255),

                        // Email (diisi otomatis dari relasi User)
                        Forms\Components\TextInput::make('email')
                            ->label('Email') // Nonaktifkan agar tidak bisa diubah
                            ->required(),

                        // Password (hanya saat membuat data baru)
                        Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->required()
                            ->dehydrateStateUsing(fn ($state) => bcrypt($state)) // Enkripsi password sebelum simpan
                            ->visibleOn(['create']), // Hanya tampil saat membuat data baru

                        // Alamat
                        Forms\Components\TextInput::make('alamat')
                            ->label('Alamat')
                            ->nullable(),

                        // Telepon
                        Forms\Components\TextInput::make('telepon')
                            ->label('Telepon')
                            ->nullable(),

                        // Status
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'active' => 'Aktif',
                                'inactive' => 'Tidak Aktif',
                            ])
                            ->required()
                            ->default('active'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name') // Menampilkan nama user dari relasi
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telepon')
                    ->label('Telepon'),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => $state === 'active' ? 'Aktif' : 'Tidak Aktif')
                    ->colors([
                        'success' => 'active',
                        'danger' => 'inactive',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Daftar')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status Nasabah')
                    ->options([
                        'active' => 'Aktif',
                        'inactive' => 'Tidak Aktif',
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
            'index' => Pages\ListNasabah::route('/'),
            'create' => Pages\CreateNasabah::route('/create'),
            'edit' => Pages\EditNasabah::route('/{record}/edit'),
        ];
    }
}
