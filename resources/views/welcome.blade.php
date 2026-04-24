@extends('layouts.app')

@section('content')
    <!-- BANNER -->
    <section class="banner-section">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="banner-wrapper">
                        <!-- Banner Image -->
                        <img src="{{ asset('images/banner.png') }}" class="banner-img" alt="banner" />
                        <!-- Text Overlay -->
                        <div class="banner-content custom-container">
                            <h1>
                                Happiness is <br />
                                one cup away
                            </h1>
                            <p>
                                All your coffee and tea needs in <br />
                                one place
                            </p>
                            <a href="{{ route('product.detail') }}" class="order-btn">Order Now</a>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="banner-wrapper">
                        <!-- Banner Image -->
                        <img src="{{ asset('images/banner_1.png') }}" class="banner-img" alt="banner" />
                        <!-- Text Overlay -->
                        <div class="banner-content custom-container">
                            <!-- <h1>
                                        Freshly Roasted <br />
                                        Delivered to you
                                    </h1>
                                    <p>
                                        Experience the best quality <br />
                                        every single morning
                                    </p>
                                    <a href="{{ route('product.detail') }}" class="order-btn">Shop Collection</a> -->
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <div class="banner-wrapper">
                        <!-- Banner Image -->
                        <img src="{{ asset('images/banner_2.png') }}" class="banner-img" alt="banner" />
                        <!-- Text Overlay -->
                        <div class="banner-content custom-container">
                            <!-- <h1>
                                    Your Daily Fuel <br />
                                    Starts Here
                                </h1>
                                <p>
                                    Join our community and <br />
                                    never run out of coffee
                                </p>
                                <a href="{{ route('partner') }}" class="order-btn">Become a Partner</a> -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- ================= COFFEE PRODUCT SECTION ================= -->
    <section class="coffee-section">
        <div class="coffee-container">
            <!-- Left Image -->
            <div class="coffee-left">
                <img src="{{ asset('images/nupi-left.png') }}" alt="Coffee Bag" />
            </div>

            <!-- Right Image Absolute -->
            <div class="coffee-right-img">
                <img src="{{ asset('images/nupi-right.png') }}" alt="Right Shape" />
            </div>

            <!-- Text Absolute -->
            <div class="coffee-text">
                <h2>Nupi Coffee</h2>

                <p>
                    Freshly roasted, sealed <br />
                    with care -crafted to <br />
                    fuel your moments
                </p>

                <a href="#" class="order-btn">Order Now</a>
            </div>
        </div>
    </section>

    <!-- ================= MARKETPLACE SECTION ================= -->
    <section class="marketplace-section">
        <!-- Top Green Banner -->
        <div class="marketplace-top">
            <div class="marketplace-top-content">
                <!-- Cup Icon -->
                <img src="{{ asset('images/cup.png') }}" alt="Cup" class="cup-icon-1" />

                <!-- Text -->
                <div>
                    <h2>
                        FULL MARKETPLACE <br />
                        COMING SOON
                    </h2>
                    <p>All your coffee needs will be in one place :)</p>
                </div>
            </div>
        </div>

        <!-- Bottom Cards -->
        <div class="marketplace-cards">
            <!-- Card 1 -->
            <div class="market-card">
                <div class="d-flex gap-3">
                    <div class="card-icon">
                        <img src="{{ asset('images/setting.png') }}" alt="Setting" />
                    </div>

                    <div class="card-text flex-grow-1 card-text-custom">
                        <h3>Become a Partner</h3>
                        <p>
                            Join our network of coffee creators, cafes and brands to reach
                            thousands of young customers in Kuwait city.
                        </p>
                    </div>
                </div>

                <div class="card-btn">
                    <a href="{{ route('partner') }}">Find out more</a>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="market-card">
                <div class="d-flex gap-3 be">
                    <div class="card-icon">
                        <img src="{{ asset('images/info.png') }}" alt="Info" />
                    </div>

                    <div class="card-text flex-grow-1 card-text-custom">
                        <h3>About Us</h3>
                        <p>
                            Started in Kuwait City, we deliver fresh, quality coffee to
                            everyone—anytime, anywhere, from morning espresso to midnight
                            latte.
                        </p>
                    </div>
                </div>

                <div class="card-btn">
                    <a href="{{ route('about') }}">Find out more</a>
                </div>
            </div>
        </div>
    </section>
@endsection