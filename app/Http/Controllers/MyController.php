<?php

namespace App\Http\Controllers;

// Import Request
use Illuminate\Http\Request;

class MyController extends Controller
{
    // data array
    private $data = [
        ['id' => 1, 'judul' => 'Mencari Jati Diri', 'harga' => 75000, 'kategori' => 'Self Improvment'],
        ['id' => 2, 'judul' => 'Bacaan Sholat dan Dzikir', 'harga' => 25000, 'kategori' => 'Bacaan'],
        ['id' => 3, 'judul' => 'Laravel 12 Fundamental', 'harga' => 350000, 'kategori' => 'Teknologi'],
    ];

    public function index(){
        // mengambil data array lalu dimasukkan ke dalam sebuah session 'data_buku'
        $buku = session('data_buku', $this->data);
        return view('buku.index', compact('buku'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $buku  = session('data_buku', $this->data);

        // Membuat Id Baru Secara Increment
        $newId = collect($buku)->max('id') + 1;

        // Proses Menampung Data Buku
        $buku[] = [
            'id' => $newId,
            'judul' => $request -> judul,
            'harga' => $request -> harga,
            'kategori' => $request -> kategori,
        ];
        // Menambahkan Buku Baru ke Session data_buku Melalui Variabel Buku
        session(['data_buku' => $buku]);

        // Mengalihkan Halaman ke url Buku
        return redirect('buku');
    }

    public function show($id)
    {
        $buku = session('data_buku', $this->data);
        $buku = collect($buku)->firstWhere('id', $id);

        if (! $buku) {
            abort(404);
        }

        return view('buku.show', compact('buku'));
    }

    public function edit($id)
    {
        $buku = session('data_buku', $this->data);
        $buku = collect($buku)->firstWhere('id', $id);

        if (! $buku) {
            abort(404);
        }

        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $buku = session('data_buku', $this->data);

        //mencari data buku berdasarkan id
        foreach ($buku as &$data) {
            if ($data['id']== $id) {
                $data['judul'] = $request->judul;
                $data['harga'] = $request->harga;
                $data['kategori'] = $request->kategori;
                break;
            }
        }
    

    //mengembalikan data yang sudah di update ke dalam session
    session(['data_buku' => $buku]);
    return redirect('/buku');
    }

    public function destroy($id)
    {
        $buku = session('data_buku', $this->data);

        //cari index
        $index = array_search($id, array_column($buku, 'id'));
        array_splice($buku, $index, 1);

        session (['data_buku' => $buku]);
        return redirect('/buku'); 
    }
}
