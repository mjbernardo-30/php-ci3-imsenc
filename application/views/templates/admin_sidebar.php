<?php
$theme = APP_THEME;
?>
<ul class="navbar-nav sidebar-setting sidebar sidebar-<?= $theme; ?> accordion" id="accordionSidebar">
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>admin/dashboard">
		<div class="sidebar-brand-icon">
			<img src="<?= ASSETS_URL; ?>img/favicon-2.png" class="img-fluid">
		</div>
        <!-- <div class="sidebar-brand-text mx-3">ORM</div> -->
	</a>
	<hr class="sidebar-divider my-0">
	<li class="nav-item <?= ($data["PageDetails"]["Function"] == "Admin" && $data["PageDetails"]["Page"] == 'Dashboard') ? 'active' : ''?>">
		<a class="nav-link" href="<?= base_url(); ?>admin/dashboard">
			<i class="fas fa-fw fa-chart-bar"></i> <span>Dashboard</span>
		</a>
	</li>
	<hr class="sidebar-divider my-0">
	<li class="nav-item <?= ($data["PageDetails"]["Function"] == 'Admin' && in_array($data["PageDetails"]["Page"], array('Pending', 'Approve', 'Rejected'))) ? 'active' : ''?>">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#registration" aria-expanded="true" aria-controls="collapseTwo">
			<i class="fa fa-fw fa-users"></i> <span>Registration</span>
		</a>
		<div id="registration" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
			<div class="py-2 collapse-inner rounded collapse-menu-setting">
				<a class="collapse-item <?= ($data["PageDetails"]["Function"] == 'Admin' && $data["PageDetails"]["Page"] == 'Pending') ? 'active' : ''?>" href="<?= base_url(); ?>admin/registration/pending"><i class="fas fa-fw fa-user-clock"></i> For Approval</a>
				<a class="collapse-item <?= ($data["PageDetails"]["Function"] == 'Admin' && $data["PageDetails"]["Page"] == 'Approve') ? 'active' : ''?>" href="<?= base_url(); ?>admin/registration/approve/list"><i class="fas fa-fw fa-user-check"></i> Approved</a>
				<a class="collapse-item <?= ($data["PageDetails"]["Function"] == 'Admin' && $data["PageDetails"]["Page"] == 'Rejected') ? 'active' : ''?>" href="<?= base_url(); ?>admin/registration/rejected"><i class="fas fa-fw fa-user-times"></i> Rejected</a>
			</div>
		</div>
	</li>
	<hr class="sidebar-divider my-0">
	<li class="nav-item <?= ($data["PageDetails"]["Function"] == 'Admin' && in_array($data["PageDetails"]["Page"], array('System Logs', 'Account Management', 'Users Management'))) ? 'active' : ''?>">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#maintenance" aria-expanded="true" aria-controls="collapseTwo">
			<i class="fa fa-fw fa-cogs"></i> <span>Maintenance</span>
		</a>
		<div id="maintenance" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
			<div class="py-2 collapse-inner rounded collapse-menu-setting">
				<a class="collapse-item <?= ($data["PageDetails"]["Function"] == 'Admin' && $data["PageDetails"]["Page"] == 'System Logs') ? 'active' : ''?>" href="<?= base_url(); ?>admin/logs"><i class="fas fa-fw fa-tasks"></i> Sytem Logs</a>
				<a class="collapse-item <?= ($data["PageDetails"]["Function"] == 'Admin' && $data["PageDetails"]["Page"] == 'Users Management') ? 'active' : ''?>" href="<?= base_url(); ?>admin/users"><i class="fas fa-fw fa-users"></i> Site Users</a>
			</div>
		</div>
	</li>
	<div class="text-center d-none d-md-inline">
        <button type="button" class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>