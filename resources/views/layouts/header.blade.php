<div class="content-wrapper">
	<div class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="d-flex flex-1 d-lg-none">
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
		</div>
		<div class="navbar-collapse collapse flex-lg-1 order-2 order-lg-1" id="navbar-search">
			<div class="navbar-search d-flex align-items-center py-2 py-lg-0">
				<div class="ml-3">
                    <button type="button" class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-control sidebar-main-resize d-none d-lg-inline-flex"><i class="icon-paragraph-justify3"></i></button>
                </div>
				<div class="ml-3">{{ date('Y-m-d, H:i A') }}</div>
			</div>
		</div>
		<div class="d-flex justify-content-end align-items-center flex-1 flex-lg-0 order-1 order-lg-2">
			<ul class="navbar-nav flex-row">
                <li class="nav-item">
                    <a href="{{ url('auth/profile') }}" data-popup="tooltip" title="Profile" class="navbar-nav-link"><i class="icon-user"></i></a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('auth/change_password') }}" data-popup="tooltip" title="Change Password" class="navbar-nav-link"><i class="icon-lock"></i></a>
                </li>
				<li class="nav-item">
                    <a href="{{ url('auth/logout') }}" data-popup="tooltip" title="Logout" class="navbar-nav-link"><i class="icon-switch"></i></a>
                </li>
			</ul>
		</div>
	</div>
