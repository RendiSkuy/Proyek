<?php

namespace App\Http\Controllers\UserApp;

use App\Models\Sampah;
use App\Models\TukarPoin;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    public function show($id)
    {
        $transaction = Transaksi::findOrFail($id);
        $transaction = Transaksi::with('details.sampah')->findOrFail($id);
        $sampah = Sampah::where('id', $transaction->sampah_id)->first();
        $admin = DB::table('users')->where('id', $transaction->admin_id)->first();
        return view('user-app/detail-transaksi')->with([
            'transaction' => $transaction,
            'sampah' => $sampah,
            'admin' => $admin
        ]);
    }

            public function transactionHistory()
        {
            $transactions = Transaksi::where('nasabah_id', auth()->id())->latest()->get();

            return view('user-app.riwayat-transaksi', compact('transactions'));
        }


        public function poinHistory()
        {
            $transactions = Transaksi::where('nasabah_id', auth()->id())->latest()->get();
            return view('user-app.riwayat-poin', compact('transactions'));
        }
        
        public function tukarPoinHistory()
        {
            $tukarPoin_history = TukarPoin::where('nasabah_id', auth()->id())->latest()->get();
            return view('user-app.riwayat-pesanan', compact('tukarPoin_history'));
        }
        
    
}
