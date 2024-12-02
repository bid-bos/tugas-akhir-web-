<?= $this->extend('templates/menu') ?>

<?= $this->section('content') ?>
<div class="card-body">
</div>
<button class="btn btn-success" id="addButton" onclick="window.location='<?= site_url('categories/add') ?>'">Add Categories</button>
<br><br><br>
<div class="card-body">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Category Id</th>
                    <th>Category Name</th>
                    <th>Icon</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>01</td>
                    <td>food</td>
                    <td>-- icon --</td>
                    <td>icon food</td>
                    </td>
                    <td> <button type="button" class="btn btn-success btn-rounded btn-icon">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-rounded btn-icon">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    
</script>
<?= $this->endSection() ?>