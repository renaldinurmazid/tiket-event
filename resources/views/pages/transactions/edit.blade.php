@extends('pages.layout.index')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Transactions</h1>
    </div>
    <div class="w-full p-10">
        <form action="{{ route('transaction.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Kode Transaksi</label>
                <input type="number" class="form-control" name="kode_unik" aria-describedby="emailHelp"
                    value="{{ $data->nomor_unik }}" readonly>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nama Pembeli</label>
                <input type="text" class="form-control" name="nama_pelanggan" value="{{ $data->nama_pemesan }}"
                    aria-describedby="emailHelp">
            </div>
            <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
            <div class="mb-3 d-flex">
                <select name="product[]" required id="produk" class="form-control">
                    <option selected>Open this select menu</option>
                    @foreach ($product as $p)
                    <option value="{{ $p->id }}|{{ $p->qty }}|{{ $p->total }}" data-harga="{{ $p->harga_product }}">
                        {{ $p->nama_product }}</option>
                    @endforeach
                </select>
                <input type="hidden" id="selectedProductId" name="selectedProductId" value="">
                <button type="button" class="btn btn-primary mx-2" onclick="addRow()"><i
                        class="fas fa-plus"></i></button>
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
                        @foreach ($data->product as $existingProduct)
                        @php
                        $product = \App\Models\products::find($existingProduct['productId'])
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->nama_product }}</td>
                            <td>Rp. <span class="harga"
                                    data-harga="{{ $product->harga_product }}">{{ $product->harga_product }}</span></td>
                            <td>
                                <input type="number" class="form-control qtyInput" name="qty[]"
                                    value="{{ $existingProduct['qty'] }}" min="1">
                                <input type="hidden" name="productId[]" value="{{ $existingProduct['productId'] }}">
                            </td>
                            <td class="totalRow">Rp. {{ $existingProduct['total'] }}</td>
                            <td><button type="button" class="btn btn-danger" onclick="removeRow(this)"><i
                                        class="fas fa-trash"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Total Bayar</label>
                <input type="number" class="form-control" id="total_bayar" name="total_belanja" readonly>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Uang Bayar</label>
                <input type="number" class="form-control" name="uang_bayar" value="{{ $data->uang_bayar }}"
                    aria-describedby="emailHelp">
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
        var existingProduct = $('#tableBody tr').find(`input[value="${productId}"]`).length > 0;

        if (!existingProduct) {
            var total = productHarga * qty;

            var newRow = `
            <tr>
                <td>${$('#tableBody tr').length + 1}</td>
                <td>${productName}</td>
                <td>Rp. <span class="harga" data-harga="${productHarga}">${productHarga}</span></td>
                <td>
                    <input type="number" class="form-control qtyInput" name="qty[]" value="${qty}" min="1">
                    <input type="hidden" name="productId[]" value="${productId}">
                </td>
                <td class="totalRow">Rp. ${total}</td>
                <td><button type="button" class="btn btn-danger" onclick="removeRow(this)"><i class="fas fa-trash"></i></button></td>
            </tr>
        `;

            $('#tableBody').append(newRow);
            updateTotalBayar();
        } else {
            alert('Product sudah ditambahkan sebelumnya. Untuk mengedit, gunakan fitur edit.');
        }

        // Clear input fields after adding a row
        $('#qty').val('');
        $('#selectedProductId').val('');
    }

    function removeRow(row) {
        $(row).parent().parent().remove();
    }

    function updateTotalBayar() {
        var totalBayar = 0;

        $('#tableBody tr').each(function () {
            var qty = parseFloat($(this).find('.qtyInput').val());
            var harga = parseFloat($(this).find('.harga').data('harga'));
            var totalRow = qty * harga;

            $(this).find('.totalRow').text('Rp. ' + totalRow);
            totalBayar += totalRow;
        });

        $('#total_bayar').val(totalBayar);
    }

    $(document).on('input', '.qtyInput', function () {
        updateTotalBayar();
    });

</script>
@endsection
