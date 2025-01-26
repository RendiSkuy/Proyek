<?php
namespace App\Filament\Resources\TransaksiResource\Pages;

use App\Filament\Resources\TransaksiResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateTransaksi extends CreateRecord
{
    protected static string $resource = TransaksiResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        // Tambahkan validasi nasabah
        // if (empty($data['nasabah_id'])) {
        //     // Coba ambil nasabah dari user yang login
        //     $nasabahId = auth()->user()->nasabah->id ?? null;
            
        //     if (!$nasabahId) {
        //         throw new \Exception('Nasabah tidak ditemukan');
        //     }
            
        //     $data['nasabah_id'] = $nasabahId;
        // }

        return static::getModel()::create($data);
    }
}