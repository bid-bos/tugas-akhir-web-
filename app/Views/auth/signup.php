<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin2 </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url('assets') ?>/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="<?= base_url('assets') ?>/images/logo.svg" alt="logo">
                            </div>
                            <h4>New here?</h4>
                            <h6 class="fw-light">Signing up is easy. It only takes a few steps</h6>
                            <?= form_open('', ['id' => 'form-signup']) ?>
                            <div class="form-group" style="height: 70px;">
                                <input type="text" class="form-control form-control-lg" name="username" id="username" placeholder="Username">
                                <div id="errorUsername" style="display: none;" class="invalid-feedback">
                                </div>
                                <div class="valid-feedback" style="display: none;">
                                </div>
                            </div>
                            <div class="form-group" style="height: 70px;">
                                <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Email">
                                <div id="errorEmail" style="display: none;" class="invalid-feedback">
                                </div>
                                <div class="valid-feedback" style="display: none;">
                                </div>
                            </div>
                            <div class="form-group" style="height: 70px; position: relative;">
                                <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Password">
                                <button type="button" id="togglePassword" style="position: absolute; right: 10px; top: 15px; background: none; border: none;">
                                    <i class="fa fa-eye-slash" id="toggleIcon"></i>
                                </button>
                                <div id="errorPassword" style="display: none;" class="invalid-feedback"></div>
                                <div class="valid-feedback" style="display: none;"></div>
                            </div>
                            <div class="form-group" style="height: 70px; position: relative;">
                                <input type="password" class="form-control form-control-lg" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                                <button type="button" id="toggleConfirmPassword" style="position: absolute; right: 10px; top: 15px; background: none; border: none;">
                                    <i class="fa fa-eye-slash" id="toggleConfirmIcon"></i>
                                </button>
                                <div id="errorConfirmPassword" style="display: none;" class="invalid-feedback"></div>
                                <div class="valid-feedback" style="display: none;"></div>
                            </div>
                            <div class="mt-3 d-grid gap-2">
                                <button type="submit" id="btnSignup" class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn">SIGN UP</button>
                            </div>
                            <div class="text-center mt-4 fw-light"> Already have an account? <a href="<?= base_url('login') ?>" class="text-primary">Login</a>
                            </div>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= base_url('assets') ?>/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?= base_url('assets') ?>/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url('assets') ?>/js/off-canvas.js"></script>
    <script src="<?= base_url('assets') ?>/js/template.js"></script>
    <script src="<?= base_url('assets') ?>/js/settings.js"></script>
    <script src="<?= base_url('assets') ?>/js/hoverable-collapse.js"></script>
    <script src="<?= base_url('assets') ?>/js/todolist.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- endinject -->

    <script>
        $('#btnSignup').click(function(e) {
            e.preventDefault();

            let form = $('#form-signup')[0];
            let data = new FormData(form);

            $.ajax({
                type: "post",
                url: "<?= site_url('register') ?>",
                data: data,
                dataType: "json",
                encType: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function() {
                    $('#btnSignup').prop('disabled', true)
                    $('#btnSignup').html('<i class="fa fa-spin fa-spinner"></i>')
                },
                complete: function() {
                    $('#btnSignup').prop('disabled', false)
                    $('#btnSignup').html('SIGN UP')
                },
                success: function(response) {
                    console.log(response);
                    if (response.error) {
                        let dataError = response.error;
                        if (dataError.errorUsername) {
                            $('#errorUsername').html(dataError.errorUsername).show();
                            $('#username').addClass('is-invalid').removeClass('is-valid');
                        } else {
                            $('#errorUsername').fadeOut();
                            $('#username').removeClass('is-invalid').addClass('is-valid');
                        }
                        if (dataError.errorEmail) {
                            $('#errorEmail').html(dataError.errorEmail).show();
                            $('#email').addClass('is-invalid').removeClass('is-valid');
                        } else {
                            $('#errorEmail').fadeOut();
                            $('#email').removeClass('is-invalid').addClass('is-valid');
                        }
                        if (dataError.errorPassword) {
                            $('#errorPassword').html(dataError.errorPassword).show();
                            $('#password').addClass('is-invalid').removeClass('is-valid');
                        } else {
                            $('#errorPassword').fadeOut();
                            $('#password').removeClass('is-invalid').addClass('is-valid');
                        }
                        if (dataError.errorConfirmPassword) {
                            $('#errorConfirmPassword').html(dataError.errorConfirmPassword).show();
                            $('#confirm_password').addClass('is-invalid').removeClass('is-valid');
                        } else {
                            $('#errorConfirmPassword').fadeOut();
                            $('#confirm_password').removeClass('is-invalid').addClass('is-valid');
                        }
                    } else {
                        Swal.fire({
                            icon: "success",
                            title: "Registration Success!",
                            html: response.success
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location='<?= base_url('login')?>';
                            }
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        })

        // Toggle Password Visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        });

        // Toggle Confirm Password Visibility
        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const confirmPasswordField = document.getElementById('confirm_password');
            const toggleConfirmIcon = document.getElementById('toggleConfirmIcon');
            if (confirmPasswordField.type === 'password') {
                confirmPasswordField.type = 'text';
                toggleConfirmIcon.classList.remove('fa-eye-slash');
                toggleConfirmIcon.classList.add('fa-eye');
            } else {
                confirmPasswordField.type = 'password';
                toggleConfirmIcon.classList.remove('fa-eye');
                toggleConfirmIcon.classList.add('fa-eye-slash');
            }
        });
    </script>
</body>

</html>