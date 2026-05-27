<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- bootstrap 5.2  -->
    <link href="{{ URL::asset('dist/css/bootstrap.min.css') }}" rel="stylesheet" />
    <script src="{{ URL::asset('dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ URL::asset('/dist/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ URL::asset('/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ URL::asset('/dist/css/style.css') }}" rel="stylesheet">
    <!-- custom -->
    <link rel="stylesheet" href="{{ URL::asset('dist/css/custom.css') }}" />

    <link rel="shortcut icon" href="{{ URL::asset('assets/images/circlelogogeoitb.png') }}" type="image/x-icon" />
    <title>Geo Mechanics - ITB</title>
</head>

<!-- Modal Login -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <img src="{{ URL::asset('assets/images/logogeoitb.png') }}" alt="Logo" height="30px" />
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col text-center">
                    <h5 class="mb-5 mt-2" id="staticBackdropLabel">Login With Your Account</h5>
                    <input id="email" type="email" class="form-control mb-3" placeholder="Email" value="" />
                    <input id="password" type="password" class="form-control mb-3" placeholder="Password"
                        value="" />
                </div>
                <div class="col text-center">
                    <h6><strong> Not Registered Yet ?</strong> <a id="register_link" href="#" class="mt-4 fs-6">
                            Register Here</a></h6>
                    <a id="forgot_link" href="#">Forgot Password</a>
                </div>
            </div>
            <br>
            <button id="submit_login" type="button" class="btn button-primary mx-3 mb-5 py-2">Login</button>
        </div>
    </div>
</div>
<!-- End Modal Login -->

<!-- Modal Reset -->
<div class="modal fade" id="modal_reset" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <img src="{{ URL::asset('assets/images/logogeoitb.png') }}" alt="Logo" height="30px" />
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col text-center">
                    <h5 class="mb-5 mt-2" id="staticBackdropLabel">Reset Password</h5>
                    <input id="email_reset" type="email" class="form-control mb-3" placeholder="Email"
                        value="" />
                </div>
            </div>
            <button id="submit_reset" type="button" class="btn button-primary mx-3 mb-5 py-2">Send
                Email</button>
        </div>
    </div>
</div>
<!-- End Modal Reset -->

<!-- Modal Reset -->
<div class="modal fade" id="modal_register" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <img src="{{ URL::asset('assets/images/logogeoitb.png') }}" alt="Logo" height="30px" />
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col text-center">
                    <h5 class="mb-5 mt-2" id="staticBackdropLabel">Register Account</h5>
                    <div class="form-group">
                        <input id="name_register" type="text" class="form-control mb-3" placeholder="Your Name"
                            value="" />
                    </div>
                    <div class="form-group">
                        <span id="email_msg">Email already registered</span>
                        <input id="email_register" type="email" class="form-control mb-3" placeholder="Email"
                            value="" />
                    </div>
                    <div class="form-group">
                        <input id="password_register" type="password" class="form-control mb-3" placeholder="Password"
                            value="" />
                    </div>
                    <span id="password_msg"></span>
                    <div class="form-group">
                        <input id="confirm_password" type="password" class="form-control mb-3" placeholder="Confirm Password"
                            value="" />
                    </div>
                </div>
            </div>
            <button id="submit_register" type="button" class="btn button-primary mx-3 mb-5 py-2">Register</button>
        </div>
    </div>
</div>
<!-- End Modal Reset -->

@yield('navbar')
@yield('content')
@yield('footer')
@yield('globalscript')
@yield('page-js')
@yield('globaluser-js')
