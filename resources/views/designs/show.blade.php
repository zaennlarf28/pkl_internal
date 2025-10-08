@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <h1>Preview Desain</h1>
    <img src="{{ asset('storage/' . $design->image_path) }}" class="img-fluid">
    <p><b>Judul:</b> {{ $design->title }}</p>
    <p><b>Catatan:</b> {{ $design->note }}</p>
    <p><b>Status:</b> {{ ucfirst($design->status) }}</p>
</div>
@endsection
