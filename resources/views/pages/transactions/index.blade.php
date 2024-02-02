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
                <th scope="col">Nama Pelanggan</th>
                <th scope="col">Total Belanja</th>
                <th scope="col">Uang Bayar</th>
                <th scope="col">Uang Kembali</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $p)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $p->nomor_unik }}</td>
                    <td>
                      <ul>
                        @foreach ($p->product as $product)
                          @php
                            $productname = \App\Models\products::find($product['productId'])  
                          @endphp
                            <li>{{ $productname['nama_product'] }}<br>{{ $product['qty'] }} x {{ $product['total'] }}</li>
                        @endforeach
                      </ul>
                    </td>
                    <td>{{ $p->nama_pemesan }}</td>
                    <td>{{ $p->total_belanja }}</td>
                    <td>{{ $p->uang_bayar }}</td>
                    <td>{{ $p->uang_kembali }}</td>
                    <td>
                      <div class="btn-group">
                        <a href="{{ route('transactions.show',$p->id) }}" class="btn btn-warning">
                          <i class="fa fa-pen"></i>
                        </a>
                        <form action="{{ route('transaction.destroy',$p->id) }}" method="POST">
                          @csrf
                          @method('delete')
                            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                      </div>
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>
  </section>
@endsection