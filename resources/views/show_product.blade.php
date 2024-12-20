@extends('layouts.app')

@section('content')
    <div style="margin-top: 2.5rem" class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p class="mb-0">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                    <div style="color: white; background: #62929A;" class="card-header">{{ __('Product Detail') }}</div>

                    <div class="card-body">
                        <div class="d-flex justify-content-around">
                            <div class="">
                                <img style="border-radius: 12px" src="{{ url('storage/' . $product->image) }}" alt="" width="200px">
                            </div>
                            <div class="col-md-6">
                                <h1 style="color: #62929A; font-weight: bold" class="product-title">{{ $product->name }}</h1>
                                <p style="color: grey" class="product-description">{{ $product->description }}</p>
                                <h3 class="product-price mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</h3>
                                
                                <span class="stock-badge mb-4 d-inline-block">
                                    <i class="fas fa-box"></i> {{ $product->stock }} units left
                                </span>
        
                                @if (!Auth::user()->is_admin)
                                    <form action="{{ route('add_to_cart', $product) }}" method="post" class="mt-4">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input type="number" 
                                                   class="form-control quantity-input" 
                                                   name="amount" 
                                                   value="1" 
                                                   min="1" 
                                                   max="{{ $product->stock }}">
                                            <button class="custom-btn ms-2" style="background-color: #62929A" type="submit">
                                                <i class="fas fa-shopping-cart"></i> <span style="color: white">Add to Cart</span>
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <form action="{{ route('edit_product', $product) }}" method="get">
                                        <button type="submit" class="" style="background-color: #62929A; color: white; border-radius: 4px">
                                            <i class="fas fa-edit"></i> Edit Product
                                        </button>
                                    </form>
                                    <form action="{{ route('delete_product', $product) }}" method="get">
                                        <button type="submit" class="" style="background-color: rgb(163, 7, 7); color: white; border-radius: 4px">
                                            <i class="fas fa-edit"></i> Delete Product
                                        </button>
                                    </form>
                                @endif
        
                                <!-- Accordion Section -->
                                <div class="accordion mt-4" id="productAccordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" style="background-color: #62929A; color: white" data-bs-toggle="collapse" data-bs-target="#warrantyInfo">
                                                Warranty Information
                                            </button>
                                        </h2>
                                        <div id="warrantyInfo" class="accordion-collapse collapse" data-bs-parent="#productAccordion">
                                            <div class="accordion-body">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Garantisi produk berlaku selama 12 bulan.
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" style="background-color: #62929A; color: white" data-bs-toggle="collapse" data-bs-target="#shippingInfo">
                                                Shipping Information
                                            </button>
                                        </h2>
                                        <div id="shippingInfo" class="accordion-collapse collapse" data-bs-parent="#productAccordion">
                                            <div class="accordion-body">
                                                Pengiriman tersedia ke seluruh Indonesia menggunakan ekspedisi terpercaya. Estimasi 2-3 hari kerja.
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" style="background-color: #62929A; color: white" data-bs-toggle="collapse" data-bs-target="#workingHours">
                                                Working Hours
                                            </button>
                                        </h2>
                                        <div id="workingHours" class="accordion-collapse collapse" data-bs-parent="#productAccordion">
                                            <div class="accordion-body">
                                                Senin - Jumat: 09.00 - 17.00 WIB<br>
                                                Sabtu: 09.00 - 15.00 WIB<br>
                                                Minggu & Hari Besar: Tutup
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
