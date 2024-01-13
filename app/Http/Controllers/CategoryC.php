<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryC extends Controller
{
    public function index()
    {
        $title="Category";
        $data = category::all();
        return view('pages.category.index', compact('title', 'data'));
    }

    public function create()
    {
        $title="Create Category";
        return view('pages.category.create', compact('title'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'category' => 'required',
        ]);

        category::create([
            'nama_category' => $request->input('category'),
        ]);

        return redirect()->route('category')->with('success', 'Data Produk berhasil disimpan');
    }
}
