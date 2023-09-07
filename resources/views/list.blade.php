@extends('layout')
@section('title', 'List Product')
@section('content')
<h2>PRODUCT LIST</h2>
<div class="buttonList mb-4 mt-3">
    <a href="/add" target="_blank" class="btn btn-primary">Buy Product</a>
    <button class="btn btn-primary" id="showProduct">Show Products</button>
</div>
<div class="listProduct" id="listProduct">
    <table id="table" class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <div>SHOW: <span id="productCount"></span> ITEMS</div>
</div>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="productTitle"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="product">
                            <div class="thumbnail">
                                <img src="" alt="Thumbnail Image">
                            </div>
                            <div class="image-gallery" id="productImage">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col">
                                <h2>Price: $<span id="productPrice"></span></h2>
                            </div>
                            <div class="col">
                                <i productStar=""></i>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col">
                                Category:
                                <span id="productCategory"></span>
                            </div>
                            <div class="col">
                                Brand:
                                <span id="productBrand"></span>
                            </div>
                        </div>
                        <div class="mt-1">Stock: <span id="productStock"></span></div>
                        <div class="mt-1">Description:</div>
                        <div class="mt-1" id="productDesc"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#showProduct").click(function() {
            $('#listProduct').show();
            $.ajax({
                url: "/product",
                method: "GET",
                success: function(data) {
                    $.each(data.products, function(index, product) {
                        var row = '<tr><td><img src="' + product.thumbnail +
                            '"class="listImage"</td><td>' + product.title +
                            "</td><td>" + product.category +
                            "</td><td>" + product.brand +
                            "</td><td>" + product.stock +
                            "</td><td>$" + product.price +
                            '</td><td><button class="tombol_view btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-id="' + product.id + '">View</button>'
                        "</td></tr>";
                        $("#table tbody").append(row);
                    });
                    $('#productCount').text(data.products.length);
                },
                error: function() {
                    alert("Terjadi kesalahan dalam mengambil data.");
                }
            });
        });

        $(document).on('click', '.tombol_view', function() {
            var id = $(this).data('id');

            // Lakukan permintaan Ajax untuk mengambil data produk
            $.ajax({
                url: 'https://dummyjson.com/products/' + id,
                method: 'GET',
                success: function(product) {
                    $('#productTitle').text(product.title);
                    $('.thumbnail img').attr('src', product.thumbnail);
                    $('#productPrice').text(product.price);
                    $('.col i').attr('productStar', product.rating);
                    $('#productCategory').text(product.category);
                    $('#productBrand').text(product.brand);
                    $('#productStock').text(product.stock);
                    $('#productDesc').text(product.description);
                    $('#productImage').empty();
                    $.each(product.images, function(index, image) {
                        var img = '<img src="' + image + '">'
                        $("#productImage").append(img);
                    });
                    console.log(product.images);
                },
                error: function() {
                    alert('Terjadi kesalahan dalam mengambil data produk.');
                }
            });
        });
    });
</script>
@endsection