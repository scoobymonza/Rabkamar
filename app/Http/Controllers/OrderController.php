<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function order(Request $request)
    {
        $jumlah_orang = $request->jumlah_orang_dewasa + $request->jumlah_orang_anak;

        $order = new Order;
        $order->user_id = $request->user;
        $order->kamar_id = $request->kamar;
        $order->tanggal_masuk = $request->tanggal_masuk;
        $order->tanggal_keluar = $request->tanggal_keluar;
        $order->jumlah_orang = $jumlah_orang;
        $order->save();
        $order_id = $order->id;
        return redirect('/dashboard/pesan/ordered/' . $order_id);
    }

    public function ordered(Order $order)
    {
        return view('ordered', [
            'ordered' => $order,
            'title' => 'Detail Pesanan'
        ]);
    }
    public function history(User $user)
    {
        return view('history', [
            'title' => 'Riwayat Pemesanan',
            'active' => 'Riwayat',
            'users' => $user->order
        ]);
    }
}
