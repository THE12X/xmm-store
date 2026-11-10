@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 2rem auto;">
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h2>Add New Phone</h2>
            <a href="{{ route('products.index') }}" class="btn btn-outline">Back</a>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Phone Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="e.g. Galaxy S23 Ultra" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="brand">Brand</label>
                    <input type="text" name="brand" id="brand" class="form-control" placeholder="e.g. Samsung" required>
                </div>

                <div class="form-group">
                    <label for="price">Price ($)</label>
                    <input type="number" step="0.01" name="price" id="price" class="form-control" placeholder="999.99" required>
                </div>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="Casual">Casual</option>
                    <option value="Gaming">Gaming</option>
                    <option value="Heavy Usage">Heavy Usage</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description (Optional)</label>
                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter specs or highlights..."></textarea>
            </div>

            <div class="form-group">
                <label for="image">Phone Image</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Save Product</button>
        </form>
    </div>
</div>
@endsection