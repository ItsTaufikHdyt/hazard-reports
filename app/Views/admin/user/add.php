<?= $this->extend('vendor/admin/layouts') ?>
<?= $this->section('h1') ?>
Add User
<?= $this->endsection() ?>
<?= $this->section('h2') ?>
User
<?= $this->endsection() ?>
<?= $this->section('h3') ?>
Add User
<?= $this->endsection() ?>
<?= $this->section('content') ?>
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">

        </div>
        <!-- /.card-header -->
        <?php if (!empty(session()->getFlashdata('error'))) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4>Periksa Entrian Form</h4>
                </hr />
                <?php echo session()->getFlashdata('error'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <!-- form start -->
        <form action="<?= url_to('adminStoreUser') ?>" method="post">
            <?= csrf_field(); ?>
            <div class="card-body">
                <div class="form-group">
                    <label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name">
                </div>
                <div class="form-group">
                    <label">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" name="role" name="role">
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                    </select>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
</div>
<?= $this->endsection() ?>