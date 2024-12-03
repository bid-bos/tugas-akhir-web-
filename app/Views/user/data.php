<?= $this->extend('templates/menu') ?>

<?= $this->section('content') ?>


<div class="statistics-details d-flex align-items-center justify-content-between">
    <!-- Menampilkan total user -->
    <div>
        <p class="statistics-title">User</p>
        <h3 class="rate-percentage" id="total-user"><?= $total_user ?></h3>
    </div>

    <div>
        <p class="statistics-title">Page Views</p>
        <h3 class="rate-percentage" id="total_page_views"><?= $totalPageViews ?? 0 ?></h3>
    </div>


    <div>
        <p class="statistics-title">Categories</p>
        <h3 class="rate-percentage">68.8</h3>
        <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p>
    </div>
</div>

<button class="btn btn-success" id="addButton" onclick="window.location='<?= site_url('user/add') ?>'">Add Admin</button>

<!-- tabel user -->
<div class="card-body">
    <div class="table-responsive pt-3">
        <table class="table table-bordered" style="width: 100%;">
            <thead>
                <tr>
                    <th colspan="1"> no </th>
                    <th colspan="4"> name </th>
                    <th colspan="4"> Email </th>
                    <th colspan="2"> Role </th>
                    <th colspan="2"> Action </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $num = 1;
                foreach ($data_user as $row):
                ?>
                    <tr>
                        <td colspan="1"><?= $num++ ?></td>
                        <td colspan="4"><?= $row['username'] ?></td>
                        <td colspan="4"><?= $row['email'] ?></td>
                        <td colspan="2"><?= $row['level_user'] ?></td>
                        <td colspan="2">
                            <button
                                type="button"
                                class="btn btn-success btn-rounded btn-icon edit-user-btn"
                                data-id="<?= $row['id']; ?>"
                                title="Edit User">
                                <i class="fa fa-user-pen"></i>
                            </button>
                            <button
                                type="button"
                                class="btn btn-danger btn-rounded btn-icon delete-user-btn"
                                data-id="<?= $row['id']; ?>"
                                title="Delete User">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="modal fade" id="modalFormEdit" tabindex="-1" role="dialog" aria-labelledby="modalFormEditLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalFormEditLabel">Edit User</h5>
                    </div>
                    <form id="formEditUser">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="editId">
                            <div class="form-group">
                                <label for="editUsername">Username</label>
                                <input type="text" name="username" class="form-control" id="editUsername" required>
                            </div>
                            <div class="form-group">
                                <label for="editEmail">Email</label>
                                <input type="email" name="email" class="form-control" id="editEmail" required>
                            </div>
                            <div class="form-group">
                                <label for="editPassword">Password</label>
                                <input type="password" name="password" class="form-control" id="editPassword" placeholder="Leave blank to keep current password">
                            </div>
                            <div class="form-group">
                                <label for="editRole">Role</label>
                                <select name="role" id="editRole" class="form-control" required>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="saveEditButton">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Tambahkan JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function fetchTotalUsers() {
        $.ajax({
            url: "<?= site_url('user/getTotalUsers') ?>",
            method: "GET",
            dataType: "json",
            success: function(data) {
                if (data.total_user !== undefined) {
                    $('#total-user').text(data.total_user);
                } else {
                    console.error("Respons data tidak valid:", data);
                }
            },
            error: function(xhr, status, error) {
                console.error("Gagal memuat data total user:", status, error);
            }
        });
    }
    setInterval(fetchTotalUsers, 10000);

    fetchTotalUsers();
</script>

<!-- real time update view -->
<script>
    // Fungsi untuk mengambil jumlah total page views
    function fetchPageViews() {
        const url = `<?= base_url('analytics/getPageViews') ?>`; // Endpoint sesuai controller
        fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.total_page_views !== undefined) {
                    // Perbarui elemen dengan ID #total_page_views
                    document.querySelector('#total_page_views').textContent = data.total_page_views;
                } else if (data.error) {
                    console.error('Error fetching page views:', data.message);
                }
            })
            .catch(error => console.error('Error fetching page views:', error));
    }

    // Fungsi untuk menambah jumlah page views
    function incrementPageView() {
        const url = `<?= base_url('analytics/incrementPageView') ?>`; // Endpoint sesuai controller
        fetch(url, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    fetchPageViews(); // Perbarui tampilan page views setelah increment
                } else if (data.error) {
                    console.error('Error incrementing page view:', data.message);
                }
            })
            .catch(error => console.error('Error incrementing page view:', error));
    }

    // Fungsi untuk memuat data awal page views saat halaman dimuat
    document.addEventListener('DOMContentLoaded', () => {
        incrementPageView(); // Tambahkan page view ketika halaman dimuat
        fetchPageViews(); // Ambil total page views awal untuk ditampilkan
    });

    $(document).on('click', '.delete-user-btn', function() {
        var userId = $(this).data('id'); // Ambil ID user dari data-id tombol

        // Konfirmasi SweetAlert
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // AJAX request ke server
                $.ajax({
                    url: "<?= base_url('user/delete'); ?>/" + userId,
                    type: 'DELETE',
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            response.message,
                            'success'
                        ).then(() => {
                            location.reload(); // Reload halaman setelah penghapusan
                        });
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Failed!',
                            xhr.responseJSON.message,
                            'error'
                        );
                    }
                });
            }
        });
    });

    $(document).ready(function() {
        // Ketika tombol edit ditekan
        $('.edit-user-btn').on('click', function() {
            const id = $(this).data('id');

            // Ambil data user berdasarkan ID dengan AJAX
            $.ajax({
                type: "GET",
                url: `/user/edit/${id}`,
                dataType: "json",
                success: function(response) {
                    if (response) {
                        // Isi data di modal
                        $('#editId').val(response.id);
                        $('#editUsername').val(response.username);
                        $('#editEmail').val(response.email);
                        $('#editPassword').val(''); // Kosongkan field password
                        $('#editRole').val(response.level_user);

                        // Tampilkan modal
                        $('#modalFormEdit').modal('show');
                    }
                },
                error: function(xhr, status, error) {
                    alert(xhr.status + ": " + xhr.responseText);
                }
            });
        });

        // Submit form edit user
        $('#formEditUser').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: '/user/update',
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('#saveEditButton').prop('disabled', true);
                    $('#saveEditButton').html('<i class="fa fa-spin fa-spinner"></i> Saving...');
                },
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            title: "Success!",
                            text: response.message,
                            icon: "success"
                        }).then(() => {
                            $('#modalFormEdit').modal('hide');
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: response.message,
                            icon: "error"
                        });
                    }
                },
                error: function(xhr, status, error) {
                    alert(xhr.status + ": " + xhr.responseText);
                },
                complete: function() {
                    $('#saveEditButton').prop('disabled', false);
                    $('#saveEditButton').html('Save Changes');
                }
            });
        });
    });
</script>
<script src="<?= base_url('assets') ?>/js/chart.js"></script>
<?= $this->endSection() ?>