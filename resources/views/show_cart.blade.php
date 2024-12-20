@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-color: #62929A;
        --secondary-color: #F5F5F5;
        --text-color: #333333;
        --danger-color: #DC3545;
    }

    body {
        background-color: var(--secondary-color);
        color: var(--text-color);
    }

    .cart-container {
        padding: 2rem 0;
    }

    .cart-header {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--primary-color);
    }

    .cart-item {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 1.5rem;
        transition: transform 0.2s;
    }

    .cart-item:hover {
        transform: translateY(-2px);
    }

    .cart-item-image {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 8px;
    }

    .cart-item-details {
        padding: 1rem;
    }

    .product-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-color);
        margin-bottom: 0.5rem;
    }

    .quantity-control {
        max-width: 150px;
    }

    .quantity-input {
        border: 1px solid var(--primary-color);
        border-radius: 6px;
        padding: 0.5rem;
    }

    .update-btn {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        transition: opacity 0.2s;
    }

    .update-btn:hover {
        opacity: 0.9;
    }

    .delete-btn {
        background-color: var(--danger-color);
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        transition: opacity 0.2s;
    }

    .delete-btn:hover {
        opacity: 0.9;
    }

    .cart-summary {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .total-price {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--primary-color);
    }

    .checkout-btn {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 8px;
        width: 100%;
        font-weight: 600;
        transition: opacity 0.2s;
    }

    .checkout-btn:hover:not(:disabled) {
        opacity: 0.9;
    }

    .checkout-btn:disabled {
        background-color: #cccccc;
        cursor: not-allowed;
    }

    @media (max-width: 768px) {
        .cart-item {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .cart-item-image {
            width: 100%;
            height: 200px;
            margin-bottom: 1rem;
        }

        .quantity-control {
            margin: 1rem auto;
        }
    }
</style>

<div class="container cart-container">
    <div class="cart-header">
        <h2 class="text-center" style="font-weight: bold; color: #62929A" >Shopping Cart</h2>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p class="mb-0">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            @forelse ($carts as $cart)
                <div class="cart-item d-flex align-items-center p-3">
                    <img src="{{ url('storage/' . $cart->product->image) }}" 
                         alt="{{ $cart->product->name }}" 
                         class="cart-item-image">
                    
                    <div class="cart-item-details flex-grow-1">
                        <h5 class="product-name">{{ $cart->product->name }}</h5>
                        <p class="price mb-2">Rp{{ number_format($cart->product->price, 0, ',', '.') }} x {{ $cart->amount }}</p>
                        <p class="subtotal mb-3">Subtotal: Rp{{ number_format($cart->product->price * $cart->amount, 0, ',', '.') }}</p>
                        
                        <form action="{{ route('update_cart', $cart) }}" method="post" class="mb-2">
                            @method('patch')
                            @csrf
                            <div class="quantity-control d-flex gap-2">
                                <input type="number" class="form-control quantity-input" 
                                       name="amount" value="{{ $cart->amount }}" min="1">
                                <button class="update-btn" type="submit">Update</button>
                            </div>
                        </form>

                        <form action="{{ route('delete_cart', $cart) }}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="delete-btn">Remove</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-4">
                    <p>Your cart is empty</p>
                </div>
            @endforelse
        </div>

        <div class="col-lg-4">
            <div class="cart-summary">
                <h4 class="mb-4">Order Summary</h4>
                <div class="d-flex justify-content-between mb-3">
                    <span>Total Item(s):</span>
                    <span>{{ $carts->sum('amount') }}</span>
                </div>
                
                <div class="d-flex justify-content-between mb-4">
                    <span>Total Price:</span>
                    @php
                    $total = 0;
                @endphp
                
                @foreach($carts as $cart)
                    @php
                        $total += $cart->price * $cart->amount;
                    @endphp
                @endforeach
                
                <span class="total-price">
                    Rp{{ number_format($carts->sum(function($cart) {
                        return $cart->price * $cart->amount;
                    }), 0, ',', '.') }}
                </span>
                </div>

                <form action="{{ route('checkout') }}" method="post">
                    @csrf
                    <button type="submit" class="checkout-btn" 
                            @if ($carts->isEmpty()) disabled @endif>
                        Proceed to Checkout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
