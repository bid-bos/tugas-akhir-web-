<?= $this->extend('templates/menu') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
<div class="statistics-details d-flex align-items-center justify-content-between">
    <!-- Menampilkan total user -->
    <div>
        <p class="statistics-title">User</p>
        <h3 class="rate-percentage" id="total-user"><?= $total_user ?></h3>
    </div>

    <!-- Contoh tambahan statistik lainnya -->
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
<!-- tabel user -->
<div class="card-body">
    <div class="table-responsive pt-3">
        <table class="table table-bordered" style="width: 100%;">
            <thead>
                <tr>
                    <th colspan="1"> no </th>
                    <th colspan="4"> name </th>
                    <th colspan="5"> Email </th>
                    <th colspan="2"> Action </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="1"> 1 </td>
                    <td colspan="4"> Herman Beck </td>
                    <td colspan="5">raya@gmail.com</td>
                    <td colspan="2"> 
                        <button type="button" class="btn btn-success btn-rounded btn-icon">
                        <i class="fa fa-user-pen"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-rounded btn-icon">
                        <i class="fa fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- user cart -->
<div class="card-body">
    <h4 class="card-title"></h4>
    <canvas id="barChart" width="369" height="184" style="display: block; box-sizing: border-box; height: 147px; width: 295px;"></canvas>
</div>

<!-- Tambahkan JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function fetchTotalUsers() {
        $.ajax({
            url: "<?= site_url('User/getTotalUsers') ?>",
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
</script>
<?= $this->endSection() ?>