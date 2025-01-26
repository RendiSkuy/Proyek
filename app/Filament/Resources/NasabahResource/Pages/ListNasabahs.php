<?php

namespace App\Filament\Resources\NasabahResource\Pages;

use App\Filament\Resources\NasabahResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNasabah extends ListRecords
{
    protected static string $resource = NasabahResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
