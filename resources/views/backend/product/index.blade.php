@extends('layouts.backend')
@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-secondary">
                    Data Product
                    <a href="{{ route('backend.product.create') }}" class="btn btn-info btn-sm"
                        style="color:white; float: right;">
                        Tambah
                    </a>
                </div>
                <div class="card-body">
                    <div class="table tabel-responsive">
                        <table class="table" id="dataproduct">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Product</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Gambar</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $data)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->category->name}}</td>
                                    <td>{{$data->price}}</td>
                                    <td>{{$data->stock}}</td>
                                    <td>
                                        @if($data->image)
                                            <img src="{{ asset('storage/' . $data->image) }}" width="60">
                                        @else
                                            <span class="text-muted">Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($data->description, 50, '...') }}</td>
                                    <td>
                                        <a href="{{ route('backend.product.show',$data->id) }}" class="btn btn-sm btn-success">
                                            Show
                                        </a> |
                                        <a href="{{ route('backend.product.edit',$data->id) }}" class="btn btn-sm btn-warning">
                                            Edit
                                        </a> |
                                        <a href="{{ route('backend.product.destroy',$data->id) }}" class="btn btn-sm btn-danger"
                                            data-confirm-delete="true">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
<script>
    new DataTable('#dataproduct');
</script>
@endpush