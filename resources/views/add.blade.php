@extends('layout')
@section('title', 'Tambah Pesanan')
@section('content')
<div class="addPesanan">
    <form action="/store" method="post">
        @csrf
        <div class="row mb-3">
            <label for="no_pesanan" class="col-2 form-label">No. Pesanan</label>
            <div class="col-10">
                <input type="text" class="form-control" value="{{$no_pesanan}}" id="no_pesanan" name="no_pesanan" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <label for="tanggal" class="col-2 form-label">Tanggal</label>
            <div class="col-10">
                <input type="datetime-local" class="form-control" name="tanggal" id="tanggal" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="nm_supplier" class="col-2 form-label">Nama Supplier</label>
            <div class="col-10">
                <input type="text" class="form-control" name="nm_supplier" id="nm_supplier" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="nm_produk" class="col-2 form-label">Nama Supplier</label>
            <div class="col-10">
                <select name="nm_produk" class="form-control" id="nm_produk" required>
                    <option selected="true" disabled>Pilih...</option>
                    @foreach($data['products'] as $product)
                    <option value="{{$product['title']}}" data-price="{{ $product['price'] }}" data-discount="{{ $product['discountPercentage'] }}">{{$product['title']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <label for="total" class="col-2 form-label">Total</label>
            <div class="col-10">
                <div class="input-group mb-3">
                    <span class="input-group-text">$</span>
                    <input type="text" step="any" class="form-control" name="total" id="total" readonly required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-10">
                <button type="submit" id="btnSubmit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#nm_produk').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var price = parseFloat(selectedOption.data('price'));
            var discount = parseFloat(selectedOption.data('discount'));
            var discountedPrice = price - (price * (discount / 100));

            $('#total').val(discountedPrice.toFixed(2));
        });

    });
</script>
@endsection