<?php

namespace App\Filament\Resources\PoinResource\Pages;

use App\Filament\Resources\PoinResource;
use App\Models\Poin;
use App\Models\KategoriSampah;
use App\Models\Sampah;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;

class CreatePoin extends CreateRecord
{
    protected static string $resource = PoinResource::class;
}