<?= $this->extend('templates/menu') ?>

<?= $this->section('content') ?>

<div class="card-body">

</div>
<button class="btn btn-warning" id="addButton" onclick="window.location='<?= site_url('categories') ?>'"><i class="fa fa-backward"></i></button>
<br> <br>
<div class="card-body">
    <h4 class="card-title">Add Categories</h4>
    <br><br>
    <form class="forms-sample">
        <div class="form-group">
            <label for="exampleInputName1">Category Name</label>
            <input type="text" class="form-control" id="exampleInputName1" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail3">Description</label>
            <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email">
        </div>
        <div class="form-group">
            <label>Upload Icon</label>
            <input type="file" name="img[]" class="file-upload-default">
            <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                </span>
            </div>
        </div>
        <button type="submit" class="btn btn-primary me-2">Submit</button>
        <button class="btn btn-light">Cancel</button>
    </form>
</div>

<script>

</script>
<?= $this->endSection() ?>