<footer class="text-warning py-3" style="background-color: #0c2e81">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center custom-container">
        <!-- Logo / Name -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo-2.png') }}" class="logo" alt="logo" />
        </a>

        <!-- Social Links -->
        <div class="footer-social d-flex flex-column align-items-start mt-2 mt-md-0">
            <span class="mb-2">Follow us on</span>
            <div class="d-flex gap-2">
                <a href="#" class="text-warning"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-warning"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-warning"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-warning"><i class="fab fa-youtube"></i></a>
            </div>

            <div class="mt-3 small">
                <a href="{{ route('privacy.policy') }}" class="text-warning text-decoration-none">Privacy Policy</a>
            </div>
        </div>
    </div>
</footer>