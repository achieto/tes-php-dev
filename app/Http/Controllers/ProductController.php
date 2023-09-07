<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function list()
    {
        return view('list');
    }

    public function product()
    {
        $response = Http::get('https://dummyjson.com/products');
        return response()->json($response->json());
    }

    public function add()
    {
        $response = Http::get('https://dummyjson.com/products');
        $data = $response->json();
        try {
            $last_pesanan = Pesanan::orderBy('tanggal')->first();
            $no_pesanan = (int)$last_pesanan->no_pesanan + 1;
        } catch (\Exception $e) {
            $no_pesanan = 1;
        }
        return view('add', compact('data', 'no_pesanan'));
    }

    public function store(Request $request)
    {
        Pesanan::create([
            'no_pesanan' => $request->no_pesanan,
            'tanggal' => $request->tanggal,
            'nm_supplier' => $request->nm_supplier,
            'nm_produk' => $request->nm_produk,
            'total' => $request->total,
        ]);

        return back();
    }
}
