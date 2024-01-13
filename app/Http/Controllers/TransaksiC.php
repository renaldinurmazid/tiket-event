<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\transaction;
use Illuminate\Http\Request;

class TransaksiC extends Controller
{
    public function index()
    {
        $title = "Transaction";
        $data = transaction::all();
        return view('pages.transactions.index', compact('title', 'data'));
    }

    public function create()
    {
        $title = "Create Transaction";
        $data = products::all();
        return view('pages.transactions.create', compact('title', 'data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'produk' => 'required|exists:products,id',
            'nama' => 'required',
            'bayar' => 'required',
            'qty' => 'required',
            'total_bayar' => 'required',
        ]);


        transaction::create([
            'id_product' => $request->input('produk'),
            'nomor_unik' => $request->input('kode'),
            'nama_pemesan' => $request->input('nama'),
            'uang_bayar' => $request->input('bayar'),
            'qty' => $request->input('qty'),
            'uang_kembali'=>$request->input('bayar') - $request->input("total_bayar"),
        ]);

        return redirect()->route('transactions')->with('success', 'Data Produk berhasil disimpan');
    }
}
