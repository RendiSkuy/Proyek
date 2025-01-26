<?php

namespace App\Filament\Resources\TukarPoinResource\Pages;

use App\Filament\Resources\TukarPoinResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTukarPoin extends EditRecord
{
    protected static string $resource = TukarPoinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
