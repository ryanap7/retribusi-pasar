<?php
defined('BASEPATH') or exit('No direct script access allowed');
$data['admin'] = $this->db->get_where('auth', ['id_auth' => $this->session->userdata('id')])->row_array();
$this->load->view('dist/_partials/header', $data);
?>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Data Laporan Setoran Retribusi</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></div>
				<div class="breadcrumb-item">Data Laporan Setoran Retribusi</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3">
				<h5>Periode : <?= $bulan ?>/<?= $tahun ?></h5>
			</div>
			<div class="col-lg-9">
				<?php
				if (count($admin) > 0) { ?>
					<form method="post" class="needs-validation" action="<?php echo site_url('admin/laporan/print_setoran') ?>" novalidate="" target="_blank">
						<div class="row">
							<div class="form-group" style="margin-left:-20px">
								<input type="hidden" value="<?= $bulan ?>" name="bulan">
							</div>
							<div class="form-group" style="margin-left:-20px">
								<input type="hidden" value="<?= $tahun ?>" name="tahun">
							</div>
							<div class="form-group" style="margin-left:-20px">
								<button type="submit" class="btn btn-danger" tabindex="4">
									<i class="fa fa-print"></i>
									Print Laporan
								</button>
							</div>
						</div>
					</form>
				<?php } ?>
			</div>
		</div>
		<div class="section-body">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped">
									<thead>
										<tr>
											<th class="text-center">
												#
											</th>
											<th>Nama</th>
											<th>Alamat</th>
											<th>Tempat Dagang</th>
											<th>Tanggal Setoran</th>
											<th>Keterangan</th>
											<th>Jumlah</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										$total = 0;
										foreach ($admin as $data) :
											$originalDate = $data->tanggal;
											$newDate1 = date("d M Y", strtotime($originalDate));  ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= $data->nama_pedagang ?></td>
												<td><?= $data->alamat ?></td>
												<td><?= $data->nama_tempat ?></td>
												<td><?= $newDate1 ?></td>
												<td><span class="badge badge-success"><?= $data->ket ?></span></td>
												<td>Rp. <?= rupiah($data->jumlah) ?></td>
											</tr>
											<?php $total += $data->jumlah; ?>
										<?php endforeach; ?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="5"></td>
											<td>Total</td>
											<td>Rp. <?= rupiah($total) ?></td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php $this->load->view('dist/_partials/footer'); ?>