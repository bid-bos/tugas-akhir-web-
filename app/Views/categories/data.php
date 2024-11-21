<?= $this->extend('templates/menu') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

<div class="card-body">
    <h4 class="card-title">input category</h4>
    <form class="forms-sample">
        <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Categories Name </label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
            </div>
        </div>
        <div class="form-group row">
            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Description</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="description" placeholder="description">
            </div>
        </div>
        <div class="form-group row">
            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Upload Icon</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="exampleInputMobile" placeholder="Mobile number">
            </div>
        </div>
        <button type="submit" class="btn btn-primary me-2">Submit</button>
        <button class="btn btn-light">Cancel</button>
    </form>
</div>
<br>
<br>
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
                    <td> <button type="button" class="btn btn-success btn-rounded btn-icon">
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
<?= $this->endSection() ?>