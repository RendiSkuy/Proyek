<?php

namespace App\Filament\Resources\LaporanBulananResource\Pages;

use App\Filament\Resources\LaporanBulananResource;
use App\Models\LaporanBulanan;
use Filament\Resources\Pages\CreateRecord;

class CreateLaporanBulanan extends CreateRecord
{
    protected static string $resource = LaporanBulananResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $laporan = LaporanBulanan::generateLaporan($data['nasabah_id'], $data['bulan']);

        $data['total_berat'] = $laporan['total_berat'];
        $data['total_harga'] = $laporan['total_harga'];
        $data['total_poin'] = $laporan['total_poin'];
        $data['keuntungan_bank'] = $laporan['keuntungan_bank'];

        return $data;
    }
}
