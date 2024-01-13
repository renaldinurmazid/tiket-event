@extends('pages.layout.index')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Transactions</h1>
    </div>
    <div class="w-full p-10">
        <div class="my-2">
            <a href="{{ route('transactions.create') }}" class="btn btn-success"> Create</a>
        </div>
        <table class="table display" id="myTable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nomor Transaksi</th>
                <th scope="col">Nama Product</th>
                <th scope="col">Category Product</th>
                <th scope="col">Nama Pelanggan</th>
                <th scope="col">Uang Bayar</th>
                <th scope="col">Uang Kembali</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $p)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $p->nomor_unik }}</td>
                    <td>{{ $p->products->nama_product }}</td>
                    <td>{{ $p->products->category->nama_category }}</td>
                    <td>{{ $p->nama_pemesan }}</td>
                    <td>{{ $p->uang_bayar }}</td>
                    <td>{{ $p->uang_kembali }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>
  </section>
@endsection