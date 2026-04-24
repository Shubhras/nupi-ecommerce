@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/productdetail.css') }}" />
    <style>
        .qty-btn {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <!-- ================= PRODUCT DETAIL SECTION ================= -->
    <section class="product-detail-section py-5">
        <div class="container custom-container">
            <!-- Title -->
            <h1 class="product-title text-center mb-5">Nupi Light Coffee Bag</h1>

            <!-- Top Product Row -->
            <div class="row align-items-center g-3">
                <!-- Left Image -->
                <div class="col-md-6 text-center">
                    <img src="{{ asset('images/coffee-pouch.png') }}" class="img-fluid w-90" alt="Coffee Pouch" />
                </div>

                <!-- Right Info -->
                <div class="col-md-6">
                    <p class="product-desc">
                        Premium 500g light blend coffee beans, expertly roasted to <br />
                        perfection with a smooth, aromatic flavor that captures the <br />
                        essence of quality coffee
                    </p>

                    <h3 class="product-price">$ 12.00</h3>

                    <!-- Quantity -->
                    <div class="quantity-box mt-3">
                        <p class="mb-1 fw-bold">Quantity</p>

                        <div class="d-flex align-items-center gap-2">
                            <button class="qty-btn" id="qty-minus">-</button>
                            <span class="qty-number" id="qty-display">1</span>
                            <button class="qty-btn" id="qty-plus">+</button>
                        </div>
                    </div>

                    <!-- Button -->
                    <button id="add-to-cart-btn" class="btn add-cart-btn mt-4"> Add to Cart </button>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="row align-items-center mt-5 g-5">
                <!-- Reviews Image -->
                <div class="col-md-6 text-center">
                    <img src="{{ asset('images/reviews.png') }}" alt="Reviews Illustration" class="img-fluid w-75" />
                </div>

                <!-- Review Text -->
                <div class="col-md-6">
                    <h3 class="review-title">Reviews</h3>

                    <p class="stars">★★★★★</p>

                    <p class="review-score"><b>5 out of 5</b></p>

                    <p class="review-text">
                        Absolutely love this coffee! <br />
                        It’s smooth and flavourful, perfect for my morning routine.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const qtyMinus = document.getElementById('qty-minus');
            const qtyPlus = document.getElementById('qty-plus');
            const qtyDisplay = document.getElementById('qty-display');
            const addToCartBtn = document.getElementById('add-to-cart-btn');

            let quantity = 1;

            qtyMinus.addEventListener('click', () => {
                if (quantity > 1) {
                    quantity--;
                    qtyDisplay.innerText = quantity;
                }
            });

            qtyPlus.addEventListener('click', () => {
                quantity++;
                qtyDisplay.innerText = quantity;
            });

            addToCartBtn.addEventListener('click', () => {
                addToCartBtn.innerText = 'Adding...';
                addToCartBtn.disabled = true;

                fetch("{{ route('cart.add') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        id: 1, // Static ID for now as per page
                        quantity: quantity
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        addToCartBtn.innerText = 'Add to Cart';
                        addToCartBtn.disabled = false;

                        if (data.success) {
                            // Update header cart count
                            updateCartCount(data.cartCount);

                            // Reset quantity
                            quantity = 1;
                            qtyDisplay.innerText = 1;

                            // Open Cart Modal directly
                            const cartIcon = document.getElementById('cart-icon');
                            if (cartIcon) {
                                cartIcon.click();
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        addToCartBtn.innerText = 'Add to Cart';
                        addToCartBtn.disabled = false;
                    });
            });

            function updateCartCount(count) {
                const badge = document.getElementById('cart-count-badge');
                if (badge) {
                    badge.innerText = count;
                    badge.style.display = count > 0 ? 'inline-block' : 'none';
                }
            }
        });
    </script>
@endsection