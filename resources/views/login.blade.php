<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Nexus</title>
    <link href="{{ asset('website/icon.png') }}" rel="shortcut icon">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet">
	<link href="{{ asset('template/global_assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet">
	<link href="{{ asset('template/assets/css/all.min.css') }}" rel="stylesheet">
	<script src="{{ asset('template/global_assets/js/main/jquery.min.js') }}"></script>
	<script src="{{ asset('template/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('template/assets/js/app.js') }}"></script>
</head>
<body style="background:url('{{ asset('website/bg-login.jpg') }}'); background-position:center; background-repeat:no-repeat; background-size:cover;">
	<div class="page-content">
		<div class="content-wrapper">
			<div class="content-inner">
				<div class="content d-flex justify-content-center align-items-center">
					<form class="login-form" action="{{ url('login') }}" method="POST">
                        @csrf
						<div class="card mb-0">
							<div class="card-body">
                                <div class="text-center mb-3">
                                    <img src="{{ asset('website/icon.png') }}" width="200" class="img-fluid mb-1 mt-1">
									<h5 class="mb-0">Nexus QC System</h5>
									<span class="d-block text-muted">Enter your username and password here</span>
								</div>
                                @if(session('success'))
                                    <div class="alert bg-danger text-white alert-styled-left alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                        <span class="font-weight-semibold">{{ session('success') }}</span>
                                    </div>
                                @elseif(session('failed'))
                                    <div class="alert bg-danger text-white alert-styled-left alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                        <span class="font-weight-semibold">{{ session('failed') }}</span>
                                    </div>
                                @endif
								<div class="form-group form-group-feedback form-group-feedback-left">
									<input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
									<div class="form-control-feedback">
										<i class="icon-user text-muted"></i>
									</div>
								</div>
								<div class="form-group form-group-feedback form-group-feedback-left">
									<input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
									<div class="form-control-feedback">
										<i class="icon-lock2 text-muted"></i>
									</div>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-block">Sign in</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
