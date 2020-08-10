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
                        <form method="post" class="needs-validation" action="<?php echo site_url('admin/setting/update') ?>" novalidate="" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Setting Dashboard</h4>
                                        </div>
                                        <div class="card-body">
                                            <input id="id" type="hidden" class="form-control" name="id" tabindex="1" value="<?= $data->id ?>">
                                            <div class="form-group">
                                                <label for="img">Gambar Pasar <sup class="text-danger">*</sup></label>
                                                <input id="img" type="file" class="form-control" name="img" tabindex="1">
                                                <img src="<?= base_url('assets/img/setting/') . $data->img ?>" alt="" style="margin-top: 20px;" width="100px">
                                            </div>
                                            <div class="form-group">
                                                <label for="desc">Deskripsi <sup class="text-danger">*</sup></label>
                                                <textarea class="form-control" name="desc" required=""><?= $data->desc ?></textarea>
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