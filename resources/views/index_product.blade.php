@extends('layouts.app')

<style>
:root {
    --primary-color: #62929A;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 2rem;
    padding: 2rem;
}

.product-card {
    position: relative;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
    text-decoration: none;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 20px rgba(98, 146, 154, 0.15);
}

.product-image {
    position: relative;
    width: 100%;
    height: 240px;
    overflow: hidden;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.05);
}

.product-info {
    padding: 1.5rem;
    background: white;
}

.product-name {
    font-size: 1.25rem;
    font-weight: 600;
    color: #62929A;
    margin-bottom: 1rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.details-link {
    font-size: 0.9rem;
    color: #62929A;
    text-decoration: none;
    transition: color 0.2s ease;
}

.details-link:hover {
    color: #4e767c;
}

.section-header {
    background: linear-gradient(to right, #62929A, #62929A);
    color: white;
    padding: 2rem;
    margin-bottom: 2rem;
    border-radius: 0 0 20px 20px;
    box-shadow: 0 4px 12px rgba(98, 146, 154, 0.1);
}

.section-title {
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
}

/* Responsive adjustments remain the same */
@media (max-width: 768px) {
    .product-grid {
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1rem;
        padding: 1rem;
    }

    .section-header {
        padding: 1.5rem;
        border-radius: 0 0 15px 15px;
    }

    .section-title {
        font-size: 1.5rem;
    }

    .product-name {
        font-size: 1.1rem;
    }
}
</style>

@section('content')
<div class="section-header">
    <h1 class="section-title">{{ __('Our Products') }}</h1>
</div>

<div class="container">
    <div class="product-grid">
        @foreach ($products as $product)
            <div class="product-card" onclick="">
                <div class="product-image">
                    <img src="{{ url('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}"
                         loading="lazy"
                         onerror="this.src='path/to/placeholder-image.jpg'">
                </div>
                <div class="product-info">
                    <h3 class="product-name">{{ $product->name }}</h3>
                    <a href="{{ route('show_product', $product) }}" class="details-link">details >></a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
