<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>PNRD HRMS, Assam</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <!-- End Logo -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="d-flex justify-content-center py-2">
                                                <a href="index.html">
                                                    <img src="{{ asset('assets/img/logo.png') }}"
                                                        style="background-color: rgb(10, 10, 129)" max-width="80px"
                                                        height="110px" alt="">
                                                </a>
                                            </div>
                                            <div class="pt-1 pb-1">
                                                <h6 class="card-title text-center pb-0 fs-4">Panchayat & Rural
                                                    Development</h5>
                                                    <p class="text-center small" style="font-size: 15px">Department,
                                                        Assam</p>
                                                    <p class="text-center small" style="font-size: 26px">HRMS</p>
                                            </div>
                                            <form action="{{ route('post-login') }}" method="POST" id="login_form"
                                                class="row g-3 needs-validation" novalidate>
                                                {{ csrf_field() }}
                                                <div class="col-12">
                                                    <label for="username" class="form-label">Username</label>
                                                    <div class="input-group has-validation">
                                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                        <input type="text" value="{{ old('username') }}"
                                                            name="username" class="form-control" id="username"
                                                            required>
                                                        <div class="invalid-feedback">Please enter your username.</div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" name="password" class="form-control"
                                                        id="password" required>
                                                    <div class="invalid-feedback">Please enter your password!</div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="remember"
                                                            value="true" id="rememberMe">
                                                        <label class="form-check-label" for="rememberMe">Remember
                                                            me</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button class="btn btn-secondary rounded-pill w-100"
                                                        type="submit">Login</button>
                                                </div>
                                                {{-- <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="pages-register.html">Create an account</a></p>
                    </div> --}}
                                            </form>

                                        </div>
                                    </div>

                                    <div class="credits">
                                        <!-- All the links in the footer should remain intact. -->
                                        <!-- You can delete the links only if you purchased the pro version. -->
                                        <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                                        Designed by <a href="https://bootstrapmade.com/">&nbsp;Gratia Technology.</a>
                                    </div>

                                </div>
                            </div>
                        </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $(document).on("submit", "#login_form", function() {
                var e = this;
                $(this).find("[type='submit']").html("Login...");
                $.ajax({
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $(e).find("[type='submit']").html("Login");
                        if (data.status) {
                            var message = data.message;
                            alert(message);
                            window.location.href = data.redirect;
                        } else {
                            $(".alert").remove();
                            $.each(data.errors, function(key, val) {
                                alert(errors);
                                $("#errors-list").append(
                                    "<div class='alert alert-danger'>" + val +
                                    "</div>");
                            });
                        }
                    }
                });
                return false;
            });
        });
    </script>
</body>

</html>
