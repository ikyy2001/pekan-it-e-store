@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-color: #62929A;
        --secondary-color: #F5F5F5;
        --text-dark: #2D3436;
        --text-light: #FFFFFF;
        --spacing-sm: 0.5rem;
        --spacing-md: 1rem;
        --spacing-lg: 2rem;
    }

    .orders-container {
        padding: var(--spacing-lg);
        max-width: 1200px;
        margin: 0 auto;
    }

    .order-card {
        background: var(--text-light);
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: transform 0.2s ease;
        margin-bottom: var(--spacing-md);
        border: none;
    }

    .order-card:hover {
        transform: translateY(-3px);
    }

    .order-header {
        background: var(--primary-color);
        color: var(--text-light);
        padding: var(--spacing-md);
        border-radius: 12px 12px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .order-content {
        padding: var(--spacing-md);
    }

    .order-id {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-light);
        text-decoration: none;
    }

    .order-id:hover {
        color: var(--secondary-color);
    }

    .order-date {
        font-size: 0.9rem;
        color: var(--text-light);
    }

    .order-customer {
        color: var(--text-dark);
        font-size: 1rem;
        margin-bottom: var(--spacing-sm);
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.9rem;
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

    .action-buttons {
        display: flex;
        gap: var(--spacing-md);
        margin-top: var(--spacing-md);
    }

    .btn-receipt {
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        transition: background 0.2s ease;
    }

    .btn-receipt:hover {
        background: #557B80;
        color: white;
    }

    .btn-confirm {
        background: #27AE60;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        transition: background 0.2s ease;
    }

    .btn-confirm:hover {
        background: #219A52;
    }

    @media (max-width: 768px) {
        .orders-container {
            padding: var(--spacing-md);
        }

        .order-header {
            flex-direction: column;
            align-items: flex-start;
            gap: var(--spacing-sm);
        }

        .action-buttons {
            flex-direction: column;
            width: 100%;
        }

        .btn-receipt, .btn-confirm {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="orders-container">
    <h2 class="mb-4" style="color: var(--primary-color)">Order History</h2>
    
    @foreach ($orders as $order)
    <div class="order-card">
        <div class="order-header">
            <div>
                <a href="{{ route('show_order', $order) }}" class="order-id">
                    #{{ $order->id }}
                </a>
                <div class="order-date">
                    {{ $order->created_at->format('d M Y, H:i') }}
                </div>
            </div>
            <span class="status-badge {{ $order->is_paid ? 'status-paid' : 'status-unpaid' }}">
                {{ $order->is_paid ? 'Paid' : 'Unpaid' }}
            </span>
        </div>

        <div class="order-content">
            <div class="order-customer">
                <i class="fas fa-user me-2"></i>
                {{ $order->user->name }}
            </div>

            @if (!$order->is_paid && $order->payment_receipt)
            <div class="action-buttons">
                <a href="{{ url('storage/' . $order->payment_receipt) }}" 
                   class="btn-receipt">
                    <i class="fas fa-receipt me-2"></i>
                    View Receipt
                </a>

                @if (Auth::user()->is_admin)
                <form action="{{ route('confirm_payment', $order) }}" method="post">
                    @csrf
                    <button type="submit" class="btn-confirm">
                        <i class="fas fa-check me-2"></i>
                        Confirm Payment
                    </button>
                </form>
                @endif
            </div>
            @endif
        </div>
    </div>
    @endforeach
</div>
@endsection
