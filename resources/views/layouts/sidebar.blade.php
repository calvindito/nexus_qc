<body>
	<div class="page-content">
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">
			<div class="navbar navbar-dark bg-dark-100 navbar-static border-0" style="height:55px;">
				<div class="navbar-brand flex-fill wmin-0 text-center">
					<a href="{{ url('dashboard') }}" class="d-inline-block">
						<h5 class="sidebar-resize-hide mb-0 text-white text-uppercase font-weight-bold" style="font-size:18.5px;">Nexus Quality Control</h5>
						<h5 class="sidebar-resize-show mb-0 text-white text-uppercase font-weight-bold" style="font-size:18.5px;">QC</h5>
					</a>
				</div>
				<ul class="navbar-nav align-self-center ml-auto sidebar-resize-hide">
					<li class="nav-item dropdown">
						<button type="button" class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-mobile-main-toggle d-lg-none">
							<i class="icon-cross2"></i>
						</button>
					</li>
				</ul>
			</div>
			<div class="sidebar-content">
				<div class="sidebar-section sidebar-section-body user-menu-vertical text-center">
					<div class="card-img-actions d-inline-block">
						<img class="img-fluid rounded-circle" src="{{ session('image') }}" width="80" height="80" alt="">
					</div>
					<div class="sidebar-resize-hide position-relative mt-2">
                        <div class="cursor-pointer">
                            <h6 class="font-weight-semibold mb-0">{{ session('name') }}</h6>
                            <span class="d-block text-muted">{{ session('email') }}</span>
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
											<a href="{{ url('master_data/global/rank') }}" class="nav-link {{ Request::segment(1) == 'master_data' && Request::segment(2) == 'global' && Request::segment(3) == 'rank' ? 'active' : '' }}">Rank</a>
										</li>
                                        <li class="nav-item">
											<a href="{{ url('master_data/global/departement') }}" class="nav-link {{ Request::segment(1) == 'master_data' && Request::segment(2) == 'global' && Request::segment(3) == 'departement' ? 'active' : '' }}">Departement</a>
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
											<a href="{{ url('master_data/general/gender') }}" class="nav-link {{ Request::segment(1) == 'master_data' && Request::segment(2) == 'general' && Request::segment(3) == 'gender' ? 'active' : '' }}">Gender</a>
										</li>
										<li class="nav-item">
											<a href="{{ url('master_data/general/class_product') }}" class="nav-link {{ Request::segment(1) == 'master_data' && Request::segment(2) == 'general' && Request::segment(3) == 'class_product' ? 'active' : '' }}">Class Product</a>
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
                        <li class="nav-item nav-item-submenu {{ Request::segment(1) == 'location' ? 'nav-item-expanded nav-item-open' : '' }}">
							<a href="#" class="nav-link">
                                <i class="icon-map4"></i>
                                <span>Location</span>
                            </a>
							<ul class="nav nav-group-sub" data-submenu-title="Location">
								<li class="nav-item">
                                    <a href="{{ url('location/country') }}" class="nav-link {{ Request::segment(1) == 'location' && Request::segment(2) == 'country' ? 'active' : '' }}">Country</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('location/province') }}" class="nav-link {{ Request::segment(1) == 'location' && Request::segment(2) == 'province' ? 'active' : '' }}">Province</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('location/city') }}" class="nav-link {{ Request::segment(1) == 'location' && Request::segment(2) == 'city' ? 'active' : '' }}">City</a>
                                </li>
							</ul>
						</li>
                        <li class="nav-item nav-item-submenu {{ Request::segment(1) == 'group_defect' ? 'nav-item-expanded nav-item-open' : '' }}">
							<a href="#" class="nav-link">
                                <i class="icon-ungroup"></i>
                                <span>Group Defect</span>
                            </a>
							<ul class="nav nav-group-sub" data-submenu-title="Group Defect">
								<li class="nav-item">
                                    <a href="{{ url('group_defect/group') }}" class="nav-link {{ Request::segment(1) == 'group_defect' && Request::segment(2) == 'group' ? 'active' : '' }}">Group</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('group_defect/sub_group') }}" class="nav-link {{ Request::segment(1) == 'group_defect' && Request::segment(2) == 'sub_group' ? 'active' : '' }}">Sub Group</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('group_defect/defect_list') }}" class="nav-link {{ Request::segment(1) == 'group_defect' && Request::segment(2) == 'defect_list' ? 'active' : '' }}">Defect List</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('group_defect/reject_list') }}" class="nav-link {{ Request::segment(1) == 'group_defect' && Request::segment(2) == 'reject_list' ? 'active' : '' }}">Reject List</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('group_defect/major_defect_list') }}" class="nav-link {{ Request::segment(1) == 'group_defect' && Request::segment(2) == 'major_defect_list' ? 'active' : '' }}">Major Defect List</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('group_defect/critical_defect_list') }}" class="nav-link {{ Request::segment(1) == 'group_defect' && Request::segment(2) == 'critical_defect_list' ? 'active' : '' }}">Critical Defect List</a>
                                </li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
