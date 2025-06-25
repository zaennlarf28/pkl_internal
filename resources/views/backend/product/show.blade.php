@extends('layouts.backend')

@section('content')

<div class="container mt-5">
    <h2 class="text-center mb-4 fs-3">Detail Produk</h2>

    <div class="d-flex justify-content-center">
        <div class="col-lg-11">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th class="w-25">Nama Produk</th>
                                <td>{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td>{{ $product->category->name }}</td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Stok</th>
                                <td>{{ $product->stock }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>{{ $product->description }}</td>
                            </tr>
                            <tr>
                                <th>Gambar</th>
                                <td>
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Produk" 
                                             class="img-thumbnail" style="width: 150px; height: auto;">
                                    @else
                                        <p class="text-muted">Tidak ada gambar</p>
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <div class="text-end">
                            <a href="{{ route('backend.product.index') }}" class="btn btn-primary">Kembali</a>
                        </div>
                    </div> <!-- /.card-body -->
                </div> <!-- /.panel-body -->
            </div> <!-- /.panel -->
        </div> <!-- /.col-lg-11 -->
    </div> <!-- /.d-flex -->
</div> <!-- /.container -->

@endsection
