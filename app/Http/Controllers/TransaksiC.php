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

    public function show($id)
    {
        $title = "Update Transaction";
        $data = transaction::find($id);
        $product = products::all();
        return view('pages.transactions.edit', compact('title', 'data','product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_unik' => 'required',
            'nama_pelanggan' => 'required',
            'uang_bayar' => 'required',
            'total_belanja' => 'required',
            'product' => 'required|array',
            'qty' => 'required|array',
        ]);

        $productIds = $request->input('productId');
        $qtys = $request->input('qty');


        Transaction::create([
            'nomor_unik' => $request->input('kode_unik'),
            'nama_pemesan' => $request->input('nama_pelanggan'),
            'uang_bayar' => $request->input('uang_bayar'),
            'product' => $this->prepareProducts($productIds, $qtys),
            'total_belanja' => $request->input('total_belanja'),
            'uang_kembali' => $request->input('uang_bayar') - $request->input("total_belanja"),
        ]);

        return redirect()->route('transactions')->with('success', 'Data Transaksi berhasil disimpan');
    }
    private function prepareProducts($productIds, $qtys)
    {
        $preparedProducts = [];

        foreach ($productIds as $index => $productId) {
            $preparedProducts[] = [
                'productId' => $productId,
                'qty' => $qtys[$index],
                'total' => $qtys[$index] * products::find($productId)->harga_product,
            ];
        }

        return $preparedProducts;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_unik' => 'required',
            'nama_pelanggan' => 'required',
            'uang_bayar' => 'required',
            'total_belanja' => 'required',
            'product' => 'required|array',
            'qty' => 'required|array',
        ]);

        $productIds = $request->input('productId');
        $qtys = $request->input('qty');

        $transaksi = Transaction::find($id);
        $transaksi->update([
            'nomor_unik' => $request->input('kode_unik'),
            'nama_pemesan' => $request->input('nama_pelanggan'),
            'uang_bayar' => $request->input('uang_bayar'),
            'product' => $this->prepareProducts($productIds, $qtys),
            'total_belanja' => $request->input('total_belanja'),
            'uang_kembali' => $request->input('uang_bayar') - $request->input("total_belanja"),
        ]);

        $transaksi->save();

        return redirect()->route('transactions')->with('success', 'Data Transaksi berhasil disimpan');
    }

    public function destroy($id)
    {
        $transaksi = transaction::find($id);
        $transaksi->delete();
        
        return redirect()->back()->with("success","Delete Berhasil");
    }

}
