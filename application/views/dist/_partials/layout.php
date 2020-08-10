<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div id="app">
	<div class="main-wrapper main-wrapper-1">
		<div class="navbar-bg"></div>
		<nav class="navbar navbar-expand-lg main-navbar">
			<form class="form-inline mr-auto">
				<ul class="navbar-nav mr-3">
					<li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
				</ul>
			</form>
			<ul class="navbar-nav navbar-right">
				<li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
						<img alt="image" src="<?php echo base_url('assets/img/avatar/') . $admin['img'] ?>" class="rounded-circle mr-1">
						<div class="d-sm-none d-lg-inline-block">Hi, <?= $admin['name'] ?></div>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a href="<?= base_url('profile/edit') ?>" class="dropdown-item has-icon text-danger">
							<i class="fas fa-edit"></i> Edit Profile
						</a>
						<a href="<?= base_url('profile/changepassword') ?>" class="dropdown-item has-icon text-danger">
							<i class="fas fa-lock"></i> Ubah Password
						</a>
						<a href="<?= base_url('auth/logout') ?>" class="dropdown-item has-icon text-danger">
							<i class="fas fa-sign-out-alt"></i> Logout
						</a>
					</div>
				</li>
			</ul>
		</nav>