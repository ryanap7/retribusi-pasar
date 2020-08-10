<?php
defined('BASEPATH') or exit('No direct script access allowed');
$data['admin'] = $this->db->get_where('auth', ['id_auth' => $this->session->userdata('id')])->row_array();
$this->load->view('dist/_partials/header', $data);
?>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Data Setoran Retribusi</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></div>
				<div class="breadcrumb-item">Data Setoran Retribusi</div>
			</div>
		</div>
		<div class="section-body">
			<a href="<?= base_url('admin/setoran/create') ?>" class="btn btn-primary btn-s"><i class="fa fa-plus"></i> Add Data</a><br><br>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped" id="example">
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
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($admin as $data) :
											$originalDate = $data->tanggal;
											$newDate1 = date("d M Y", strtotime($originalDate)); ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= $data->nama_pedagang ?></td>
												<td><?= $data->alamat ?></td>
												<td><?= $data->nama_tempat ?></td>
												<td><?= $newDate1 ?></td>
												<td><span class="badge badge-success"><?= $data->ket ?></span></td>
												<td>Rp. <?= rupiah($data->jumlah) ?></td>
												<td>
													<a href="<?php echo base_url('admin/setoran/edit/') . $data->id_setoran ?>" class="btn btn-success" title="Edit"><i class="fa fa-edit"></i> </a>
													<a href="<?php echo base_url('admin/setoran/delete/') . $data->id_setoran ?>" class="btn btn-danger" onclick="javascript: return confirm('Are you sure want to Delete ?')" title="Delete"><i class="fa fa-trash"></i></a>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
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