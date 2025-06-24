@extends('layouts.backend')
@section('styles')
@endsection
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    Data Category
                    <a href="{{ route('category.create') }}" class="btn btn-info btn-sm text-white">Tambah</a>
                </div>
                <div class="card-body">
                    <div class="table tabel-responsive">
                        <table class="table" id="dataCategory">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Slug</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->slug }}</td>
                                    <td>
                                        <a href="{{ route('category.edit', $data->id) }}" class="btn btn-sm btn-warning">Edit</a> |
                                        <a href="{{ route('category.destroy', $data->id) }}" class="btn btn-sm btn-danger" data-confirm-delete>Delete</a>
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
   new DataTable('#dataCategory');
</script>
@endpush