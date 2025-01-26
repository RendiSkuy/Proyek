<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NasabahResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\NumberInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class NasabahResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'User Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        // Username
                        TextInput::make('username')
                            ->label('Username')
                            ->required()
                            ->minLength(1)
                            ->maxLength(255)
                            ->validationAttribute('Username'),

                        // Email
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(User::class, 'email', ignoreRecord: true) // Unique email

                            ->placeholder('Please enter a valid email address'),

                        // Password
                        TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->minLength(3)
                            ->maxLength(32)
                            ->helperText('Minimum 5 characters. Leave empty if not changing the password.')
                            ->dehydrated(fn ($state) => filled($state)) // Only send to the database if not empty
                            ->dehydrateStateUsing(fn ($state) => bcrypt($state)),

                        // Alamat
                        Textarea::make('address')
                            ->label('Alamat')
                            ->required()
                            ->minLength(1)
                            ->maxLength(255),

                        // No. HP
                        teleponInput::make('telepon')
                            ->label('No. HP')
                            ->required()
                            ->placeholder('You can only enter numbers'),

                        // Foto
                        FileUpload::make('picture')
                            ->label('Foto')
                            ->image()
                            ->required()
                            ->maxSize(3000) // 3 MB
                            ->helperText('Supported formats: JPG, JPEG, PNG, GIF, BMP'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Username
                TextColumn::make('username')
                    ->label('Username')
                    ->sortable()
                    ->searchable(),

                // Email
                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),

                // Alamat
                TextColumn::make('address')
                    ->label('Alamat')
                    ->searchable(),

                // No. HP
                TextColumn::make('phone_number')
                    ->label('No. HP'),

                // Foto
                ImageColumn::make('picture')
                    ->label('Foto')
                    ->rounded(),
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
            'index' => Pages\ListNasabah::route('/'),
            'create' => Pages\CreateNasabah::route('/create'),
            'edit' => Pages\EditNasabah::route('/{record}/edit'),
        ];
    }
}
