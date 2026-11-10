@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 2rem auto;">
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h2>Edit Product</h2>
            <a href="{{ route('products.index') }}" class="btn btn-outline">Back</a>
        </div>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Phone Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $product->title }}" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="brand">Brand</label>
                    <input type="text" name="brand" id="brand" class="form-control" value="{{ $product->brand }}" required>
                </div>

                <div class="form-group">
                    <label for="price">Price ($)</label>
                    <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ $product->price }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="Casual" {{ $product->category == 'Casual' ? 'selected' : '' }}>Casual</option>
                    <option value="Gaming" {{ $product->category == 'Gaming' ? 'selected' : '' }}>Gaming</option>
                    <option value="Heavy Usage" {{ $product->category == 'Heavy Usage' ? 'selected' : '' }}>Heavy Usage</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ $product->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Change Image (Optional)</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                @if($product->image)
                    <div style="margin-top: 10px;">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" style="width: 80px; height: 80px; object-fit: contain; border-radius: 8px; border: 1px solid var(--border);">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Update Product</button>
        </form>
    </div>
</div>
@endsection