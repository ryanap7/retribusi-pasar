<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="main-sidebar sidebar-style-2">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			<a href="<?php echo base_url(); ?>">
				<font color="blue"> Pasar Sidamulya</font>
			</a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm">
			<a href="<?php echo base_url(); ?>">SIRP</a>
		</div>
		<?php if ($this->session->userdata('role') === '1') { ?>
			<ul class="sidebar-menu">
				<li class="menu-header">
					<font color="black">Dashboard </font>
				</li>
				<li class="<?= $this->uri->segment(2) == 'dashboard' ? 'active' : ''; ?>">
					<a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
						<i class="fas fa-fire"></i>
						<span>Dashboard</span>
					</a>
				</li>

				<li class="menu-header">
					<font color="black">Data Master</font>
				</li>
				<li class="<?= $this->uri->segment(2) == 'pegawai' ? 'active' : ''; ?>">
					<a class="nav-link" href="<?= base_url('admin/pegawai') ?>">
						<i class="fas fa-user"></i>
						<span>Data Pegawai</span>
					</a>
				</li>
				<li class="<?= $this->uri->segment(2) == 'pedagang' ? 'active' : ''; ?>">
					<a class="nav-link" href="<?= base_url('admin/pedagang') ?>">
						<i class="fas fa-user"></i>
						<span>Data Pedagang</span>
					</a>
				</li>

				<li class="menu-header">
					<font color="black">Data Retribusi</font>
				</li>
				<li class="<?= $this->uri->segment(2) == 'setoran' ? 'active' : ''; ?>">
					<a class="nav-link" href="<?= base_url('admin/setoran') ?>">
						<i class="fas fa-user"></i>
						<span>Lunas </span>
					</a>
				</li>
				<li class="<?= $this->uri->segment(2) == 'penunggakan' ? 'active' : ''; ?>">
					<a class="nav-link" href="<?= base_url('admin/penunggakan') ?>">
						<i class="fas fa-users"></i>
						<span>Penunggakan </span>
					</a>
				</li>

				<li class="menu-header">
					<font color="black">Laporan<font>
				</li>
				<li class="dropdown <?= $this->uri->segment(2) == 'laporan' ? 'active' : ''; ?>">
					<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file"></i> <span>Laporan</span></a>
					<ul class="dropdown-menu">
						<li><a class="nav-link" href="<?= base_url('admin/laporan/findSetoran') ?>">Lunas</a></li>
						<li><a class="nav-link" href="<?= base_url('admin/laporan/findPenunggakan') ?>">Penunggakan</a></li>
					</ul>
				</li>
				<li class="menu-header">
					<font color="black"></font>Setting
				</li>
				<li class="<?= $this->uri->segment(2) == 'setting' ? 'active' : ''; ?>">
					<a class="nav-link" href="<?= base_url('admin/setting') ?>">
						<i class="fas fa-cog"></i>
						<span>Setting</span>
					</a>
				</li>
				<li class="<?= $this->uri->segment(2) == 'harga_tempat' ? 'active' : ''; ?>">
					<a class="nav-link" href="<?= base_url('admin/harga_tempat') ?>">
						<i class="fas fa-dollar-sign"></i>
						<span>Harga Tempat</span>
					</a>
				</li>
				<li class="<?= $this->uri->segment(2) == 'logout' ? 'active' : ''; ?>">
					<a class="nav-link" href="<?= base_url('auth/logout') ?>">
						<i class="fas fa-sign-out-alt"></i>
						<span>
							<font color="black">Logout</font>
						</span>
					</a>
				</li>
			</ul>
		<?php
		} ?>
	</aside>
</div>