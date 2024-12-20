@extends('layouts.app')

@section('styles')
<style>
    :root {
        --primary-color: #62929A;
        --primary-light: #7BA7AE;
        --text-dark: #2D3436;
        --text-muted: #636E72;
        --bg-light: #F5F6FA;
    }

    .order-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        border: none;
    }

    .order-header {
        background: var(--primary-color);
        color: white;
        padding: 1.5rem;
        border-radius: 12px 12px 0 0;
    }

    .order-body {
        padding: 1.5rem;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .status-paid {
        background: #27AE60;
        color: white;
    }

    .status-unpaid {
        background: #E74C3C;
        color: white;
    }

    .product-item {
        padding: 1rem;
        margin-bottom: 0.5rem;
        background: var(--bg-light);
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .product-item:hover {
        transform: translateX(5px);
    }

    .total-section {
        background: var(--bg-light);
        padding: 1.5rem;
        border-radius: 8px;
        margin: 1.5rem 0;
    }

    .upload-section {
        background: var(--bg-light);
        padding: 1.5rem;
        border-radius: 8px;
    }

    .btn-primary {
        background: var(--primary-color);
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: var(--primary-light);
        transform: translateY(-2px);
    }

    .file-upload {
        border: 2px dashed var(--primary-color);
        padding: 1.5rem;
        border-radius: 8px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .file-upload:hover {
        border-color: var(--primary-light);
        background: rgba(98, 146, 154, 0.05);
    }

    @media (max-width: 768px) {
        .order-header {
            padding: 1rem;
        }
        
        .order-body {
            padding: 1rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container py-4" style="background-color: white; margin-top: 2.5rem; border-radius: 25px">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="order-card">
                <!-- Header Section -->
                <div class="order-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1">Order #{{ $order->id }}</h4>
                            <p class="mb-0 text-white-50">{{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <span class="status-badge {{ $order->is_paid ? 'status-paid' : 'status-unpaid' }}">
                            {{ $order->is_paid ? 'Paid' : 'Unpaid' }}
                        </span>
                    </div>
                </div>

                <!-- Order Body -->
                <div class="order-body">
                    <!-- Customer Info -->
                    <div class="mb-4">
                        <h6 class="text-muted mb-2">Customer Details</h6>
                        <h5 class="mb-0">{{ $order->user->name }}</h5>
                        <p class="text-muted mb-0">{{ $order->user->email }}</p>
                    </div>

                    <!-- Products List -->
                    <div class="mb-4">
                        <h6 class="text-muted mb-3">Order Items</h6>
                        @php $total_price = 0; @endphp
                        
                        @foreach ($order->transactions as $transaction)
                            <div class="product-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $transaction->product->name }}</h6>
                                    <p class="mb-0 text-muted">
                                        Rp{{ number_format($transaction->product->price, 0, ',', '.') }} x {{ $transaction->amount }}
                                    </p>
                                </div>
                                <div class="text-end">
                                    <h6>Rp{{ number_format($transaction->product->price * $transaction->amount, 0, ',', '.') }}</h6>
                                </div>
                            </div>
                            @php
                                $total_price += $transaction->product->price * $transaction->amount;
                            @endphp
                        @endforeach
                    </div>

                    <!-- Total Section -->
                    <div class="total-section">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Total Amount</h5>
                            <h4 class="mb-0">Rp{{ number_format($total_price, 0, ',', '.') }}</h4>
                        </div>
                    </div>

                    <!-- Payment Upload Section -->
                    @if ($order->is_paid == false && $order->payment_receipt == null && !Auth::user()->is_admin)
                        <div class="upload-section">
                            <h6 class="mb-3">Upload Payment Receipt</h6>
                            <form action="{{ route('submit_payment_receipt', $order) }}" method="post" 
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="file-upload mb-3">
                                    <input type="file" name="payment_receipt" 
                                           class="form-control" id="payment_receipt" hidden>
                                    <label for="payment_receipt" class="mb-0">
                                        <i class="fas fa-cloud-upload-alt mb-2"></i>
                                        <p class="mb-0 mt-5">Click or drag file to upload payment proof</p>
                                    </label>
                                </div>
                                <button type="submit" style="background-color:#62929A; color: white" class="btn w-100 pt-10">
                                    Submit Payment
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('payment_receipt').addEventListener('change', function(e) {
    let fileName = e.target.files[0](citation_0).name;
    let label = document.querySelector('label[for="payment_receipt"] p');
    label.textContent = fileName;
});
</script>
@endsection
