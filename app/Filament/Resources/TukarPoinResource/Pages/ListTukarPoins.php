<?php

namespace App\Filament\Resources\TukarPoinResource\Pages;

use App\Filament\Resources\TukarPoinResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTukarPoins extends ListRecords
{
    protected static string $resource = TukarPoinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
