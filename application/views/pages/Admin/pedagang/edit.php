<?php
defined('BASEPATH') or exit('No direct script access allowed');
$data['admin'] = $this->db->get_where('auth', ['id_auth' => $this->session->userdata('id')])->row_array();
$this->load->view('dist/_partials/header', $data);
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Data</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-12">
                    <?php foreach ($admin as $data) : ?>
                        <form method="post" class="needs-validation" action="<?php echo site_url('admin/pedagang/update') ?>" novalidate="" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Data Pedagang</h4>
                                        </div>
                                        <div class="card-body">
                                            <input id="id" type="hidden" class="form-control" name="id" tabindex="1" value="<?= $data->id_pedagang ?>">
                                            <div class="form-group">
                                                <label for="nama_tempat">Nama Kios/Los <sup class="text-danger">*</sup></label>
                                                <input id="nama_tempat" type="text" class="form-control" name="nama_tempat" tabindex="1" value="<?= $data->nama_tempat ?>" required autofocus>
                                                <small>L : Los,</small>
                                                <small>K : Kios</small>
                                                <div class="invalid-feedback">
                                                    Masukkan Nama Kios/Los terlebih dahulu
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="luas">Luas Kios/Los <sup class="text-danger">*</sup></label>
                                                <input id="luas" type="number" class="form-control" name="luas" tabindex="1" value="<?= $data->luas ?>" required>
                                                <small>Dalam satuan M<sup>2</sup></small>
                                                <div class="invalid-feedback">
                                                    Masukkan Luas Kios/Los terlebih dahulu
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="no_reg">No. Registrasi Pedagang <sup class="text-danger">*</sup></label>
                                                <input id="no_reg" type="number" class="form-control" name="no_reg" tabindex="1" value="<?= $data->no_registrasi ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="date">Tanggal Registrasi</label>
                                                <input id="date" type="date" name="date" class="form-control" value="<?= $data->tanggal_registrasi ?>" required>
                                            </div>

        <div class="form-group">
                                                <label for="nama">Nama Pedagang <sup class="text-danger">*</sup></label>
                                                <input id="nama" type="text" class="form-control" name="nama" tabindex="1" value="<?= $data->nama_pedagang ?>" required>
                                                <div class="invalid-feedback">
                                                    Masukkan Nama Pedagang terlebih dahulu
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="jenis">Jenis Barang Dagangan <sup class="text-danger">*</sup></label>
                                                <input id="jenis" type="text" class="form-control" name="jenis" tabindex="1" value="<?= $data->jenis_dagangan ?>" required>
                                                <div class="invalid-feedback">
                                                    Masukkan Jenis Barang Dagangan terlebih dahulu
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="alamat">Alamat <sup class="text-danger">*</sup></label>
                                                <textarea class="form-control" name="alamat" required=""><?= $data->alamat ?></textarea>
                                                <div class="invalid-feedback">
                                                    Masukkan Alamat terlebih dahulu
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="telp">No Telepon <sup class="text-danger">*</sup></label>
                                                <input id="telp" type="number" class="form-control" name="telp" tabindex="1" value="<?= $data->no_hp ?>" required>
                                                <div class="invalid-feedback">
                                                    Masukkan Nomor Telepon terlebih dahulu
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="img">Foto <sup class="text-danger">*</sup></label>
                                                <input id="img" type="file" class="form-control" name="img" tabindex="1">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success btn-lg btn-block" tabindex="4">
                                                    Edit Data
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('dist/_partials/footer'); ?>