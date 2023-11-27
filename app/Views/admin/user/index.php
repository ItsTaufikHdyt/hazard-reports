<?= $this->extend('vendor/admin/layouts') ?>
<?= $this->section('h1') ?>
Data User
<?= $this->endsection() ?>
<?= $this->section('h2') ?>
User
<?= $this->endsection() ?>
<?= $this->section('h3') ?>
Data User
<?= $this->endsection() ?>
<?= $this->section('content') ?>

<div class="col-12">
    <div class="card">
        <div class="card-header">

            <a href="<?= url_to('adminAddUser') ?>" class="btn btn-primary btn-sm">Add User</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 300px;">
            <table class="table table-head-fixed text-nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php
                    foreach ($datax as $data) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data->username ?></td>
                            <td><?= $data->name ?></td>
                            <td><?php if ($data->role == 1) { ?>
                                    Admin
                                <?php } else { ?>
                                    User
                                <?php } ?>
                            </td>
                            <td>
                                <a href="<?= url_to('adminEditUser', $data->id); ?>" class="btn btn-warning">Edit</a>
                                <a href="<?= url_to('adminDeleteUser', $data->id); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin ingin menghapus data User ?')">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
        <!-- /.card-body -->
    </div>
    <div class="text-center">
        <?= $pager->links() ?>
    </div>
    <!-- /.card -->
</div>

<?= $this->endsection() ?>