@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}" />
@endsection

@section('content')
    <!-- ABOUT SECTION -->
    <section class="about-section py-5">
        <div class="container">
            <!-- Header -->
            <div class="text-center mb-5">
                <span class="about-badge px-4 py-2">About Us</span>
            </div>

            <!-- Row 1 -->
            <div class="row align-items-center mb-5">
                <div class="col-md-6">
                    <h3 class="about-title">Who we are</h3>
                    <p class="about-text">
                        Welcome to Nupi, a leading multi-vendor e-commerce platform
                        fostering Coffee and snack industry through secure, and
                        marketplace experience.
                    </p>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('images/about1.png') }}" class="img-fluid about-img" alt="about1" />
                </div>
            </div>

            <!-- Row 2 -->
            <div class="row align-items-center mb-5 flex-md-row-reverse">
                <div class="col-md-6">
                    <h3 class="about-title">Our Mission</h3>
                    <p class="about-text">
                        We connect buyers and sellers around the world, empowering them to
                        grow their businesses through powerful tools and curated
                        selections of premium coffee, wine, and snacks.
                    </p>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('images/about2.png') }}" class="img-fluid about-img" alt="about2" />
                </div>
            </div>

            <!-- Row 3 -->
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h3 class="about-title">Growing Everywhere</h3>
                    <p class="about-text">
                        Since 2020, we’ve been your trusted partner in the world of coffee
                        and beyond, beginning as a passionate coffee brand and growing to
                        offer premium snacks, accessories, and experiences that bring
                        people together.
                    </p>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('images/about3.png') }}" class="img-fluid about-img" alt="about3" />
                </div>
            </div>
        </div>
    </section>
@endsection