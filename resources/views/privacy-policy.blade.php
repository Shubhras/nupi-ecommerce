@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/privatepolicy.css') }}" />
@endsection

@section('content')
    <section class="privacy-policy-section py-5">
        <div class="container">
            <h2 class="privacy-title mb-4 text-center orange-text">Privacy Policy</h2>

            <p class="privacy-text">
                Welcome to Nupi. This Privacy Policy describes how we collect, use,
                and protect information when you visit or interact with our website.
            </p>

            <div class="policy-block">
                <h5>1. Information We Collect</h5>

                <p class="fw-bold mb-2 orange-text">a. Personal Information</p>
                <p class="privacy-text">
                    We only collect personal information when you voluntarily provide it
                    — for example, by filling out a contact form, signing up for a
                    newsletter, or sending us an inquiry. This may include:
                </p>
                <ul class="privacy-list">
                    <li>Name</li>
                    <li>Email address</li>
                    <li>Phone number (optional)</li>
                </ul>

                <p class="fw-bold mt-3 mb-2 orange-text">b. Non-Personal Information</p>
                <p class="privacy-text">
                    We may collect non-identifying information automatically, such as:
                </p>
                <ul class="privacy-list">
                    <li>Browser type and version</li>
                    <li>Device type</li>
                    <li>Pages visited and time spent on the site</li>
                    <li>General location data (not precise)</li>
                </ul>
            </div>

            <div class="policy-block">
                <h5>2. How We Use Your Information</h5>
                <ul class="privacy-list">
                    <li>Improve and personalize your experience on our website</li>
                    <li>Respond to your messages or inquiries</li>
                    <li>
                        Send optional updates, offers, or promotions (if you have
                        subscribed)
                    </li>
                    <li>Analyze website usage to enhance design and functionality</li>
                </ul>
                <p class="privacy-text">
                    We do not sell or rent your personal information to anyone.
                </p>
            </div>

            <div class="policy-block">
                <h5>3. Cookies</h5>
                <p class="privacy-text">
                    Our website may use cookies to improve functionality and analyze
                    traffic. You can disable cookies in your browser settings, but some
                    features may not work properly.
                </p>
            </div>

            <div class="policy-block">
                <h5>4. Third-Party Services</h5>
                <p class="privacy-text">
                    We may use third-party tools such as Google Analytics or social
                    media plugins. These services may collect limited information as per
                    their privacy policies.
                </p>
            </div>

            <div class="policy-block">
                <h5>5. Data Protection</h5>
                <p class="privacy-text">
                    We take reasonable steps to protect your information. However, this
                    is a demo website, and complete security cannot be guaranteed.
                </p>
            </div>

            <div class="policy-block">
                <h5>6. Links to Other Websites</h5>
                <p class="privacy-text">
                    We may link to third-party websites. We are not responsible for
                    their privacy practices or content.
                </p>
            </div>

            <div class="policy-block">
                <h5>7. Your Rights</h5>
                <ul class="privacy-list">
                    <li>Request a copy of your personal data</li>
                    <li>Request correction or deletion</li>
                    <li>Withdraw consent for communications</li>
                </ul>
            </div>

            <div class="policy-block">
                <h5>8. Updates to This Policy</h5>
                <p class="privacy-text">
                    We may update this Privacy Policy from time to time. The latest
                    version will always be available on this page.
                </p>
            </div>

            <div class="policy-block">
                <h5>9. Contact Us</h5>
                <p class="privacy-text mb-1">📧 contact@coffeecornerdemo.com</p>
                <p class="privacy-text">☕ Coffee Corner – Demo Website</p>
            </div>
        </div>
    </section>
@endsection