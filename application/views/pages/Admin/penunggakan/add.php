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
                    <form method="post" class="needs-validation" action="<?php echo site_url('admin/penunggakan/store') ?>" novalidate="">
                        <div class="row">
                            <div class="col-12 col-md-8 col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Data Penunggakan Retribusi</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Pedagang <sup class="text-danger">*</sup></label>
                                            <select class="form-control select2" id="pedagang" name="pedagang">
                                                <option value="" selected disabled>-- Pilih Pedagang --</option>
                                                <?php
                                                foreach ($pedagang as $data) : ?>
                                                    <option value="<?= $data->id_pedagang ?>"><?= $data->nama_pedagang ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat <sup class="text-danger">*</sup></label>
                                            <input id="alamat" type="text" class="form-control" name="alamat" tabindex="1" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat">Tempat Dagang <sup class="text-danger">*</sup></label>
                                            <input id="tempat" type="text" class="form-control" name="tempat" tabindex="1" readonly>
                                            <small>L : Los,</small>
                                            <small>K : Kios</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="date">Tanggal</label>
                                            <input id="date" type="date" name="date" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah">Jumlah <sup class="text-danger">*</sup></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        Rp
                                                    </div>
                                                </div>
                                                <input id="jumlah" type="text" name="jumlah" tabindex="1" class="form-control currency" required readonly>
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