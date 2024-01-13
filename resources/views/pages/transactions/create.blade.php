@extends('pages.layout.index')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Transactions</h1>
    </div>
    <div class="w-full p-10">
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Kode Transaksi</label>
                <input type="number" class="form-control" name="kode" aria-describedby="emailHelp" value="{{ random_int(1000000000, 9999999999) }}" readonly>
              </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
              <select name="produk" id="produk" class="form-control">
                <option selected>Open this select menu</option>
                @foreach ($data as $p)
                    <option value="{{ $p->id }}" data-harga="{{ $p->harga_product }}">{{ $p->nama_product }} - Cat. {{ $p->category->nama_category }}</option>
                @endforeach
            </select>
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">QTY</label>
              <input type="number" class="form-control" id="qty" name="qty" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Total Bayar</label>
              <input type="number" class="form-control" id="total_bayar" name="total_bayar" readonly>
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Nama Pembeli</label>
              <input type="text" class="form-control" name="nama" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Uang Bayar</label>
              <input type="number" class="form-control" name="bayar" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>
  </section>
  <script>
    const produkInput = document.getElementById('produk');
    const qtyInput = document.getElementById('qty');
    const totalBayarInput = document.getElementById('total_bayar');

    produkInput.addEventListener('change', updateTotal);
    qtyInput.addEventListener('input', updateTotal);

    function updateTotal() {
        const selectedOption = produkInput.options[produkInput.selectedIndex];
        const hargaProduk = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
        const qty = parseFloat(qtyInput.value) || 0;

        const total = hargaProduk * qty;
        totalBayarInput.value = total.toFixed(2);
    }
</script>
@endsection