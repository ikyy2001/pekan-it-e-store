@extends('layouts.app')

@section('styles')
<style>
    :root {
        --primary-color: #62929A;
        --primary-hover: #557c83;
        --secondary-color: #f4f7f8;
        --text-color: #2d3436;
        --border-radius: 12px;
        --transition: all 0.3s ease;
    }

    .edit-product-container {
        max-width: 1000px;
        margin: 2.5rem auto;
        padding: 0 1.5rem;
    }

    .card {
        background: white;
        border: none;
        box-shadow: 0 8px 30px rgba(0,0,0,0.05);
        border-radius: var(--border-radius);
    }

    .card-header {
        background: var(--primary-color);
        color: white;
        padding: 1.5rem 2rem;
        font-size: 1.4rem;
        font-weight: 600;
        border-radius: var(--border-radius) var(--border-radius) 0 0;
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }

    .card-body {
        padding: 2.5rem 2rem;
    }

    .form-group {
        margin-bottom: 2rem;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 0.8rem;
        color: var(--text-color);
        display: block;
    }

    .form-control {
        padding: 0.9rem 1.2rem;
        border-radius: 8px;
        border: 2px solid #e9ecef;
        font-size: 1rem;
        transition: var(--transition);
        background-color: #fff;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(98, 146, 154, 0.1);
    }

    .input-group-text {
        background: var(--secondary-color);
        border: 2px solid #e9ecef;
        border-right: none;
        padding: 0.9rem 1.2rem;
        color: var(--text-color);
        font-weight: 500;
    }

    .image-preview-container {
        background: var(--secondary-color);
        padding: 1.5rem;
        border-radius: var(--border-radius);
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .current-image {
        max-width: 200px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .btn {
        padding: 0.9rem 2rem;
        font-weight: 600;
        border-radius: 8px;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary {
        background: var(--primary-color);
        border: none;
        color: white;
    }

    .btn-primary:hover {
        background: var(--primary-hover);
        transform: translateY(-2px);
    }

    .btn-outline-secondary {
        border: 2px solid #e9ecef;
        color: var(--text-color);
    }

    .btn-outline-secondary:hover {
        background: var(--secondary-color);
        border-color: #dee2e6;
    }

    .invalid-feedback {
        font-size: 0.875rem;
        margin-top: 0.5rem;
        color: #dc3545;
    }

    .file-upload {
        position: relative;
        overflow: hidden;
    }

    .file-upload input[type=file] {
        cursor: pointer;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .edit-product-container {
            margin: 1rem auto;
            padding: 0 1rem;
        }

        .card-header {
            padding: 1.2rem 1.5rem;
            font-size: 1.2rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .row {
            margin: 0;
        }

        .col-md-6 {
            padding: 0;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }
    }

    /* Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .card {
        animation: fadeIn 0.5s ease-out;
    }
</style>
@endsection

@section('content')
<div class="edit-product-container">
    <div class="card">
        <div class="card-header">
            <i class="fas fa-edit"></i>
            {{ __('Edit Product') }}
        </div>

        <div class="card-body">
            <form action="{{ route('update_product', $product) }}" method="post" enctype="multipart/form-data">
                @method('patch')
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Product Name</label>
                    <input type="text" 
                           name="name" 
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $product->name) }}"
                           placeholder="Enter product name"
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" 
                              class="form-control @error('description') is-invalid @enderror"
                              rows="4"
                              placeholder="Enter product description"
                              required>{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Price</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" 
                                       name="price" 
                                       class="form-control @error('price') is-invalid @enderror"
                                       value="{{ old('price', $product->price) }}"
                                       placeholder="0"
                                       required>
                            </div>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Stock</label>
                            <input type="number" 
                                   name="stock" 
                                   class="form-control @error('stock') is-invalid @enderror"
                                   value="{{ old('stock', $product->stock) }}"
                                   placeholder="0"
                                   required>
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Product Image</label>
                    @if($product->image)
                        <div class="image-preview-container">
                            <img src="{{ asset('storage/'.$product->image) }}" 
                                 alt="Current product image" 
                                 class="current-image">
                        </div>
                    @endif
                    <div class="file-upload">
                        <input type="file" 
                               name="image" 
                               class="form-control @error('image') is-invalid @enderror"
                               accept="image/*">
                    </div>
                    <small class="text-muted d-block mt-2">Leave empty if you don't want to change the image</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 pt-3">
                    <a href="{{ route('index_product') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Back to Products
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
