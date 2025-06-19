<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Tambah Buku</h2> <hr>
    <form action="/buku/{{$buku['id'] }}" method="post">
        @csrf
        @method('PUT')
        <input type="text" name="judul" value="{{ $buku['judul'] }}" required><br>
        <input type="number" name="harga" value="{{ $buku['harga'] }}" required><br>
        <select name="kategori" id="" required>
            <option value="{{ $buku['kategori'] == 'Self Improvment' ? 'selected' : ''}}">Self Improvment</option>
            <option value="{{ $buku['kategori'] == 'Bacaan' ? 'selected' : ''}}">Bacaan</option>
            <option value="{{ $buku['kategori'] == 'Teknologi' ? 'selected' : ''}}">Teknologi</option>
        </select><br>
        <button type="submit">Simpan</button>
        <button type="submit">Refresh</button>
    </form>
</body>
</html>