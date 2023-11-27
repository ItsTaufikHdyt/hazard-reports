<?= $this->extend('vendor/admin/layouts') ?>
<?= $this->section('h1') ?>
Hazard Report
<?= $this->endsection() ?>
<?= $this->section('h2') ?>
Hazard
<?= $this->endsection() ?>
<?= $this->section('h3') ?>
Hazard Report
<?= $this->endsection() ?>
<?= $this->section('content') ?>

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <a href="<?= url_to('adminAddHazard') ?>" class="btn btn-primary btn-sm">Add Hazard</a>
        </div>
        <!-- /.card-header -->
        <form action="<?= url_to('exportHazardExcel') ?>" method="POST">
            <button type="submit">Download Laporan</button>
        </form>
        <div class="card-body table-responsive p-0" style="height: 300px;">
            <table class="table table-head-fixed text-nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Lapor</th>
                        <th>NIP</th>
                        <th>Section</th>
                        <th>Lokasi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php
                    foreach ($datax as $data) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data->tgl_lapor ?></td>
                            <td><?= $data->nip ?></td>
                            <td><?= $data->section ?></td>
                            <td><?= $data->lokasi ?></td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showData<?= $data->id ?>">
                                    Show
                                </button>

                                <!-- Modal -->
                                <div class="modal fade bd-example-modal-lg" id="showData<?= $data->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <table>
                                                    <tr>
                                                        <th>Tanggal lapor</th>
                                                        <td><?= $data->tgl_lapor ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <td><?= $data->nama ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>NIP</th>
                                                        <td><?= $data->nip ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Section</th>
                                                        <td><?= $data->section ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Lokasi</th>
                                                        <td><?= $data->lokasi ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Jenis Bahaya</th>
                                                        <td>
                                                            <?php if ($data->jenis_bahaya = 1) { ?>
                                                                <span class="badge badge-warning">Tindakan Tidak Aman</span>
                                                            <?php } else { ?>
                                                                <span class="badge badge-danger">Kondisi Tidak Aman</span>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Uraian Bahaya</th>
                                                        <td><?= $data->uraian_bahaya ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Penyebab</th>
                                                        <td><?= $data->penyebab ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tindakan Perbaikan</th>
                                                        <td><?= $data->tindakan_perbaikan ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status</th>
                                                        <td><?php if ($data->status = 1) { ?>
                                                                <span class="badge badge-warning">Open</span>
                                                            <?php } else { ?>
                                                                <span class="badge badge-danger">Close</span>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Foto</th>
                                                        <td><img src="<?= base_url('uploads/foto/' . $data->foto) ?>" class="img-fluid"></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= url_to('adminEditHazard', $data->id); ?>" class="btn btn-warning">Edit</a>
                                <a href="<?= url_to('adminDeleteHazard', $data->id); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin ingin menghapus data User ?')">Delete</a>

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