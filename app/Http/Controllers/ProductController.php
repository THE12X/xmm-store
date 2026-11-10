<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $products = $query->latest()->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        if (auth()->user()->role !== 1) {
            return redirect()->route('products.index')->with('error', 'Unauthorized access.');
        }
        return view('admin.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 1) {
            abort(403);
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'brand'       => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'category'    => 'required|in:Casual,Gaming,Heavy Usage',
            'description' => 'nullable|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'title'       => $request->title,
            'brand'       => $request->brand,
            'price'       => $request->price,
            'category'    => $request->category,
            'description' => $request->description,
            'image'       => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
        if (auth()->user()->role !== 1) {
            abort(403);
        }
        $product = Product::findOrFail($id);
        return view('admin.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 1) {
            abort(403);
        }

        $product = Product::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'brand'       => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'category'    => 'required|in:Casual,Gaming,Heavy Usage',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'title'       => $request->title,
            'brand'       => $request->brand,
            'price'       => $request->price,
            'category'    => $request->category,
            'description' => $request->description,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 1) {
            abort(403);
        }

        $product = Product::findOrFail($id);
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}