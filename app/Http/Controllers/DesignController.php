<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Design;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DesignController extends Controller
{
    public function create(Product $product)
    {
        // Debug: Cek path gambar
        $imagePath = Storage::url($product->image);
        \Log::info('Product image URL: ' . $imagePath . ' for product: ' . $product->name);
        
        if (!Storage::disk('public')->exists($product->image)) {
            \Log::error('Product image not found: ' . $product->image . ' for product ID: ' . $product->id);
        }
        
        return view('designs.editor', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'note' => 'nullable|string',
            'image_data' => 'required|string', // Base64 validation sederhana
        ]);

        $imageName = null;
        if ($request->has('image_data')) {
            $imageData = $request->input('image_data'); 
            $image = str_replace('data:image/png;base64,', '', $imageData);
            $image = str_replace(' ', '+', $image);
            $imageName = 'designs/' . uniqid() . '.png';
            Storage::disk('public')->put($imageName, base64_decode($image));
        }

        $design = Design::create([
            'user_id'   => Auth::id(),
            'product_id'=> $product->id,
            'title'     => $request->title,
            'note'      => $request->note,
            'image_path'=> $imageName,
            'status'    => 'pending',
        ]);

        return redirect()->route('designs.show', $design)->with('success','Design saved!');
    }

    public function show(Design $design)
    {
        return view('designs.show', compact('design'));
    }

    // Tambah method admin index jika perlu (sudah di route)
    public function index()
    {
        $designs = Design::with(['user', 'product'])->latest()->get();
        return view('backend.designs.index', compact('designs'));
    }
}
