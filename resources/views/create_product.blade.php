@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-color: #62929A;
        --primary-hover: #507980;
        --light-gray: #f5f5f5;
        --border-radius: 8px;
    }

    .product-form-container {
        max-width: 800px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .product-form-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .product-form-header {
        background: var(--primary-color);
        color: white;
        padding: 1.5rem;
        font-size: 1.25rem;
        font-weight: 600;
    }

    .product-form-body {
        padding: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #333;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: var(--border-radius);
        transition: all 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(98, 146, 154, 0.1);
    }

    .form-control::placeholder {
        color: #999;
    }

    .image-upload-wrapper {
        border: 2px dashed #ddd;
        padding: 2rem;
        text-align: center;
        border-radius: var(--border-radius);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .image-upload-wrapper:hover {
        border-color: var(--primary-color);
    }

    .image-upload-icon {
        font-size: 2rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .btn-submit {
        background: var(--primary-color);
        color: white;
        padding: 0.75rem 2rem;
        border: none;
        border-radius: var(--border-radius);
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-submit:hover {
        background: var(--primary-hover);
    }

    /* Responsive Design */
    @media (min-width: 768px) {
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }
        
        .btn-submit {
            width: auto;
        }
    }

    .description-input {
        min-height: 100px;
        resize: vertical;
    }

    .price-input-group {
        position: relative;
    }

    .price-input-group:before {
        content: "Rp";
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
    }

    .price-input {
        padding-left: 2rem;
    }
</style>

<div class="product-form-container">
    <div class="product-form-card">
        <div class="product-form-header">
            {{ __('Create New Product') }}
        </div>

        <div class="product-form-body">
            <form action="{{ route('store_product') }}" method="post" enctype="multipart/form-data">
                @csrf
                
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Product Name</label>
                        <input type="text" 
                               name="name" 
                               placeholder="Enter product name" 
                               class="form-control"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Stock Quantity</label>
                        <input type="number" 
                               name="stock" 
                               placeholder="Enter available stock" 
                               class="form-control"
                               min="0"
                               required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" 
                              placeholder="Enter product description" 
                              class="form-control description-input"
                              required></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Price</label>
                    <div class="price-input-group">
                        <input type="number" 
                               name="price" 
                               placeholder="0" 
                               class="form-control price-input"
                               step="0.01"
                               min="0"
                               required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Product Image</label>
                    <div class="image-upload-wrapper">
                        <div class="image-upload-icon">📸</div>
                        <input type="file" 
                               name="image" 
                               class="form-control"
                               accept="image/*"
                               required>
                        <p class="text-muted mt-2">
                            Drag and drop your image here or click to browse
                        </p>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn-submit">
                        Create Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
