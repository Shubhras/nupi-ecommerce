<nav class="custom-navbar">
    <div class="nav-container custom-container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" class="logo" alt="logo" />
        </a>

        <!-- Hamburger Menu (Mobile Only) -->
        <button class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <!-- Desktop Navigation Links -->
        <ul class="custom-nav-links desktop-nav">
            <li><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
            </li>
            <li><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About
                    Us</a></li>
            <li><a class="nav-link {{ request()->routeIs('partner') ? 'active' : '' }}"
                    href="{{ route('partner') }}">Become a Partner</a></li>
            <li><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                    href="{{ route('contact') }}">Contact Us</a></li>
        </ul>

        <!-- Icons -->
        <div class="d-flex align-items-center gap-3 nav-icons">
            <span class="lang-pill">
                EN <img src="{{ asset('images/globe.png') }}" width="18" />
            </span>

            <div class="icon-circle"><img src="{{ asset('images/flag.png') }}" /></div>

            @guest
                <a href="{{ route('login') }}" class="icon-circle"><img src="{{ asset('images/user.png') }}" /></a>
            @else
                <div class="icon-circle dropdown">
                    <a href="#" class="d-block" data-bs-toggle="dropdown">
                        <img src="{{ asset('images/user.png') }}" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">{{ Auth::user()->name }}</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            @endguest

            <div class="icon-circle position-relative" id="cart-icon" style="cursor: pointer;">
                <img src="{{ asset('images/cart.png') }}" />
                @php
                    $cartCount = 0;
                    if (session('cart')) {
                        $cartCount = count(session('cart'));
                    }
                @endphp
                <span id="cart-count-badge"
                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    style="font-size: 0.6rem; display: {{ $cartCount > 0 ? 'inline-block' : 'none' }};">
                    {{ $cartCount }}
                </span>
            </div>

        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay" id="mobile-menu-overlay"></div>

    <!-- Mobile Menu Sidebar -->
    <div class="mobile-menu" id="mobile-menu">
        <div class="mobile-menu-header">
            <img src="{{ asset('images/logo.png') }}" class="mobile-menu-logo" alt="logo" />
            <button class="mobile-menu-close" id="mobile-menu-close">&times;</button>
        </div>
        <ul class="mobile-nav-links">
            <li><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
            </li>
            <li><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About
                    Us</a></li>
            <li><a class="nav-link {{ request()->routeIs('partner') ? 'active' : '' }}"
                    href="{{ route('partner') }}">Become a Partner</a></li>
            <li><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                    href="{{ route('contact') }}">Contact Us</a></li>
        </ul>
    </div>
</nav>

