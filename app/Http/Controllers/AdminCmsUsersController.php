<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CmsUsersResource\Pages;
use App\Models\User; // Pastikan model yang digunakan benar
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class CmsUsersResource extends Resource
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
                        // Field Name
                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->validation('required|alpha_spaces|min:3'),

                        // Field Email
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(User::class, 'email', ignoreRecord: true),

                        // Field Photo
                        FileUpload::make('photo')
                            ->label('Photo')
                            ->image()
                            ->required()
                            ->validation('required|image|max:1000') // 1MB limit
                            ->helperText('Recommended resolution is 200x200px'),

                        // Field Privilege
                        Select::make('id_cms_privileges')
                            ->label('Privilege')
                            ->relationship('cmsPrivilege', 'name') // Assuming a relation named 'cmsPrivilege'
                            ->required(),

                        // Field Password
                        TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->helperText('Leave empty if not changing'),

                        // Field Password Confirmation
                        TextInput::make('password_confirmation')
                            ->label('Password Confirmation')
                            ->password()
                            ->helperText('Leave empty if not changing')
                            ->dehydrated(false), // Prevent this field from being sent to the database
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('cmsPrivilege.name')
                    ->label('Privilege')
                    ->sortable()
                    ->searchable(),

                ImageColumn::make('photo')
                    ->label('Photo')
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
			'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUsers::route('/create'),
            'edit' => Pages\EditUsers::route('/{record}/edit'),
        ];
    }
}
