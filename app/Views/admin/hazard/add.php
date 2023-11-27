<?= $this->extend('vendor/admin/layouts') ?>
<?= $this->section('h1') ?>
Add Hazard Report
<?= $this->endsection() ?>
<?= $this->section('h2') ?>
Hazard
<?= $this->endsection() ?>
<?= $this->section('h3') ?>
Add Hazard Report
<?= $this->endsection() ?>
<?= $this->section('content') ?>
<div class="col-md-12">
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
    <div class="card card-primary">
        <div class="card-header">
        </div>
        <form action="<?= url_to('adminStoreHazard') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="card-body">
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" class="form-control" name="tgl_lapor" required>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                </div>
                <div class="form-group">
                    <label>NIP</label>
                    <input type="text" class="form-control" name="nip" placeholder="NIP" required>
                </div>
                <div class="form-group">
                    <label>Section</label>
                    <input type="text" class="form-control" name="section" placeholder="Section" required>
                </div>
                <div class="form-group">
                    <label>Lokasi</label>
                    <input type="text" class="form-control" name="lokasi" placeholder="Lokasi" required>
                </div>
                <div class="form-group">
                    <label>Jenis Bahaya</label>
                    <select class="form-control" name="jenis_bahaya">
                        <option value="1">Tindakan Tidak Aman</option>
                        <option value="2">Kondisi Tidak Aman</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Uraian Bahaya</label>
                    <Textarea class="form-control" name="uraian_bahaya" required></Textarea>
                </div>
                <div class="form-group">
                    <label>Penyebab</label>
                    <input type="text" class="form-control" name="penyebab" placeholder="Penyebab" required>
                </div>
                <div class="form-group">
                    <label>Tindakan Perbaikan</label>
                    <input type="text" class="form-control" name="tindakan_perbaikan" placeholder="Tindakan Perbaiki" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" required>
                        <option value="1">Open</option>
                        <option value="2">Close</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Foto Temuan</label>
                    <input type="file" class="form-control" name="foto" required>
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