<script>
    // Mobile menu toggle
    document.addEventListener('DOMContentLoaded', function () {
        const menuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuOverlay = document.getElementById('mobile-menu-overlay');
        const menuClose = document.getElementById('mobile-menu-close');

        function openMenu() {
            mobileMenu.classList.add('active');
            menuOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeMenu() {
            mobileMenu.classList.remove('active');
            menuOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        if (menuToggle) {
            menuToggle.addEventListener('click', openMenu);
        }

        if (menuClose) {
            menuClose.addEventListener('click', closeMenu);
        }

        if (menuOverlay) {
            menuOverlay.addEventListener('click', closeMenu);
        }
    });
</script>

<div id="cart-overlay"></div>

<!-- CART MODAL -->
<div id="cart-modal" class="cart-modal-wrapper">
    <div class="cart-modal-card">
        <button class="cart-close-btn" id="cart-close-btn" aria-label="Close cart">&times;</button>
        <h2 class="cart-title">Your Cart</h2>
        <div class="cart-badge"><span id="modal-total-count">0</span> Item in your cart</div>

        <div id="cart-items-container">
            <!-- Items injected here -->
        </div>

        <div id="cart-footer">
            <hr class="cart-divider" />

            <div class="cart-subtotal d-flex justify-content-between">
                <span>Subtotal:</span>
                <strong id="modal-subtotal">$ 0.00</strong>
            </div>

            <div class="text-center mt-4">
                <button class="checkout-btn">Checkout</button>
            </div>
        </div>
    </div>
</div>

@include('partials.checkout_modal')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cartIcon = document.getElementById('cart-icon');
        const cartModal = document.getElementById('cart-modal');
        const cartOverlay = document.getElementById('cart-overlay');
        const cartItemsContainer = document.getElementById('cart-items-container');
        const modalTotalCount = document.getElementById('modal-total-count');
        const modalSubtotal = document.getElementById('modal-subtotal');

        // Checkout Modal Logic
        const checkoutModal = document.getElementById('checkout-modal');
        const checkoutBtn = document.querySelector('.checkout-btn');
        const closeCheckoutBtn = document.getElementById('close-checkout-modal');

        if (checkoutBtn) {
            checkoutBtn.addEventListener('click', function () {
                cartModal.style.display = 'none';
                if (cartOverlay) cartOverlay.style.display = 'none'; // Hide cart overlay
                if (checkoutModal) {
                    checkoutModal.style.display = 'flex';
                }
            });
        }

        if (closeCheckoutBtn && checkoutModal) {
            closeCheckoutBtn.addEventListener('click', function () {
                checkoutModal.style.display = 'none';
            });
        }

        if (checkoutModal) {
            checkoutModal.addEventListener('click', function (e) {
                if (e.target === checkoutModal) {
                    checkoutModal.style.display = 'none';
                }
            });
        }

        // Cart close button
        const cartCloseBtn = document.getElementById('cart-close-btn');
        if (cartCloseBtn) {
            cartCloseBtn.addEventListener('click', function () {
                closeCart();
            });
        }

        cartIcon.addEventListener('click', function (e) {
            e.stopPropagation(); // Prevent closing immediately
            if (cartModal.style.display === 'block') {
                closeCart();
            } else {
                fetchCartContent();
            }
        });

        // Close when clicking outside or on overlay
        document.addEventListener('click', function (e) {
            if (!cartModal.contains(e.target) && !cartIcon.contains(e.target)) {
                closeCart();
            }
        });

        if (cartOverlay) {
            cartOverlay.addEventListener('click', function () {
                closeCart();
            });
        }

        function closeCart() {
            cartModal.style.display = 'none';
            if (cartOverlay) cartOverlay.style.display = 'none';
        }

        function fetchCartContent() {
            fetch("{{ route('cart.content') }}")
                .then(response => response.json())
                .then(data => {
                    renderCart(data);
                    cartModal.style.display = 'block';
                    if (cartOverlay) cartOverlay.style.display = 'block';
                })
                .catch(error => console.error('Error fetching cart:', error));
        }

        function renderCart(data) {
            cartItemsContainer.innerHTML = '';
            // Update counts in modal
            modalTotalCount.innerText = data.totalCount;
            modalSubtotal.innerText = '$ ' + data.totalPrice.toFixed(2);

            // Update badge count
            const badge = document.getElementById('cart-count-badge');
            if (badge) {
                badge.innerText = data.totalCount;
                badge.style.display = data.totalCount > 0 ? 'inline-block' : 'none';
            }

            const cart = data.cart;
            const cartFooter = document.getElementById('cart-footer');

            if (Object.keys(cart).length === 0) {
                cartItemsContainer.innerHTML = '<p class="text-center text-muted">Your cart is empty.</p>';
                if (cartFooter) cartFooter.style.display = 'none';
                return;
            }
            if (cartFooter) cartFooter.style.display = 'block';

            // Define static variables for checkout
            const shippingCost = 3.00;
            const taxCost = 2.00;
            let checkoutItemsHtml = '';

            for (const id in cart) {
                const item = cart[id];
                const itemHtml = `
                    <div class="cart-item d-flex align-items-center mt-4 position-relative">
                        <div class="cart-img-box">
                            <img src="{{ asset('images/') }}/${item.image}" alt="${item.name}" />
                        </div>
                        <div class="cart-info ms-3 flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <h5>${item.name}</h5>
                                <button class="btn-remove" onclick="removeCartItem(${id})">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                            <p>Medium Roast</p>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div class="qty-box d-flex align-items-center">
                                    <button onclick="updateCartItem(${id}, ${item.quantity} - 1)">-</button>
                                    <span>${item.quantity}</span>
                                    <button onclick="updateCartItem(${id}, ${item.quantity} + 1)">+</button>
                                </div>
                                <div class="cart-price">$ ${Number(item.price).toFixed(2)}</div>
                            </div>
                        </div>
                    </div>
                `;
                cartItemsContainer.insertAdjacentHTML('beforeend', itemHtml);

                // Build HTML for Checkout Modal
                const itemTotal = Number(item.price) * item.quantity;
                checkoutItemsHtml += `
                    <div class="order-product d-flex align-items-center mb-3">
                        <div class="order-img">
                            <img src="{{ asset('images/') }}/${item.image}" alt="${item.name}" />
                        </div>
                        <div class="ms-3 flex-grow-1">
                            <h6 class="mb-0 fw-bold">${item.name}</h6>
                            <p class="small mb-0">Qty: ${item.quantity}</p>
                        </div>
                        <div class="fw-bold">$ ${itemTotal.toFixed(2)}</div>
                    </div>
                `;
            }

            // Update Checkout Modal Elements if they exist
            const checkoutContainer = document.getElementById('checkout-items-container');
            const checkoutSubtotal = document.getElementById('checkout-subtotal');
            const checkoutShipping = document.getElementById('checkout-shipping');
            const checkoutTax = document.getElementById('checkout-tax');
            const checkoutTotal = document.getElementById('checkout-total');

            if (checkoutContainer) {
                checkoutContainer.innerHTML = checkoutItemsHtml;

                if (Object.keys(cart).length === 0) {
                    checkoutContainer.innerHTML = '<p class="text-center text-muted">Your cart is empty.</p>';
                }

                const subTotalVal = data.totalPrice;
                const totalVal = subTotalVal + shippingCost + taxCost;

                if (checkoutSubtotal) checkoutSubtotal.innerText = '$ ' + subTotalVal.toFixed(2);
                if (checkoutShipping) checkoutShipping.innerText = '$ ' + shippingCost.toFixed(2);
                if (checkoutTax) checkoutTax.innerText = '$ ' + taxCost.toFixed(2);
                if (checkoutTotal) checkoutTotal.innerText = '$ ' + totalVal.toFixed(2);
            }
        }

        window.updateCartItem = function (id, newQuantity) {
            if (newQuantity < 1) return; // Or handle remove if 0

            fetch("{{ route('cart.update') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ id: id, quantity: newQuantity })
            })
                .then(res => res.json())
                .then(data => renderCart(data))
                .catch(err => console.error(err));
        }

        window.removeCartItem = function (id) {
            fetch("{{ route('cart.remove') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ id: id })
            })
                .then(res => res.json())
                .then(data => renderCart(data))
                .catch(err => console.error(err));
        }
    });
</script>