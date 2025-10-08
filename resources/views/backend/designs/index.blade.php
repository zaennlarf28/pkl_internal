@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <h3>Daftar Desain User</h3>
    <table class="table">
        <thead>
            <tr>
                <th>#</th><th>User</th><th>Produk</th><th>Preview</th><th>Note</th><th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($designs as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->user->name ?? 'Guest' }}</td>
                <td>{{ $d->product->name ?? '-' }}</td>
                <td>
                    @if($d->image_path)
                        <a href="{{ asset('storage/'.$d->image_path) }}" target="_blank">
                            <img src="{{ asset('storage/'.$d->image_path) }}" style="height:60px;">
                        </a>
                    @endif
                </td>
                <td>{{ Str::limit($d->note, 50) }}</td>
                <td>{{ $d->created_at->format('Y-m-d H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
