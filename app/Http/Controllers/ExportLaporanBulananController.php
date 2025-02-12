<?php

namespace App\Http\Controllers;

use App\Models\LaporanBulanan;
use PDF;

class ExportLaporanBulananController extends Controller
{
    public function export()
    {
        $laporans = LaporanBulanan::with('nasabah')->get();

        $pdf = PDF::loadView('exports.laporan-bulanan', compact('laporans'))
                  ->setPaper('a4', 'landscape');

        return $pdf->download('laporan_bulanan.pdf');
    }
}
