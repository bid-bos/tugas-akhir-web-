<?= $this->extend('templates/menu') ?>

<?= $this->section('content') ?>
<button class="btn btn-warning" id="addButton" onclick="window.location='<?= site_url('user') ?>'"><i class="fa fa-backward"></i></button>
<br> <br>
<div class="card-body">
    <?= form_open_multipart('', ['id' => 'formsaveuser']) ?>
    <div class="card-body">
        <h4 class="card-title">Add Admin</h4>
        <form class="forms-sample">
            <div class="form-group">
                <label for="Username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="Password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <button type="button" id="togglePassword" style="position: absolute; right: 10px; top: 15px; background: none; border: none;">
                    <i class="fa fa-eye-slash" id="toggleIcon"></i>
                </button>
                <div id="errorPassword" style="display: none;" class="invalid-feedback"></div>
                <div class="valid-feedback" style="display: none;"></div>
            </div>
            <div class="form-group">
                <label for="password_confirm">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Password">
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Role</label>
                        <div class="col-sm-4">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="level_user" id="Admin" value="admin"> Admin <i class="input-helper"></i></label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="level_user" id="User" value="user"> User <i class="input-helper"></i></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" id="saveuser" class="btn btn-primary me-2">Submit</button>
            <a href="<?= base_url('user') ?>" class="btn btn-light">Cancel</a>
        </form>
    </div>
    <?= form_close() ?>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#saveuser').click(function(e) {
        e.preventDefault();

        let form = $('#formsaveuser')[0];

        let data = new FormData(form);

        $.ajax({
            type: "post",
            url: "<?= site_url('user/add') ?>",
            data: data,
            dataType: "json",
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $('#saveuser').prop('disabled', true)
                $('#saveuser').html('<i class="fa fa-spin fa-spinner"></i>')
            },
            complete: function() {
                $('#saveuser').prop('disabled', false)
                $('#saveuser').html('Save')
            },
            success: function(response) {
                if (response.error) {
                    let dataError = response.error;
                    if (dataError.errorUserName) {
                        $('#errorUserName').html(dataError.errorUserName).show();
                        $('#username').addClass('is-invalid');
                    } else {
                        $('#errorUserName').fadeOut();
                        $('#username').removeClass('is-invalid').addClass('is-valid');
                    }
                    if (dataError.errorEmail) {
                        $('#errorEmail').html(dataError.errorEmail).show();
                        $('#email').addClass('is-invalid');
                    } else {
                        $('#errorEmail').fadeOut();
                        $('#email').removeClass('is-invalid').addClass('is-valid');
                    }
                    if (dataError.errorPassword) {
                        $('#errorPassword').html(dataError.errorPassword).show();
                        $('#password').addClass('is-invalid');
                    } else {
                        $('#errorPassword').fadeOut();
                        $('#password').removeClass('is-invalid').addClass('is-valid');
                    }
                    if (dataError.errorPasswordConfirm) {
                        $('#errorPasswordConfirm').html(dataError.errorPasswordConfirm).show();
                        $('#password_confirm').addClass('is-invalid');
                    } else {
                        $('#errorPasswordConfirm').fadeOut();
                        $('#password_confirm').removeClass('is-invalid').addClass('is-valid');
                    }
                    if (dataError.errorLevel) {
                        $('#errorLevel').html(dataError.errorLevel).show();
                        $('#level_user').addClass('is-invalid');
                    } else {
                        $('#errorLevel').fadeOut();
                        $('#level_user').removeClass('is-invalid').addClass('is-valid');
                    }
                } else {
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        html: response.success
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });

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

    // Pengecekan elemen toggleConfirmPassword sebelum menambahkan event listener
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    if (toggleConfirmPassword) {
        toggleConfirmPassword.addEventListener('click', function() {
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
    }
</script>
<?= $this->endSection() ?>