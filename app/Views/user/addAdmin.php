<?= $this->extend('templates/menu') ?>

<?= $this->section('content') ?>

<div class="card-body">

</div>
<button class="btn btn-warning" id="addButton" onclick="window.location='<?= site_url('User') ?>'"><i class="fa fa-backward"></i></button>
<br> <br>
<div class="card-body">
    <div class="table-responsive pt-3">
        <table class="table table-bordered" style="width: 100%;">
            <thead>
                <tr>
                    <th colspan="1"> No </th>
                    <th colspan="4"> Name </th>
                    <th colspan="4"> Email </th>
                    <th colspan="3"> Role </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="1"> 1 </td>
                    <td colspan="4"> Herman Beck </td>
                    <td colspan="4">raya@gmail.com</td>
                    <td colspan="3">
                        <select class="form-select" id="" name="">
                            <option selected>User</option>
                            <option value="0">User</option>
                            <option value="1">Admin</option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary me-2 mt-4">Submit</button>
        <button class="btn btn-light mt-4">Cancel</button>
    </div>
</div>

<script>

</script>
<?= $this->endSection() ?>