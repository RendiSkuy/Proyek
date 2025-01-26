<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TukarPoinResource\Pages;
use App\Models\TukarPoin;
use App\Models\User;
use App\Models\Reward;
use App\Models\Admin;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class TukarPoinResource extends Resource
{
    protected static ?string $model = TukarPoin::class;

    protected static ?string $navigationIcon = 'heroicon-o-refresh';
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
                        ->searchable()
                        ->query(fn ($query) => $query->where('id_cms_privileges', 2)),

                    // Reward
                    Select::make('reward_id')
                        ->label('Reward')
                        ->relationship('reward', 'name')
                        ->required()
                        ->searchable()
                        ->query(fn ($query) => $query->where('stock', '>', 0)),

                    // Quantity
                    TextInput::make('quantity')
                        ->label('Jumlah')
                        ->numeric()
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $set, $get) {
                            $reward = Reward::find($get('reward_id'));
                            $set('total_price', $reward ? $reward->price * $state : 0);
                        }),

                    // Total Harga
                    TextInput::make('total_price')
                        ->label('Total Harga')
                        ->numeric()
                        ->required()
                        ->disabled(),

                    // Status
                    Select::make('status')
                        ->label('Status')
                        ->options([
                            'Pending' => 'Pending',
                            'On Proses' => 'On Proses',
                            'Diterima' => 'Diterima',
                        ])
                        ->required(),
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

                TextColumn::make('reward.name')
                    ->label('Reward')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('quantity')
                    ->label('Jumlah')
                    ->sortable(),

                TextColumn::make('total_price')
                    ->label('Total Harga')
                    ->sortable(),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'Pending',
                        'info' => 'On Proses',
                        'success' => 'Diterima',
                    ])
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
            'index' => Pages\ListTukarPoins::route('/'),
            'create' => Pages\CreateTukarPoin::route('/create'),
            'edit' => Pages\EditTukarPoin::route('/{record}/edit'),
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        return TukarPoin::count();
    }
}
