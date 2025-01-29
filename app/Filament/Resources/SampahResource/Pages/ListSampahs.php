<?php

namespace App\Filament\Resources\SampahResource\Pages;

use App\Filament\Resources\SampahResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSampahs extends ListRecords
{
    protected static string $resource = SampahResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(), // Tambahkan tombol Create
        ];
    }
}
