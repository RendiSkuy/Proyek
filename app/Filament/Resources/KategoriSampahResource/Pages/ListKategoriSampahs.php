<?php

namespace App\Filament\Resources\KategoriSampahResource\Pages;

use App\Filament\Resources\KategoriSampahResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriSampah extends ListRecords
{
    protected static string $resource = KategoriSampahResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
