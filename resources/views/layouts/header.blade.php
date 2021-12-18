<div class="content-wrapper">
	<div class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="d-flex flex-1 d-lg-none">
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
		</div>
		<div class="navbar-collapse collapse flex-lg-1 order-2 order-lg-1" id="navbar-search">
			<div class="navbar-search d-flex align-items-center py-2 py-lg-0">
                <button type="button" class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-control sidebar-main-resize d-none d-lg-inline-flex"><i class="icon-paragraph-justify3"></i></button>
                <span class="navbar-text my-3 my-lg-0 ml-lg-3">
                    signed in as <span class="font-weight-semibold">{{ session('username') }}</span>
                </span>
			</div>
		</div>
		<div class="d-flex justify-content-end align-items-center flex-1 flex-lg-0 order-1 order-lg-2">
			<ul class="navbar-nav flex-row">
                <li class="nav-item">
                    <a href="javascript:void(0);" target="_blank" onclick="swalInit.fire('Coming Soon', 'Our mobile app will be launching soon', 'info')" class="navbar-nav-link"><i class="icon-mobile mr-1"></i> Download App</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('auth/logout') }}" class="navbar-nav-link"><i class="icon-switch mr-1"></i> Logout</a>
                </li>
			</ul>
		</div>
	</div>
