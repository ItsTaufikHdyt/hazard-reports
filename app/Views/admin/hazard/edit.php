<?= $this->extend('vendor/admin/layouts') ?>
<?= $this->section('h1') ?>
Edit Hazard Report
<?= $this->endsection() ?>
<?= $this->section('h2') ?>
Hazard
<?= $this->endsection() ?>
<?= $this->section('h3') ?>
Edit Hazard Report
<?= $this->endsection() ?>
<?= $this->section('content') ?>
<div class="col-md-12">
    <!-- general form elements -->
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
        <form action="<?= url_to('adminUpdateHazard',$hazard->id) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="card-body">
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" class="form-control" name="tgl_lapor" value="<?= $hazard->tgl_lapor ?>" required>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" value="<?= $hazard->nama ?>" placeholder="Nama" required>
                </div>
                <div class="form-group">
                    <label>NIP</label>
                    <input type="text" class="form-control" name="nip" placeholder="NIP" value="<?= $hazard->nip ?>" required>
                </div>
                <div class="form-group">
                    <label>Section</label>
                    <input type="text" class="form-control" name="section" placeholder="Section" value="<?= $hazard->section ?>" required>
                </div>
                <div class="form-group">
                    <label>Lokasi</label>
                    <input type="text" class="form-control" name="lokasi" placeholder="Lokasi" value="<?= $hazard->lokasi ?>" required>
                </div>
                <div class="form-group">
                    <label>Jenis Bahaya</label>
                    <select class="form-control" name="jenis_bahaya">
                        <option value="1" <?php if ($hazard->jenis_bahaya == 1) echo 'selected'  ?>>Tindakan Tidak Aman</option>
                        <option value="2" <?php if ($hazard->jenis_bahaya == 2) echo 'selected'  ?>>Kondisi Tidak Aman</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Uraian Bahaya</label>
                    <Textarea class="form-control" name="uraian_bahaya" required><?= $hazard->uraian_bahaya ?></Textarea>
                </div>
                <div class="form-group">
                    <label>Penyebab</label>
                    <input type="text" class="form-control" name="penyebab" placeholder="Penyebab" value="<?= $hazard->penyebab ?>" required>
                </div>
                <div class="form-group">
                    <label>Tindakan Perbaikan</label>
                    <input type="text" class="form-control" name="tindakan_perbaikan" value="<?= $hazard->tindakan_perbaikan ?>" placeholder="Tindakan Perbaiki" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" required>
                        <option value="1" <?php if ($hazard->status == 1) echo 'selected'  ?>>Open</option>
                        <option value="2" <?php if ($hazard->status == 1) echo 'selected'  ?>>Close</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Foto Temuan</label>
                    <input type="file" class="form-control" name="foto">
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