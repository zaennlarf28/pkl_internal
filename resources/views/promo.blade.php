<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @if($barang && $kode)
    Promo Untuk Barang <strong>{{$barang}}</strong> Dengan Kode Promo <strong>{{$kode}}</strong>
    @elseif($barang)
    Menampilkan Promo Untuk Barang <strong>{{ $barang }}</strong>
    @else
    Menampilkan Semua Promo Barang
    @endif
</body>
</html>