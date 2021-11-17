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
						<li class="nav-item">
							<a href="{{ url('dashboard') }}" class="nav-link {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}">
								<i class="icon-home4"></i>
								<span>Dashboard</span>
							</a>
						</li>
                        <li class="nav-item nav-item-submenu {{ Request::segment(1) == 'global' ? 'nav-item-expanded nav-item-open' : '' }}">
							<a href="#" class="nav-link">
                                <i class="icon-sphere3"></i>
                                <span>Global</span>
                            </a>
							<ul class="nav nav-group-sub" data-submenu-title="Global">
                                <li class="nav-item">
                                    <a href="{{ url('global/departement') }}" class="nav-link {{ Request::segment(1) == 'global' && Request::segment(2) == 'departement' ? 'active' : '' }}">Departement</a>
                                </li>
								<li class="nav-item">
                                    <a href="{{ url('global/rank') }}" class="nav-link {{ Request::segment(1) == 'global' && Request::segment(2) == 'rank' ? 'active' : '' }}">Rank</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('global/job_desc') }}" class="nav-link {{ Request::segment(1) == 'global' && Request::segment(2) == 'job_desc' ? 'active' : '' }}">Job Desc</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('global/allowance_smv') }}" class="nav-link {{ Request::segment(1) == 'global' && Request::segment(2) == 'allowance_smv' ? 'active' : '' }}">Allowance SMV</a>
                                </li>
							</ul>
						</li>
                        <li class="nav-item nav-item-submenu {{ Request::segment(1) == 'general' ? 'nav-item-expanded nav-item-open' : '' }}">
							<a href="#" class="nav-link">
                                <i class="icon-grid6"></i>
                                <span>General</span>
                            </a>
							<ul class="nav nav-group-sub" data-submenu-title="General">
                                <li class="nav-item">
                                    <a href="{{ url('general/check_point') }}" class="nav-link {{ Request::segment(1) == 'general' && Request::segment(2) == 'check_point' ? 'active' : '' }}">Check Point</a>
                                </li>
							</ul>
						</li>
                        <li class="nav-item nav-item-submenu {{ Request::segment(1) == 'material' ? 'nav-item-expanded nav-item-open' : '' }}">
							<a href="#" class="nav-link">
                                <i class="icon-hammer"></i>
                                <span>Material</span>
                            </a>
							<ul class="nav nav-group-sub" data-submenu-title="Material">
								<li class="nav-item">
                                    <a href="{{ url('material/fabric') }}" class="nav-link {{ Request::segment(1) == 'material' && Request::segment(2) == 'fabric' ? 'active' : '' }}">Fabric</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('material/color') }}" class="nav-link {{ Request::segment(1) == 'material' && Request::segment(2) == 'color' ? 'active' : '' }}">Color</a>
                                </li>
							</ul>
						</li>
                        <li class="nav-item nav-item-submenu {{ Request::segment(1) == 'contact' ? 'nav-item-expanded nav-item-open' : '' }}">
							<a href="#" class="nav-link">
                                <i class="icon-address-book3"></i>
                                <span>Contact</span>
                            </a>
							<ul class="nav nav-group-sub" data-submenu-title="Contact">
								<li class="nav-item">
                                    <a href="{{ url('contact/buyer') }}" class="nav-link {{ Request::segment(1) == 'contact' && Request::segment(2) == 'buyer' ? 'active' : '' }}">Buyer</a>
                                </li>
							</ul>
						</li>
                        <li class="nav-item nav-item-submenu {{ Request::segment(1) == 'working_hours' ? 'nav-item-expanded nav-item-open' : '' }}">
							<a href="#" class="nav-link">
                                <i class="icon-briefcase"></i>
                                <span>Working Hours</span>
                            </a>
							<ul class="nav nav-group-sub" data-submenu-title="Working Hours">
								<li class="nav-item">
                                    <a href="{{ url('working_hours/type') }}" class="nav-link {{ Request::segment(1) == 'working_hours' && Request::segment(2) == 'type' ? 'active' : '' }}">Type</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('working_hours/chart') }}" class="nav-link {{ Request::segment(1) == 'working_hours' && Request::segment(2) == 'chart' ? 'active' : '' }}">Chart</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('working_hours/schedule') }}" class="nav-link {{ Request::segment(1) == 'working_hours' && Request::segment(2) == 'schedule' ? 'active' : '' }}">Schedule</a>
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
                                    <a href="{{ url('group_defect/major_issues') }}" class="nav-link {{ Request::segment(1) == 'group_defect' && Request::segment(2) == 'major_issues' ? 'active' : '' }}">Major Issues</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('group_defect/critical_issues') }}" class="nav-link {{ Request::segment(1) == 'group_defect' && Request::segment(2) == 'critical_issues' ? 'active' : '' }}">Critical Issues</a>
                                </li>
							</ul>
						</li>
                        <li class="nav-item nav-item-submenu {{ Request::segment(1) == 'product' ? 'nav-item-expanded nav-item-open' : '' }}">
							<a href="#" class="nav-link">
                                <i class="icon-archive"></i>
                                <span>Product</span>
                            </a>
							<ul class="nav nav-group-sub" data-submenu-title="Product">
                                <li class="nav-item">
                                    <a href="{{ url('product/gender') }}" class="nav-link {{ Request::segment(1) == 'product' && Request::segment(2) == 'gender' ? 'active' : '' }}">Gender</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('product/group_size') }}" class="nav-link {{ Request::segment(1) == 'product' && Request::segment(2) == 'group_size' ? 'active' : '' }}">Group Size</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('product/brand') }}" class="nav-link {{ Request::segment(1) == 'product' && Request::segment(2) == 'brand' ? 'active' : '' }}">Brand</a>
                                </li>
								<li class="nav-item">
                                    <a href="{{ url('product/class') }}" class="nav-link {{ Request::segment(1) == 'product' && Request::segment(2) == 'class' ? 'active' : '' }}">Class</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('product/type') }}" class="nav-link {{ Request::segment(1) == 'product' && Request::segment(2) == 'type' ? 'active' : '' }}">Type</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('product/style') }}" class="nav-link {{ Request::segment(1) == 'product' && Request::segment(2) == 'style' ? 'active' : '' }}">Style</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('product/manage') }}" class="nav-link {{ Request::segment(1) == 'product' && Request::segment(2) == 'manage' ? 'active' : '' }}">Manage</a>
                                </li>
							</ul>
						</li>
                        <li class="nav-item nav-item-submenu {{ Request::segment(1) == 'order' ? 'nav-item-expanded nav-item-open' : '' }}">
							<a href="#" class="nav-link">
                                <i class="icon-cart5"></i>
                                <span>Order</span>
                            </a>
							<ul class="nav nav-group-sub" data-submenu-title="Order">
                                <li class="nav-item">
                                    <a href="{{ url('order/purchasing') }}" class="nav-link {{ Request::segment(1) == 'order' && Request::segment(2) == 'purchasing' ? 'active' : '' }}">Purchasing</a>
                                </li>
							</ul>
						</li>
                        <li class="nav-item nav-item-submenu {{ Request::segment(1) == 'setting' ? 'nav-item-expanded nav-item-open' : '' }}">
							<a href="#" class="nav-link">
                                <i class="icon-cog"></i>
                                <span>Setting</span>
                            </a>
							<ul class="nav nav-group-sub" data-submenu-title="Setting">
								<li class="nav-item">
                                    <a href="{{ url('setting/account') }}" class="nav-link {{ Request::segment(1) == 'setting' && Request::segment(2) == 'account' ? 'active' : '' }}">Account</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('setting/activity') }}" class="nav-link {{ Request::segment(1) == 'setting' && Request::segment(2) == 'activity' ? 'active' : '' }}">Activity</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('setting/user') }}" class="nav-link {{ Request::segment(1) == 'setting' && Request::segment(2) == 'user' ? 'active' : '' }}">User</a>
                                </li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
