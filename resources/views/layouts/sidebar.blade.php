<body>
	<div class="page-content">
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">
			<div class="navbar navbar-dark bg-dark-100 navbar-static border-0">
				<div class="navbar-brand flex-fill wmin-0">
					<a href="index.html" class="d-inline-block">
						<img src="{{ asset('website/logo.png') }}" class="img-thumbnail sidebar-resize-hide" alt="">
						<img src="{{ asset('website/icon.png') }}" class="ml-2 sidebar-resize-show" alt="">
					</a>
				</div>
				<ul class="navbar-nav align-self-center ml-auto sidebar-resize-hide">
					<li class="nav-item dropdown">
						<button type="button" class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
							<i class="icon-transmission"></i>
						</button>
						<button type="button" class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-mobile-main-toggle d-lg-none">
							<i class="icon-cross2"></i>
						</button>
					</li>
				</ul>
			</div>
			<div class="sidebar-content">
				<div class="sidebar-section sidebar-section-body user-menu-vertical text-center">
					<div class="card-img-actions d-inline-block">
						<img class="img-fluid rounded-circle" src="{{ asset('template/global_assets/images/placeholders/placeholder.jpg') }}" width="50" height="50" alt="">
						<div class="card-img-actions-overlay card-img rounded-circle">
							<a href="#" class="btn btn-white btn-icon btn-sm rounded-pill">
								<i class="icon-pencil"></i>
							</a>
						</div>
					</div>
					<div class="sidebar-resize-hide position-relative mt-2">
						<div class="dropdown">
							<div class="cursor-pointer" data-toggle="dropdown">
					    		<h6 class="font-weight-semibold dropdown-toggle mb-0">Hanna Dorman</h6>
					    		<span class="d-block text-muted">hanna@dorman.com</span>
					    	</div>
							<div class="dropdown-menu w-100">
								<a href="#" class="dropdown-item">
									<i class="icon-user-plus"></i>
									My profile
								</a>
								<a href="#" class="dropdown-item">
									<i class="icon-coins"></i>
									My balance
								</a>
								<a href="#" class="dropdown-item">
									<i class="icon-comment-discussion"></i>
									Messages
									<span class="badge badge-indigo badge-pill ml-auto">58</span>
								</a>
								<div class="dropdown-divider"></div>
								<a href="#" class="dropdown-item">
									<i class="icon-cog5"></i>
									Account settings
								</a>
								<a href="#" class="dropdown-item">
									<i class="icon-switch2"></i>
									Logout
								</a>
							</div>
				    	</div>
			    	</div>
				</div>
				<div class="sidebar-section">
					<ul class="nav nav-sidebar" data-nav-type="accordion">
						<li class="nav-item-header pt-0">
							<div class="text-uppercase font-size-xs line-height-xs">Main Menu</div> 
							<i class="icon-menu" title="Main Menu"></i>
						</li>
						<li class="nav-item">
							<a href="{{ url('dashboard') }}" class="nav-link {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}">
								<i class="icon-home4"></i>
								<span>Dashboard</span>
							</a>
						</li>
						<li class="nav-item nav-item-submenu {{ Request::segment(1) == 'master_data' ? 'nav-item-expanded nav-item-open' : '' }}">
							<a href="#" class="nav-link">
								<i class="icon-archive"></i> 
								<span>Master Data</span>
							</a>
							<ul class="nav nav-group-sub" data-submenu-title="General pages">
								<li class="nav-item nav-item-submenu {{ Request::segment(1) == 'master_data' && Request::segment(2) == 'global' ? 'nav-item-expanded nav-item-open' : '' }}">
									<a href="#" class="nav-link">Global</a>
									<ul class="nav nav-group-sub">
										<li class="nav-item">
											<a href="{{ url('master_data/global/company') }}" class="nav-link {{ Request::segment(1) == 'master_data' && Request::segment(2) == 'global' && Request::segment(3) == 'company' ? 'active' : '' }}">Company</a>
										</li>
										<li class="nav-item">
											<a href="{{ url('master_data/global/allowance_smv') }}" class="nav-link {{ Request::segment(1) == 'master_data' && Request::segment(2) == 'global' && Request::segment(3) == 'allowance_smv' ? 'active' : '' }}">Allowance SMV</a>
										</li>
									</ul>
								</li>
								<li class="nav-item nav-item-submenu {{ Request::segment(1) == 'master_data' && Request::segment(2) == 'general' ? 'nav-item-expanded nav-item-open' : '' }}">
									<a href="#" class="nav-link">General</a>
									<ul class="nav nav-group-sub">
										<li class="nav-item">
											<a href="{{ url('master_data/general/group_defect') }}" class="nav-link {{ Request::segment(1) == 'master_data' && Request::segment(2) == 'general' && Request::segment(3) == 'group_defect' ? 'active' : '' }}">Group Defect</a>
										</li>
										<li class="nav-item">
											<a href="{{ url('master_data/general/class_product') }}" class="nav-link {{ Request::segment(1) == 'master_data' && Request::segment(2) == 'general' && Request::segment(3) == 'class_product' ? 'active' : '' }}">Class Product</a>
										</li>
										<li class="nav-item">
											<a href="{{ url('master_data/general/group_defect') }}" class="nav-link {{ Request::segment(1) == 'master_data' && Request::segment(2) == 'general' && Request::segment(3) == 'gender' ? 'active' : '' }}">Gender</a>
										</li>
										<li class="nav-item">
											<a href="{{ url('master_data/general/group_size') }}" class="nav-link {{ Request::segment(1) == 'master_data' && Request::segment(2) == 'general' && Request::segment(3) == 'group_size' ? 'active' : '' }}">Group Size</a>
										</li>
										<li class="nav-item">
											<a href="{{ url('master_data/general/type_product') }}" class="nav-link {{ Request::segment(1) == 'master_data' && Request::segment(2) == 'general' && Request::segment(3) == 'type_product' ? 'active' : '' }}">Type Product</a>
										</li>
										<li class="nav-item">
											<a href="{{ url('master_data/general/type_product_detail') }}" class="nav-link {{ Request::segment(1) == 'master_data' && Request::segment(2) == 'general' && Request::segment(3) == 'type_product_detail' ? 'active' : '' }}">Type Product Detail</a>
										</li>
										<li class="nav-item">
											<a href="{{ url('master_data/general/buyer') }}" class="nav-link {{ Request::segment(1) == 'master_data' && Request::segment(2) == 'general' && Request::segment(3) == 'buyer' ? 'active' : '' }}">Buyer</a>
										</li>
										<li class="nav-item">
											<a href="{{ url('master_data/general/brand') }}" class="nav-link {{ Request::segment(1) == 'master_data' && Request::segment(2) == 'general' && Request::segment(3) == 'brand' ? 'active' : '' }}">Brand</a>
										</li>
										<li class="nav-item">
											<a href="{{ url('master_data/general/fabric') }}" class="nav-link {{ Request::segment(1) == 'master_data' && Request::segment(2) == 'general' && Request::segment(3) == 'fabric' ? 'active' : '' }}">Fabric</a>
										</li>
										<li class="nav-item">
											<a href="{{ url('master_data/general/color') }}" class="nav-link {{ Request::segment(1) == 'master_data' && Request::segment(2) == 'general' && Request::segment(3) == 'color' ? 'active' : '' }}">Color</a>
										</li>
										<li class="nav-item">
											<a href="{{ url('master_data/general/style') }}" class="nav-link {{ Request::segment(1) == 'master_data' && Request::segment(2) == 'general' && Request::segment(3) == 'style' ? 'active' : '' }}">Style</a>
										</li>
									</ul>
								</li>
								<li class="nav-item nav-item-submenu {{ Request::segment(1) == 'master_data' && Request::segment(2) == 'working_hours' ? 'nav-item-expanded nav-item-open' : '' }}">
									<a href="#" class="nav-link">Working Hours</a>
									<ul class="nav nav-group-sub">
										<li class="nav-item">
											<a href="{{ url('master_data/working_hours/type') }}" class="nav-link {{ Request::segment(1) == 'master_data' && Request::segment(2) == 'working_hours' && Request::segment(3) == 'type' ? 'active' : '' }}">Type</a>
										</li>
										<li class="nav-item">
											<a href="{{ url('master_data/working_hours/chart') }}" class="nav-link {{ Request::segment(1) == 'master_data' && Request::segment(2) == 'working_hours' && Request::segment(3) == 'chart' ? 'active' : '' }}">Chart</a>
										</li>
										<li class="nav-item">
											<a href="{{ url('master_data/working_hours/schedule') }}" class="nav-link {{ Request::segment(1) == 'master_data' && Request::segment(2) == 'working_hours' && Request::segment(3) == 'schedule' ? 'active' : '' }}">Schedule</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
						{{-- <li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link">
								<i class="icon-copy"></i> 
								<span>Menu Level 1</span>
							</a>
							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item">
									<a href="index.html" class="nav-link">Default layout</a>
								</li>
							</ul>
						</li> --}}
					</ul>
				</div>
			</div>
		</div>