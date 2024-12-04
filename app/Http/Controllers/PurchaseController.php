<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Sesuaikan model dengan nama tabel pesanan Anda

class PurchaseController extends Controller
{
    public function show($random_id)
    {
        // Cari order berdasarkan random_id
        $order = Order::where('random_id', $random_id)->firstOrFail();

        // Tampilkan data pesanan
        return view('purchase.show', compact('order'));
    }
}
