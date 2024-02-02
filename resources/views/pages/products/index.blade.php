@extends('pages.layout.index')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Product</h1>
    </div>
    <div class="w-full p-10">
        <div class="my-2">
            <a href="{{ route('products.create') }}" class="btn btn-success"> Create</a>
        </div>
        <table class="table ">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Product</th>
                <th scope="col">Harga Product</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $p)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $p->nama_product }}</td>
                    <td>{{ $p->harga_product }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>
  </section>
@endsection