@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <h1>Custom Desain untuk: {{ $product->name }}</h1>
    <p>Upload gambar desain Anda, atur posisi, ukuran, dan rotasi di atas produk. Seperti Redbubble!</p>

    {{-- DEBUG: Tampilkan URL dan img produk biasa untuk test (hapus setelah fix) --}}
    <div class="alert alert-info">
        <strong>Debug Info (Hapus setelah test):</strong><br>
        Product Image Path di DB: {{ $product->image ?? 'KOSONG! (Cek DB)' }}<br>
        Full URL untuk Canvas: {{ url(Storage::url($product->image ?? '')) }}<br>
        <img src="{{ url(Storage::url($product->image ?? '')) }}" alt="Test Product Image" style="max-width: 200px; border: 1px solid red; display: block;">
        {{-- Jika img ini muncul (bukan X merah), path/storage OK. Jika broken, fix DB/storage link. --}}
    </div>

    <div class="row mt-4">
        <div class="col-md-8">
            <canvas id="editor-canvas" width="500" height="500" style="border:2px solid black; display: block; cursor: move;"></canvas>
            
            <!-- Tools untuk interaksi (FIX: Nested label untuk hilangkan warning) -->
            <div class="mt-3">
                <div class="btn-group" role="group">
                    <label class="btn btn-outline-primary" style="cursor: pointer;">
                        <input type="file" id="image-upload" accept="image/*" style="display: none;">
                        Upload Gambar Desain
                    </label>
                    
                    <button type="button" id="add-text" class="btn btn-outline-secondary">Tambah Teks</button>
                    <button type="button" id="clear-canvas" class="btn btn-outline-danger">Hapus Semua (Kecuali Background)</button>
                </div>
                <small class="text-muted">Drag untuk pindah, resize untuk ubah ukuran, rotate untuk putar. Cek console (F12) untuk debug log.</small>
            </div>
        </div>
        
        <div class="col-md-4">
            <form id="design-form" method="POST" action="{{ route('designs.store', $product) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="image_data" id="image_data">
                <div class="mb-3">
                    <label for="title" class="form-label">Judul Desain</label> <!-- FIX: for & class -->
                    <input type="text" id="title" class="form-control" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="note" class="form-label">Catatan</label> <!-- FIX: for & class -->
                    <textarea id="note" class="form-control" name="note" rows="3"></textarea>
                </div>
                <button type="button" id="saveDesign" class="btn btn-primary w-100">Simpan Desain</button>
            </form>
            
            <!-- Preview hasil -->
            <div class="mt-3">
                <h6>Preview Hasil</h6>
                <img id="preview-img" src="" alt="Preview" style="max-width: 100%; border:1px solid #ddd; display: none;">
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.0/fabric.min.js"></script>
<script>
    console.log('=== EDITOR DEBUG START ===');
    console.log('Fabric.js loaded:', typeof fabric !== 'undefined');

    const canvas = new fabric.Canvas('editor-canvas', {
        width: 500,
        height: 500,
        backgroundColor: '#f9f9f9', // Latar abu muda agar kosong kelihatan
        preserveObjectStacking: true,
        selection: true
    });
    console.log('Canvas initialized, size: 500x500');

    // Test render: Persegi biru kecil di kiri atas (untuk konfirmasi canvas bekerja)
    const testRect = new fabric.Rect({
        left: 20,
        top: 20,
        width: 50,
        height: 50,
        fill: 'blue',
        selectable: false
    });
    canvas.add(testRect);
    canvas.renderAll();
    console.log('Test blue rect added - harus muncul di pojok kiri atas canvas! Jika tidak, cek CSS conflict.');

    // Background produk: Gunakan full URL + error handling lengkap
    const productImageUrl = "{{ url(Storage::url($product->image ?? '')) }}";
    console.log('Full product URL for Fabric:', productImageUrl);

    if (productImageUrl && productImageUrl !== '{{ url('') }}/storage/') {
        fabric.Image.fromURL(productImageUrl, function(img) {
            console.log('SUCCESS: Product image loaded! Original size:', img.width + 'x' + img.height);
            img.scaleToWidth(450); // Scale agar fit canvas
            img.lockScalingX = img.lockScalingY = true;
            img.lockRotation = true;
            img.selectable = false;
            canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
            console.log('Background image set successfully');
        }, { 
            crossOrigin: 'anonymous'
        }, function(err) {
            console.error('FAILED: Cannot load product image. Error:', err);
            console.log('URL tested:', productImageUrl);
            // Fallback: Rectangle abu-abu + teks error
            const fallbackRect = new fabric.Rect({
                left: 0,
                top: 0,
                width: 500,
                height: 500,
                fill: '#f0f0f0',
                selectable: false
            });
            canvas.add(fallbackRect);
            
            const fallbackText = new fabric.Text('Gambar Produk Gagal Load\nURL: ' + productImageUrl + '\nCek storage link & DB path', {
                left: 250,
                top: 250,
                fontSize: 14,
                fill: 'red',
                selectable: false,
                originX: 'center',
                originY: 'center'
            });
            canvas.add(fallbackText);
            canvas.renderAll();
            alert('Gambar produk gagal load. Lihat console untuk detail. Cek folder storage/app/public/products/ dan jalankan php artisan storage:link');
        });
    } else {
        console.warn('No product image path! Using placeholder.');
        // Placeholder jika path kosong
        fabric.Image.fromURL('https://via.placeholder.com/450x450/cccccc/000000?text=Produk+{{ $product->name ?? "Test" }}', function(img) {
            img.scaleToWidth(450);
            img.selectable = false;
            canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
        });
    }

    // Event: Upload gambar (FIX: Scale min 0.2, posisi center, border konfirmasi)
    document.getElementById('image-upload').addEventListener('change', function(e) {
        const file = e.target.files[0];
        console.log('=== UPLOAD DEBUG ===');
        console.log('File selected:', file ? (file.name + ' (' + (file.size / 1024).toFixed(0) + ' KB)') : 'No file');
        if (!file) return;

        // Validasi
        if (file.size > 5 * 1024 * 1024) {
            alert('File terlalu besar! Maksimal 5MB.');
            return;
        }
        if (!file.type.startsWith('image/')) {
            alert('File harus gambar (PNG, JPG, GIF, dll.)');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(event) {
            console.log('SUCCESS: File read as DataURL (length:', event.target.result.length, ')');
            const img = new Image();
            img.onload = function() {
                console.log('SUCCESS: Image onload! Dimensions:', img.width + 'x' + img.height);
                // FIX: Scale minimal 0.2 agar pasti visible, max 1.0 agar tidak overflow
                const maxDim = Math.max(img.width, img.height);
                const scale = Math.max(0.2, Math.min(1.0, 300 / maxDim)); // 300px max size awal
                const fabricImg = new fabric.Image(img, {
                    left: 250 - (img.width * scale / 2), // Center horizontal
                    top: 250 - (img.height * scale / 2), // Center vertical
                    scaleX: scale,
                    scaleY: scale,
                    angle: 0,
                    cornerColor: '#15a',
                    cornerSize: 12, // Handle lebih besar
                    transparentCorners: false,
                    selectable: true
                });
                canvas.add(fabricImg);
                canvas.setActiveObject(fabricImg);
                canvas.renderAll();
                
                // Konfirmasi: Border hijau sementara (bisa dihapus user)
                fabricImg.set({ stroke: 'green', strokeWidth: 2 });
                console.log('SUCCESS: Image added to canvas. Scale:', scale, 'Position:', fabricImg.left + ',' + fabricImg.top);
                console.log('Total objects now:', canvas.getObjects().length); // Background tidak di-count
                
                // Reset input
                e.target.value = '';
            };
            img.onerror = function(err) {
                console.error('ERROR: Image failed to load in canvas:', err);
                alert('Gambar tidak bisa dimuat (mungkin rusak). Coba file PNG/JPG lain.');
            };
            img.src = event.target.result;
        };
        reader.onerror = function(err) {
            console.error('ERROR: FileReader failed:', err);
            alert('Gagal membaca file. Coba lagi.');
        };
        reader.readAsDataURL(file);
    });

    // Event: Tambah teks
    document.getElementById('add-text').addEventListener('click', function() {
        const text = prompt('Masukkan teks baru:') || 'Teks Default';
        if (!text) return;

        const fabricText = new fabric.Textbox(text, {
            left: 100,
            top: 100,
            width: 200,
            fontSize: 24,
            fill: 'black',
            fontFamily: 'Arial',
            editable: true, // Bisa edit langsung di canvas
            selectable: true
        });
        canvas.add(fabricText);
        canvas.setActiveObject(fabricText);
        canvas.renderAll();
        console.log('Text added. Total objects:', canvas.getObjects().length);
    });

    // Event: Hapus semua (FIX: Skip background & test rect)
    document.getElementById('clear-canvas').addEventListener('click', function() {
        if (confirm('Hapus semua elemen desain? Background produk dan test rect tetap ada.')) {
            const beforeCount = canvas.getObjects().length;
            canvas.getObjects().forEach(function(obj) {
                // Skip test rect (blue) dan non-selectable (background)
                if (obj === testRect || !obj.selectable) {
                    return;
                }
                canvas.remove(obj);
            });
            canvas.discardActiveObject();
            canvas.renderAll();
            console.log('Cleared: Objects before/after:', beforeCount, '/', canvas.getObjects().length);
        }
    });

    // Event: Simpan desain (FIX: Check >0 karena background tidak di-count)
    document.getElementById('saveDesign').addEventListener('click', function() {
        console.log('=== SAVE DEBUG ===');
        const objectsCount = canvas.getObjects().length;
        console.log('Objects on canvas (excluding background):', objectsCount);
        
        if (objectsCount === 0) { // Hanya background/test rect, no desain
            alert('Tambahkan setidaknya satu elemen desain (gambar atau teks)!');
            return;
        }

        const dataURL = canvas.toDataURL({
            format: 'png',
            quality: 0.9,
            multiplier: 2 // Resolusi tinggi
        });
        
        console.log('DataURL generated. Length:', dataURL.length, '(jika <1000, canvas kosong)');
        
        if (dataURL.length < 1000) {
            alert('Gagal generate preview. Cek console.');
            return;
        }
        
        document.getElementById('image_data').value = dataURL;
        document.getElementById('preview-img').src = dataURL;
        document.getElementById('preview-img').style.display = 'block';
        
        // Submit setelah preview muncul
        setTimeout(function() {
            document.getElementById('design-form').submit();
        }, 500);
    });

    // Zoom dengan mouse wheel (opsional, seperti Redbubble)
    let zoomLevel = 1;
    canvas.on('mouse:wheel', function(opt) {
        const delta = opt.e.deltaY;
        zoomLevel *= (delta > 0 ? 0.9 : 1.1);
        zoomLevel = Math.max(0.5, Math.min(zoomLevel, 3)); // Batas 0.5x - 3x
        canvas.setZoom(zoomLevel);
        opt.e.preventDefault();
        opt.e.stopPropagation();
        console.log('Zoom level:', zoomLevel);
    });

    // Render ulang saat window resize
    window.addEventListener('resize', function() {
        canvas.renderAll();
    });

    console.log('=== EDITOR DEBUG END ===');
    console.log('Tips: Jika blue rect muncul tapi background tidak, cek URL di debug alert. Jika upload tidak muncul, coba gambar kecil PNG.');
</script>
@endsection