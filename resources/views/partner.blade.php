@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/partner.css') }}" />
@endsection

@section('content')
    <!-- PARTNER HEADER -->
    <section class="partner-header py-5">
        <div class="container">
            <div class="partner-card d-flex align-items-center justify-content-between flex-wrap">
                <!-- TEXT -->
                <div class="partner-text">
                    <h1 class="partner-title">Become a <br />Partner</h1>
                </div>

                <!-- IMAGE -->
                <div class="partner-image">
                    <img src="{{ asset('images/about1.png') }}" alt="Partner illustration" />
                </div>
            </div>
        </div>
    </section>

    <!-- PARTNER BENEFITS -->
    <section class="partner-benefits pb-5">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-6">
                    <img src="{{ asset('images/hand.png') }}" class="benefit-icon" />
                    <h5 class="benefit-title">Reach more customers</h5>
                    <p class="benefit-text">
                        We have a lot of customers in your area waiting to order from you
                    </p>
                </div>

                <div class="col-md-6">
                    <img src="{{ asset('images/money.png') }}" class="benefit-icon" />
                    <h5 class="benefit-title">Earn more money</h5>
                    <p class="benefit-text">
                        We'll help you serve more customers without adding more chairs to
                        you coffee shop and we'll make sure you get paid promptly
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- PARTNER FORM -->
    <section class="partner-form-section py-5">
        <div class="container partner-form">
            <h3 class="partner-form-title mb-5">
                Fill the Form below <br />
                <span>to Partner With Us</span>
            </h3>

            <div id="partner-success-msg" class="alert alert-success d-none mb-4"></div>
            <div id="partner-error-msg" class="alert alert-danger d-none mb-4"></div>

            <form id="partner-form">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="text" name="first_name" id="first_name" class="form-control partner-input"
                            placeholder="First Name" required />
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" name="last_name" id="last_name" class="form-control partner-input"
                            placeholder="Last Name" required />
                    </div>
                </div>

                <input type="text" name="brand_name" id="brand_name" class="form-control partner-input mb-3"
                    placeholder="Brand Name" required />
                <input type="text" name="business_type" id="business_type" class="form-control partner-input mb-3"
                    placeholder="Business Type" required />
                <input type="text" name="mobile_number" id="mobile_number" class="form-control partner-input mb-3"
                    placeholder="Mobile Number" required />
                <input type="email" name="brand_email" id="brand_email" class="form-control partner-input mb-3"
                    placeholder="Brand Email" required />
                <input type="text" name="role" id="role" class="form-control partner-input mb-3"
                    placeholder="Your role in your Business" required />
                <input type="text" name="branches" id="branches" class="form-control partner-input mb-4"
                    placeholder="Number of Branches" required />

                <button type="submit" id="partner-submit-btn" class="btn submit-btn">Submit Form</button>
            </form>
        </div>
    </section>

    <!-- Include jQuery and Validation Plugin if not globally available (though likely is) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function () {
            // Validation
            $('#partner-form').validate({
                rules: {
                    first_name: "required",
                    last_name: "required",
                    brand_name: "required",
                    business_type: "required",
                    mobile_number: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 15
                    },
                    brand_email: {
                        required: true,
                        email: true
                    },
                    role: "required",
                    branches: {
                        required: true,
                        digits: true // Assuming number of branches should be numeric
                    }
                },
                messages: {
                    first_name: "Please enter your first name",
                    last_name: "Please enter your last name",
                    brand_name: "Please enter your brand name",
                    business_type: "Please enter your business type",
                    mobile_number: {
                        required: "Please enter your mobile number",
                        digits: "Please enter only numbers",
                        minlength: "Mobile number should be at least 10 digits"
                    },
                    brand_email: "Please enter a valid email address",
                    role: "Please enter your role",
                    branches: "Please enter number of branches (numeric)"
                },
                errorElement: 'span',
                errorClass: 'text-danger small',
                highlight: function (element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function (form) {
                    // AJAX Submission
                    const submitBtn = $('#partner-submit-btn');
                    const originalBtnText = submitBtn.text();
                    submitBtn.prop('disabled', true).text('Submitting...');

                    $('#partner-success-msg').addClass('d-none');
                    $('#partner-error-msg').addClass('d-none');

                    const formData = new FormData(form);

                    fetch("{{ route('partner.store') }}", {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            // CSRF token is already handled if passed in body or headers correctly, 
                            // typically Laravel looks for _token in body or X-CSRF-TOKEN header.
                            // FormData automatically sets multipart/form-data content type boundary.
                            // But usually fetch needs manual header for CSRF if not in form.
                            // Since @csrf is in form, it's in formData.
                        },
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                $('#partner-form')[0].reset();
                                /* 
                                // Simple alert or custom message div
                                $('#partner-success-msg').text(data.message).removeClass('d-none');
                                */

                                // Or use SweetAlert if available
                                if (typeof Swal !== 'undefined') {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: data.message,
                                        icon: 'success',
                                        confirmButtonColor: '#0c2e81',
                                        confirmButtonText: 'OK'
                                    });
                                } else {
                                    alert(data.message);
                                }

                            } else {
                                if (data.errors) {
                                    let errorHtml = '<ul>';
                                    for (const key in data.errors) {
                                        errorHtml += `<li>${data.errors[key][0]}</li>`;
                                    }
                                    errorHtml += '</ul>';

                                    if (typeof Swal !== 'undefined') {
                                        Swal.fire({
                                            title: 'Error!',
                                            html: errorHtml,
                                            icon: 'error',
                                            confirmButtonText: 'OK'
                                        });
                                    } else {
                                        $('#partner-error-msg').html(errorHtml).removeClass('d-none');
                                    }
                                } else {
                                    if (typeof Swal !== 'undefined') {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: data.message || 'Something went wrong.',
                                            icon: 'error',
                                            confirmButtonText: 'OK'
                                        });
                                    } else {
                                        $('#partner-error-msg').text(data.message || 'Error occurred').removeClass('d-none');
                                    }
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            $('#partner-error-msg').text('An unexpected error occurred.').removeClass('d-none');
                        })
                        .finally(() => {
                            submitBtn.prop('disabled', false).text(originalBtnText);
                        });

                    return false; // blocks standard submit
                }
            });
        });
    </script>
@endsection