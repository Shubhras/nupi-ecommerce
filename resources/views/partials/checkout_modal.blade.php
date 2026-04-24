<section class="checkout-wrapper" id="checkout-modal">
    <div class="checkout-container">
        <!-- LEFT SIDE -->
        <div class="checkout-left">
            <!-- Page Title -->
            <h2 class="checkout-title">Checkout</h2>

            <!-- Shipping Info -->
            <h4 class="section-heading">Shipping Information</h4>

            <form class="shipping-form" id="checkout-form">
                <input type="text" name="full_name" id="full_name" placeholder="Full Name"
                    class="form-control custom-input" required />

                <input type="email" name="email" id="email" placeholder="Email Address"
                    class="form-control custom-input" required />

                <input type="text" name="phone" id="phone" placeholder="Phone Number" class="form-control custom-input"
                    required />

                <!-- Address Row -->
                <div class="row g-2">
                    <div class="col-md-6">
                        <input type="text" name="street_address" id="street_address" placeholder="Street Address"
                            class="form-control custom-input" required />
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="city" id="city" placeholder="City" class="form-control custom-input"
                            required />
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="state" id="state" placeholder="State" class="form-control custom-input"
                            required />
                    </div>
                </div>

                <!-- Country Dropdown -->
                <select class="form-select custom-input" name="country" id="country" required>
                    <option value="" selected disabled>Country</option>
                    <option value="India">India</option>
                    <option value="USA">USA</option>
                    <option value="Canada">Canada</option>
                </select>

                <p class="secure-text">
                    Your information is secure and will never be shared.
                </p>


                <!-- Payment Details -->
                <h4 class="section-heading mt-5">Payment Details</h4>

                <div class="payment-box">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="payment_method" value="card"
                            id="payment_card" checked />
                        <label class="form-check-label fw-bold" for="payment_card">
                            Credit/Debit Card
                        </label>
                    </div>

                    <div id="card-details-section">
                        <input type="text" name="card_number" id="card_number" placeholder="Card Number"
                            class="form-control custom-input-sm" />

                        <div class="row g-2 mt-2">
                            <div class="col-md-6">
                                <input type="text" name="card_expiry" id="card_expiry" placeholder="Expiry Date (MM/YY)"
                                    class="form-control custom-input-sm" />
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="card_cvv" id="card_cvv" placeholder="CVV"
                                    class="form-control custom-input-sm" />
                            </div>
                        </div>
                    </div>

                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="save_details" id="save_details" />
                        <label class="form-check-label small" for="save_details">
                            Save Payment Details
                        </label>
                    </div>

                    <div class="form-check mt-3">
                        <input class="form-check-input" type="radio" name="payment_method" value="cod"
                            id="payment_cod" />
                        <label class="form-check-label fw-bold" for="payment_cod"> Cash on Delivery </label>
                    </div>
                </div>
            </form>
        </div>

        <!-- RIGHT SIDE -->
        <div class="checkout-right">
            <!-- Close Button -->
            <button type="button" class="btn-close position-absolute top-0 end-0" style="z-index: 10;"
                aria-label="Close" id="close-checkout-modal"></button>

            <!-- Steps -->
            <div class="checkout-steps">
                <span class="step active">Cart</span>
                <span class="dot active"></span>
                <span class="step active">Checkout</span>
                <span class="dot"></span>
                <span class="step">Confirmation</span>
            </div>

            <!-- Order Summary -->
            <div class="order-card">
                <h5 class="order-title">Order Summary</h5>

                <!-- Product List Container -->
                <div id="checkout-items-container">
                    <!-- Products injected here -->
                </div>

                <hr />

                <!-- Pricing -->
                <div class="order-line">
                    <span>Subtotal:</span>
                    <span id="checkout-subtotal">$ 0.00</span>
                </div>

                <div class="order-line">
                    <span>Shipping:</span>
                    <span id="checkout-shipping">$ 0.00</span>
                </div>

                <div class="order-line">
                    <span>Tax:</span>
                    <span id="checkout-tax">$ 0.00</span>
                </div>

                <hr />

                <div class="order-line total">
                    <span>Total:</span>
                    <span id="checkout-total">$ 0.00</span>
                </div>

                <!-- Button -->
                <button type="button" id="place-order-btn" class="place-order-btn mt-3">Place Order</button>
            </div>

            <!-- Illustration -->
            <img src="{{ asset('images/checkout.png') }}" class="checkout-illustration" alt="illustration" />
        </div>
    </div>
