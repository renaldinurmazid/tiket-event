@extends('pages.layout.index')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Product</h1>
    </div>
    <div class="w-full p-10">
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
              <input type="text" class="form-control" name="nama" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Harga Produk</label>
              <input type="number" class="form-control" name="harga" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <select name="category" class="form-control">
                    <option selected>Open this select menu</option>
                    @foreach ($data as $c)
                        <option value="{{ $c->id }}">{{ $c->nama_category }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>
  </section>
@endsection