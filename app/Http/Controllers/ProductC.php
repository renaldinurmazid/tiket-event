<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\products;
use Illuminate\Http\Request;

class ProductC extends Controller
{

    public function index()
    {
        $title = "Product";
        $data = products::all();
        return view('pages.products.index', compact('title', 'data'));
    }

    public function create()
    {
        $title = "Create Product";
        $data = category::all();
        return view('pages.products.create', compact('title', 'data'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'category' => 'required|exists:category,id',
        ]);

        products::create([
            'nama_product' => $request->input('nama'),
            'harga_product' => $request->input('harga'),
            'id_category' => $request->input('category'),
        ]);

        return redirect()->route('products')->with('success', 'Data Produk berhasil disimpan');
    }
}