</section>

<!-- Include jQuery and Validation Plugin if not already included in layout (Adding conditionally or safe to add) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
    $(document).ready(function () {
        // Toggle Card Details logic
        $('input[name="payment_method"]').change(function () {
            if ($(this).val() === 'cod') {
                $('#card-details-section').slideUp();
                $('#card_number').prop('required', false);
                $('#card_expiry').prop('required', false);
                $('#card_cvv').prop('required', false);
            } else {
                $('#card-details-section').slideDown();
                $('#card_number').prop('required', true);
                $('#card_expiry').prop('required', true);
                $('#card_cvv').prop('required', true);
            }
        });

        // Initialize Validation
        $('#checkout-form').validate({
            rules: {
                full_name: "required",
                email: {
                    required: true,
                    email: true
                },
                phone: "required",
                street_address: "required",
                city: "required",
                state: "required",
                country: "required",
                card_number: {
                    required: function (element) {
                        return $('input[name="payment_method"]:checked').val() === 'card';
                    },
                    digits: true,
                    minlength: 16,
                    maxlength: 16
                },
                card_expiry: {
                    required: function (element) {
                        return $('input[name="payment_method"]:checked').val() === 'card';
                    },
                    // Basic regex for MM/YY
                    pattern: /^(0[1-9]|1[0-2])\/?([0-9]{2})$/
                },
                card_cvv: {
                    required: function (element) {
                        return $('input[name="payment_method"]:checked').val() === 'card';
                    },
                    digits: true,
                    minlength: 3,
                    maxlength: 3
                }
            },
            messages: {
                full_name: "Please enter your full name",
                email: "Please enter a valid email address",
                phone: "Please enter your phone number",
                street_address: "Address is required",
                city: "City is required",
                state: "State is required",
                country: "Please select a country",
                card_number: {
                    required: "Card number is required",
                    digits: "Please enter only numbers",
                    minlength: "Card number must be 16 digits",
                    maxlength: "Card number must be 16 digits"
                },
                card_expiry: {
                    required: "Expiry date is required",
                    pattern: "Please enter a valid date (MM/YY)"
                },
                card_cvv: {
                    required: "CVV is required",
                    digits: "Please enter only numbers",
                    minlength: "CVV must be 3 digits",
                    maxlength: "CVV must be 3 digits"
                }
            },
            errorElement: 'span',
            errorClass: 'text-danger small ms-1', // Added margin-left for better spacing
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        // Add custom validation method for regex if not exists
        $.validator.addMethod("pattern", function (value, element, param) {
            if (this.optional(element)) {
                return true;
            }
            if (typeof param === "string") {
                param = new RegExp("^(?:" + param + ")$");
            }
            return param.test(value);
        }, "Invalid format.");

        // Handle Place Order Click
        $('#place-order-btn').click(function (e) {
            e.preventDefault();

            if ($('#checkout-form').valid()) {
                const formData = new FormData($('#checkout-form')[0]);

                // Show loading state
                const originalBtnText = $(this).text();
                $(this).text('Processing...').prop('disabled', true);

                fetch("{{ route('checkout.place_order') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Hide Checkout Modal first
                            $('#checkout-modal').hide();
                            
                            // Reset the form
                            $('#checkout-form')[0].reset();

                            // Remove any existing thank you modal to avoid duplicates
                            $('#thankyou-modal').remove();

                            // Append new modal to body
                            $('body').append(data.html);
                        } else {
                            // Handle validation errors from backend
                            if (data.errors) {
                                let errorMsg = '';
                                for (const [key, value] of Object.entries(data.errors)) {
                                    errorMsg += value[0] + '<br>';
                                }
                                Swal.fire({
                                    title: 'Error!',
                                    html: errorMsg,
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: data.message || 'Something went wrong.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'An unexpected error occurred.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    })
                    .finally(() => {
                        // Reset button
                        $(this).text(originalBtnText).prop('disabled', false);
                    });
            }
        });
    });
</script>