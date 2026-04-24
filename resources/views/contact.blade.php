@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}" />
@endsection

@section('content')
    <!-- CONTACT HEADER -->
    <section class="contact-header py-5">
        <div class="container">
            <div class="contact-card d-flex align-items-center justify-content-between flex-wrap">
                <!-- TEXT -->
                <div class="contact-text">
                    <h1 class="contact-title">Contact Us</h1>
                    <p class="contact-subtitle">
                        whether you have a question, partnership<br />
                        idea, or feedback - our team<br />
                        is here to connect
                    </p>
                </div>

                <!-- IMAGE -->
                <div class="contact-image">
                    <img src="{{ asset('images/contact-us.png') }}" alt="Contact illustration" />
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT FORM SECTION -->
    <section class="contact-body py-5">
        <div class="container contact-form">
            <!-- TITLE -->
            <h3 class="contact-form-title mb-4">Send Us a Message</h3>

            <div id="contact-success-msg" class="alert alert-success d-none mb-4"></div>
            <div id="contact-error-msg" class="alert alert-danger d-none mb-4"></div>

            <!-- FORM -->
            <form id="contact-form" class="mb-5">
                @csrf
                <!-- NAME + EMAIL -->
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <input type="text" name="name" id="name" class="form-control custom-input" placeholder="Name"
                            required />
                    </div>

                    <div class="col-md-6">
                        <input type="email" name="email" id="email" class="form-control custom-input" placeholder="Email"
                            required />
                    </div>
                </div>

                <!-- SUBJECT -->
                <div class="mb-3">
                    <input type="text" name="subject" id="subject" class="form-control custom-input" placeholder="Subject"
                        required />
                </div>

                <!-- MESSAGE -->
                <div class="mb-3">
                    <textarea name="message" id="message" class="form-control custom-input message-box"
                        placeholder="Your Message" required></textarea>
                </div>

                <!-- BUTTON + SOCIAL -->
                <div class="d-flex justify-content-end align-items-center gap-3 flex-wrap">

                    <button type="submit" id="contact-submit-btn" class="btn send-btn">Send Message</button>
                </div>
            </form>
            <div class="row mt-5">
                <!-- CONTACT INFO -->
                <div class="col-lg-7">
                    <h3 class="contact-info-title mb-4">Reach us directly at</h3>

                    <ul class="list-unstyled contact-info mb-4">
                        <li class="d-flex align-items-center mb-4">
                            <i class="fa-solid fa-envelope fa-2x"></i>
                            <span class="ms-3 contact-text-item">Hello@nupi.com</span>
                        </li>
                        <li class="d-flex align-items-center mb-4">
                            <i class="fa-solid fa-phone fa-flip-horizontal fa-2x"></i>
                            <span class="ms-3 contact-text-item">+1(800)555-Nupi</span>
                        </li>
                        <li class="d-flex align-items-center mb-4">
                            <i class="fa-solid fa-location-dot fa-2x"></i>
                            <span class="ms-3 contact-text-item">abcdefg-hijklmn, Kuwait</span>
                        </li>
                    </ul>

                    <a href="{{ route('partner') }}" class="btn partner-btn mt-2">Become a Partner</a>
                </div>

                <!-- MAP & SOCIAL -->
                <div class="col-lg-5 mt-4 mt-lg-0 d-flex flex-column align-items-end">
                    <!-- Social Icons -->
                    <div class="social-icons mb-3">
                        <a href="#"><i class="fab fa-facebook-square"></i></a>
                        <a href="#"><i class="fab fa-instagram-square"></i></a>
                        <a href="#"><i class="fab fa-twitter-square"></i></a>
                        <a href="#"><i class="fab fa-youtube-square"></i></a>
                    </div>

                    <!-- Map -->
                    <div class="map-box">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d111096.08866162157!2d47.90096238612142!3d29.358252277123985!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3fcf84ba033285c5%3A0x6a053086eb142b6!2sKuwait%20City%2C%20Kuwait!5e0!3m2!1sen!2s!4v1709210000000!5m2!1sen!2s"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Include jQuery and Validation Plugin if not globally available -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function () {
            // Validation
            $('#contact-form').validate({
                rules: {
                    name: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    subject: "required",
                    message: "required"
                },
                messages: {
                    name: "Please enter your name",
                    email: "Please enter a valid email address",
                    subject: "Please enter a subject",
                    message: "Please enter your message"
                },
                errorElement: 'span',
                errorClass: 'text-danger small mt-1 d-block',
                highlight: function (element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function (form) {
                    // AJAX Submission
                    const submitBtn = $('#contact-submit-btn');
                    const originalBtnText = submitBtn.text();
                    submitBtn.prop('disabled', true).text('Sending...');

                    $('#contact-success-msg').addClass('d-none');
                    $('#contact-error-msg').addClass('d-none');

                    const formData = new FormData(form);

                    fetch("{{ route('contact.store') }}", {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                        },
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                $('#contact-form')[0].reset();

                                // Use SweetAlert if available
                                if (typeof Swal !== 'undefined') {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: data.message,
                                        icon: 'success',
                                        confirmButtonColor: '#0c2e81',
                                        confirmButtonText: 'OK'
                                    });
                                } else {
                                    $('#contact-success-msg').text(data.message).removeClass('d-none');
                                    // Scroll to message
                                    $('html, body').animate({
                                        scrollTop: $("#contact-success-msg").offset().top - 100
                                    }, 500);
                                }

                            } else {
                                if (typeof Swal !== 'undefined') {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: data.message || 'Error occurred',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                } else {
                                    $('#contact-error-msg').text(data.message || 'Error occurred').removeClass('d-none');
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            $('#contact-error-msg').text('An unexpected error occurred.').removeClass('d-none');
                        })
                        .finally(() => {
                            submitBtn.prop('disabled', false).text(originalBtnText);
                        });

                    return false; // blocks standard submit
                }
            });
        });
    </script>

    <!-- BOTTOM CONTENT -->

    </div>
    </section>
@endsection