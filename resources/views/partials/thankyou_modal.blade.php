<section class="thankyou-wrapper" id="thankyou-modal">
    <div class="thankyou-container">
        <!-- Header (Steps + Close) -->
        <div class="thankyou-header">
            <!-- Steps -->
            <div class="thankyou-steps">
                <span class="step active">Cart</span>
                <span class="dot active"></span>
                <span class="step active">Checkout</span>
                <span class="dot active"></span>
                <span class="step active">Confirmation</span>
            </div>

            <!-- Close Button -->
            <button type="button" class="btn-close" aria-label="Close"
                onclick="document.getElementById('thankyou-modal').remove(); document.getElementById('cart-count-badge').style.display='none';"></button>
        </div>

        <!-- Cup Icon -->
        <img src="{{ asset('images/cup2.png') }}" class="cup-icon" alt="Cup Icon" />

        <!-- Title -->
        <h2 class="thankyou-title">Thank You for Your Order!</h2>

        <p class="thankyou-text">
            Your Nupi goodies are being prepared with love and <br />
            will be delivered shortly.
        </p>

        <!-- Button -->
        <button type="button" class="continue-btn"
            onclick="document.getElementById('thankyou-modal').remove(); document.getElementById('cart-count-badge').style.display='none';">Continue
            Shopping</button>

        <!-- Order Box -->
        <div class="order-box">
            <!-- Order Header -->
            <div class="order-header">
                <h6>Order #NUPI-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h6>
                <p>Arriving in the next 30 minutes</p>
            </div>

            <!-- Shipping + Payment -->
            <div class="row small-details">
                <div class="col-md-6">
                    <p><strong>Shipping to:</strong><br />
                        {{ $order->full_name }} <br>
                        {{ $order->address }},<br>
                        {{ $order->city }}, {{ $order->state }}<br>
                        Contact: {{ $order->phone }}
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p><strong>Payment Method:</strong><br />
                        @if($order->payment_method == 'card')
                            Visa ending in **** {{ $order->card_last4 }}
                        @else
                            Cash on Delivery
                        @endif
                    </p>
                </div>
            </div>

            <hr />

            <!-- Items Ordered -->
            <h6 class="items-title">Items ordered</h6>

            @foreach($order->items as $item)
                <div class="ordered-item d-flex align-items-center mb-3">
                    <div class="item-img">
                        <img src="{{ asset('images/coffee_pouch_mockup.png') }}" alt="coffee" />
                    </div>

                    <div class="ms-3 flex-grow-1">
                        <p class="mb-0 fw-bold">{{ $item->product_name }}</p>
                        <small>Qty: {{ $item->quantity }}</small>
                    </div>

                    <p class="mb-0 fw-bold ms-4">$ {{ number_format($item->total, 2) }}</p>
                </div>
            @endforeach

            <hr />

            <!-- Recommendation + Summary -->
            <div class="row">
                <!-- Recommendations -->
                <div class="col-md-7">
                    <h6 class="items-title">You Might also Like</h6>

                    <div class="d-flex gap-3 mt-2">
                        <!-- Product 1 -->
                        <div class="mini-product text-center">
                            <img src="{{ asset('images/coffee_pouch_mockup.png') }}" />
                            <p>Dark Roast</p>
                            <button>Add to Cart</button>
                        </div>

                        <!-- Product 2 -->
                        <div class="mini-product text-center">
                            <img src="{{ asset('images/coffee_pouch_mockup.png') }}" />
                            <p>Light Roast</p>
                            <button>Add to Cart</button>
                        </div>

                        <!-- Product 3 -->
                        <div class="mini-product text-center">
                            <img src="{{ asset('images/coffee_pouch_mockup.png') }}" />
                            <p>Raw Roast</p>
                            <button>Add to Cart</button>
                        </div>
                    </div>
                </div>

                <!-- Summary -->
                <div class="col-md-5 summary-box">
                    <p>Subtotal: <span>$ {{ number_format($order->subtotal, 2) }}</span></p>
                    <p>Shipping: <span>$ {{ number_format($order->shipping, 2) }}</span></p>
                    <p>Tax: <span>$ {{ number_format($order->tax, 2) }}</span></p>
                    <p class="total">Total: <span>$ {{ number_format($order->total, 2) }}</span></p>
                </div>
            </div>
        </div>
    </div>
</section>