@extends('layouts.frontend')

@section('content')
<!-- breadcrumb -->
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb__title">
                <h1>Order Detail</h1>
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('order.index') }}">Order</a></li>
                    <li class="color_blue">Detail</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- order detail section -->
<div class="cartarea sp_top_100 sp_bottom_100">
    <div class="container">
        <div class="mb-4">
            <h4>Order Information</h4>
            <p><strong>Order Code:</strong> {{ $orders->order_code }}</p>
            <p><strong>Status :</strong>
                @if ($orders->status == 'pending')
                    <span class="badge bg-warning text-dark">Pending</span>
                @elseif ($orders->status == 'success')
                    <span class="badge bg-success">Success</span>
                @else
                    <span class="badge bg-danger">Canceled</span>
                @endif
            </p>
            <p><strong>Order Date:</strong> {{ $orders->created_at->format('d M Y, H:i') }}</p>
            <p><strong>Total Price:</strong> Rp {{ number_format($orders->total_price, 0, ',', '.') }}</p>
        </div>

        <div class="table-responsive">
            <h4>Products</h4>
            <table class="table table-bordered text-center align-middle">
                <thead class="thead-dark bg-dark text-white">
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders->products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->pivot->qty }}</td>
                        <td>Rp {{ number_format($product->pivot->price, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($product->pivot->qty * $product->pivot->price, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-end mt-4">
            <a href="{{ route('order.index') }}" class="btn btn-secondary">← Back to Order</a>
        </div>
    </div>
</div>
@endsection
