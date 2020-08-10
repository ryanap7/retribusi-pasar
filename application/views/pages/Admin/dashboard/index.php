<?php
defined('BASEPATH') or exit('No direct script access allowed');
$data['admin'] = $this->db->get_where('auth', ['id_auth' => $this->session->userdata('id')])->row_array();
$this->load->view('dist/_partials/header', $data);
?>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<?php
						$no = 1;
						foreach ($admin as $data) : ?>
							<div class="card-body">
								<img src="<?= base_url('assets/img/setting/') . $data->img ?>" alt="" style="margin-top: 20px;margin-left: 20px;" width="1100px">
								<p style="margin-top: 20px;margin-left:20px;text-align: justify;text-indent: 60px;"><?= $data->desc ?></p>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php $this->load->view('dist/_partials/footer'); ?>