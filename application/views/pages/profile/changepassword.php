<?php
defined('BASEPATH') or exit('No direct script access allowed');
$data['admin'] = $this->db->get_where('auth', ['id_auth' => $this->session->userdata('id')])->row_array();
$this->load->view('dist/_partials/header', $data);
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Ubah Password</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Ubah Password</h4>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('message') ?>
                            <form method="post" class="needs-validation" action="<?php echo site_url('profile/changepassword') ?>" novalidate="">
                                <div class="form-group">
                                    <label for="lama">Password Lama</label>
                                    <input id="lama" type="password" class="form-control" name="lama" tabindex="1" required autofocus>
                                    <?= form_error('lama', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="baru">Password Baru</label>
                                    <input id="baru" type="password" class="form-control" name="baru" tabindex="1" required>
                                    <?= form_error('baru', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="konfirmasi">Konfirmasi Password Baru</label>
                                    <input id="konfirmasi" type="password" class="form-control" name="konfirmasi" tabindex="1" required>
                                    <?= form_error('konfirmasi', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Add Data
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('dist/_partials/footer'); ?>