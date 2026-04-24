<footer class="text-warning py-5 position-relative" style="background-color: #0c2e81; border-top: 5px solid #6cc0b8;">
    <div class="container d-flex flex-column align-items-center text-center custom-container">
        <!-- Logo / Name -->
        <a class="navbar-brand mb-4" href="{{ route('home') }}">
            <img src="{{ asset('images/logo-2.png') }}" class="logo footer-logo" alt="logo"
                style="height: 60px; transition: transform 0.3s ease;" />
        </a>



        <!-- Social Links -->
        <div class="footer-social d-flex flex-column align-items-center mb-4">
            <span class="mb-3 fw-bold" style="letter-spacing: 2px; text-transform: uppercase; font-size: 14px;">Follow
                Us</span>
            <div class="d-flex gap-4">
                <a href="#" class="text-warning social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-warning social-icon"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-warning social-icon"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-warning social-icon"><i class="fab fa-youtube"></i></a>
            </div>
        </div>

        <!-- Links and Copyright -->
        <div class="mt-3 d-flex flex-column flex-md-row gap-3 justify-content-center align-items-center small"
            style="opacity: 0.75; font-size: 14px;">
            <span>&copy; {{ date('Y') }} Nupi. All rights reserved.</span>
            <span class="d-none d-md-inline px-2">|</span>
            <a href="{{ route('privacy.policy') }}" class="text-warning text-decoration-none footer-link">Privacy
                Policy</a>
        </div>
    </div>
</footer>