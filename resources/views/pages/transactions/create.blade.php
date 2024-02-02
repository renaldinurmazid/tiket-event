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
                <input type="number" class="form-control" name="kode_unik" aria-describedby="emailHelp" value="{{ random_int(1000000000, 9999999999) }}" readonly>
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Nama Pembeli</label>
              <input type="text" class="form-control" name="nama_pelanggan" aria-describedby="emailHelp">
            </div>
              <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
            <div class="mb-3 d-flex">
              <select name="product[]" required id="produk" class="form-control">
                <option selected>Open this select menu</option>
                @foreach ($data as $p)
                    <option value="{{ $p->id }}" data-harga="{{ $p->harga_product }}">{{ $p->nama_product }}</option>
                @endforeach
            </select>
            <button type="button" class="btn btn-primary mx-2" onclick="addRow()"><i><i class="fas fa-plus"></i></button>
          </div>
            <div class="table-responsive my-3">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody id="tableBody">
                      
                    </tbody>
                  </table>
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Total Bayar</label>
              <input type="number" class="form-control" id="total_bayar" name="total_belanja" readonly>
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Uang Bayar</label>
              <input type="number" class="form-control" name="uang_bayar" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>
  </section>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  function addRow() {
    var selectedProduct = $('#produk option:selected');
    var productName = selectedProduct.text();
    var productId = selectedProduct.val();
    var productHarga = selectedProduct.data('harga');
    var qty = $('#qty').val();

    var total = productHarga * qty;

    var newRow = `
      <tr>
        <td>${$('#tableBody tr').length + 1}</td>
        <td>${productName}</td>
        <td>Rp. <span class="harga">${productHarga}</span></td>
        <td>
          <input type="number" class="form-control qtyInput" name="qty[]" value="${qty}" min="1" data-harga="${productHarga}">
          <input type="hidden" name="productId[]" value="${productId}">
        </td>
        <td class="totalRow">Rp. ${total}</td>
        <td><button type="button" class="btn btn-danger" onclick="removeRow(this)"><i class="fas fa-trash"></i></button></td>
      </tr>
    `;

    $('#tableBody').append(newRow);

    updateTotalBayar();

    $('#selectedProductId').val(productId);
  }

  function removeRow(row) {
    $(row).parent().parent().remove();
  }

  function updateTotalBayar() {
    var totalBayar = 0;

    $('#tableBody tr').each(function() {
      var qty = parseFloat($(this).find('.qtyInput').val());
      var harga = parseFloat($(this).find('.harga').text());
      var totalRow = qty * harga;

      $(this).find('.totalRow').text('Rp. ' + totalRow);
      totalBayar += totalRow;
    });

    $('#total_bayar').val(totalBayar);
  }

  $(document).on('input', '.qtyInput', function() {
    updateTotalBayar();
  });
</script>
@endsection