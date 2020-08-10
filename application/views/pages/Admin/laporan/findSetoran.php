<?php
defined('BASEPATH') or exit('No direct script access allowed');
$data['admin'] = $this->db->get_where('auth', ['id_auth' => $this->session->userdata('id')])->row_array();
$this->load->view('dist/_partials/header', $data);
?>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Data Laporan</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></div>
				<div class="breadcrumb-item">Data Laporan</div>
			</div>
		</div>
		<div class="section-body">
			<div class="row">
				<div class="col-12">
					<div class="card" style="margin-top: 100px;">
						<div class="card-body">
							<form method="post" class="needs-validation" action="<?php echo site_url('admin/laporan/findSetoran_') ?>" novalidate="">
								<div class="row">
									<div class="col-12 col-md-3 col-lg-3">
									</div>
									<div class="col-12 col-md-3 col-lg-3">
										<div class="form-group mt-5">
											<label>Bulan <sup class="text-danger">*</sup></label>
											<select class="form-control selectric" id="bulan" name="bulan" required>
												<option value="" selected disabled>-- Pilih bulan --</option>
												<option value="01">Januari</option>
												<option value="02">Februari</option>
												<option value="03">Maret</option>
												<option value="04">April</option>
												<option value="05">Mei</option>
												<option value="06">Juni</option>
												<option value="07">Juli</option>
												<option value="08">Agustus</option>
												<option value="09">September</option>
												<option value="10">Oktober</option>
												<option value="11">November</option>
												<option value="12">Desember</option>
											</select>
										</div>
									</div>
									<div class="col-12 col-md-3 col-lg-3">
										<div class="form-group mt-5">
											<label>Tahun <sup class="text-danger">*</sup></label>
											<select class="form-control selectric" id="tahun" name="tahun" required>
												<option value="" selected disabled>-- Pilih tahun --</option>
												<?php
												$thn_skr = date('Y');
												for ($x = $thn_skr; $x >= 2000; $x--) {
												?>
													<option value="<?= $x ?>"><?= $x ?></option>
												<?php
												}
												?>
											</select>
										</div>
									</div>
									<div class="col-12 col-md-3 col-lg-3">
									</div>
									<div class="form-group" style="margin-left: 560px;">
										<button type="submit" class="btn btn-primary" tabindex="4">
											<i class="fa fa-search"></i>
											Cari
										</button>
									</div>
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