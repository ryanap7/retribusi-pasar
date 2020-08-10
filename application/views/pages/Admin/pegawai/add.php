<?php
defined('BASEPATH') or exit('No direct script access allowed');
$data['admin'] = $this->db->get_where('auth', ['id_auth' => $this->session->userdata('id')])->row_array();
$this->load->view('dist/_partials/header', $data);
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Add Data</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-12">
                    <form method="post" class="needs-validation" action="<?php echo site_url('admin/pegawai/store') ?>" novalidate="" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Data Pegawai</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Nama <sup class="text-danger">*</sup></label>
                                            <input id="name" type="text" class="form-control" name="name" tabindex="1" placeholder="Masukkan nama anda" required>
                                            <div class="invalid-feedback" id="validasi-nik">
                                                Masukkan Nama terlebih dahulu
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="jabatan">Jabatan <sup class="text-danger">*</sup></label>
                                            <input id="jabatan" type="text" class="form-control" name="jabatan" tabindex="1" placeholder="Masukkan jabatan anda" required>
                                            <div class="invalid-feedback">
                                                Masukkan Jabatan terlebih dahulu
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="telp">No Telepon <sup class="text-danger">*</sup></label>
                                            <input id="telp" type="number" class="form-control" name="telp" tabindex="1" placeholder="Masukakan Nomor Telepon Anda" required>
                                            <div class="invalid-feedback">
                                                Masukkan Nomor Telepon terlebih dahulu
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat <sup class="text-danger">*</sup></label>
                                            <textarea class="form-control" name="alamat" required=""></textarea>
                                            <div class="invalid-feedback">
                                                Please fill in your Address
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                                Add Data
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('dist/_partials/footer'); ?>