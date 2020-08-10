<?php
defined('BASEPATH') or exit('No direct script access allowed');
$data['admin'] = $this->db->get_where('auth', ['id_auth' => $this->session->userdata('id')])->row_array();
$this->load->view('dist/_partials/header', $data);
?>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Data Pedagang</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></div>
				<div class="breadcrumb-item">Data Pedagang</div>
			</div>
		</div>
		<div class="section-body">
			<a href="<?= base_url('admin/pedagang/create') ?>" class="btn btn-primary btn-s"><i class="fa fa-plus"></i> Add Data</a><br><br>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped" id="example">
									<thead>
										<tr>
											<th class="text-center">
												No
											</th>
											<th>No. Reg</th>
											<th>Nama</th>
											<th>Jenis Dagangan</th>
											<th>Alamat</th>
											<th>Kios/Los</th>
											<th>Luas Kios/Los</th>
											<th>Foto</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
									$no = 1;
									foreach ($admin as $data) : ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= $data->no_registrasi ?></td>
												<td><?= $data->nama_pedagang ?></td>
												<td><?= $data->jenis_dagangan ?></td>
												<td><?= $data->alamat ?></td>
												<td><?= $data->nama_tempat ?></td>
												<td><?= $data->luas ?> M<sup>2</sup> </td>
												<td><img src="<?= base_url('assets/img/pedagang/') . $data->foto ?>" alt="" width="50"></td>
												<td>
													<a href="<?php echo base_url('admin/pedagang/edit/') . $data->id_pedagang ?>" class="btn btn-success" title="Edit"><i class="fa fa-edit"></i> </a>
													<a href="<?php echo base_url('admin/pedagang/delete/') . $data->id_pedagang ?>" class="btn btn-danger" onclick="javascript: return confirm('Are you sure want to Delete ?')" title="Delete"><i class="fa fa-trash"></i></a>
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