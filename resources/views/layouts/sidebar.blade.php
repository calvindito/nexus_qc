<body>
	<div class="page-content">
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">
			<div class="navbar navbar-dark bg-dark-100 navbar-static border-0">
				<div class="navbar-brand flex-fill wmin-0">
					<a href="index.html" class="d-inline-block">
						<img src="{{ asset('website/logo.png') }}" class="img-thumbnail sidebar-resize-hide" alt="">
						<img src="{{ asset('website/logo.png') }}" class="img-thumbnail sidebar-resize-show" alt="">
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
						<img class="img-fluid rounded-circle" src="{{ asset('template/global_assets/images/placeholders/placeholder.jpg') }}" width="80" height="80" alt="">
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
							<a href="{{ url('dashboard') }}" class="nav-link">
								<i class="icon-home4"></i>
								<span>Dashboard</span>
							</a>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link">
								<i class="icon-archive"></i> 
								<span>Master Data</span>
							</a>
							<ul class="nav nav-group-sub" data-submenu-title="General pages">
								<li class="nav-item nav-item-submenu">
									<a href="#" class="nav-link">Global</a>
									<ul class="nav nav-group-sub">
										<li class="nav-item">
											<a href="blog_classic_v.html" class="nav-link">Company</a>
										</li>
										<li class="nav-item">
											<a href="blog_classic_v.html" class="nav-link">Allowance SMV</a>
										</li>
									</ul>
								</li>
								<li class="nav-item nav-item-submenu">
									<a href="#" class="nav-link">General</a>
									<ul class="nav nav-group-sub">
										<li class="nav-item">
											<a href="blog_classic_v.html" class="nav-link">Group Defect</a>
										</li>
										<li class="nav-item">
											<a href="blog_classic_v.html" class="nav-link">Class Product</a>
										</li>
										<li class="nav-item">
											<a href="blog_classic_v.html" class="nav-link">Gender</a>
										</li>
										<li class="nav-item">
											<a href="blog_classic_v.html" class="nav-link">Group Size</a>
										</li>
										<li class="nav-item">
											<a href="blog_classic_v.html" class="nav-link">Type Product</a>
										</li>
										<li class="nav-item">
											<a href="blog_classic_v.html" class="nav-link">Type Product Detail</a>
										</li>
										<li class="nav-item">
											<a href="blog_classic_v.html" class="nav-link">Buyer</a>
										</li>
										<li class="nav-item">
											<a href="blog_classic_v.html" class="nav-link">Brand</a>
										</li>
										<li class="nav-item">
											<a href="blog_classic_v.html" class="nav-link">Fabric</a>
										</li>
										<li class="nav-item">
											<a href="blog_classic_v.html" class="nav-link">Color</a>
										</li>
										<li class="nav-item">
											<a href="blog_classic_v.html" class="nav-link">Style</a>
										</li>
									</ul>
								</li>
								<li class="nav-item nav-item-submenu">
									<a href="#" class="nav-link">Working Hours</a>
									<ul class="nav nav-group-sub">
										<li class="nav-item">
											<a href="blog_classic_v.html" class="nav-link">Type</a>
										</li>
										<li class="nav-item">
											<a href="blog_classic_v.html" class="nav-link">Chart</a>
										</li>
										<li class="nav-item">
											<a href="blog_classic_v.html" class="nav-link">Schedule</a>
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
			<div class="sidebar-section sidebar-section-body sidebar-resize-hide bg-dark-100">				
				<div class="d-flex">
					<a href="#" class="btn btn-danger btn-sm col-12">Logout</a>
				</div>
			</div>
		</div>