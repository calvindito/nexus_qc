<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Request Timeout</title>
    <link href="{{ asset('website/icon.png') }}" rel="shortcut icon">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet">
	<link href="{{ asset('template/global_assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet">
	<link href="{{ asset('template/assets/css/all.min.css') }}" rel="stylesheet">
	<script src="{{ asset('template/global_assets/js/main/jquery.min.js') }}"></script>
	<script src="{{ asset('template/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('template/assets/js/app.js') }}"></script>
</head>
<body>
	<div class="page-content">
		<div class="content-wrapper">
			<div class="content-inner">
				<div class="content d-flex justify-content-center align-items-center">
					<div class="flex-fill">
						<div class="text-center mb-4">
							<img src="{{ asset('template/global_assets/images/error_bg.svg') }}" class="img-fluid mb-4" height="230" alt="">
							<h1 class="display-3 font-weight-semibold line-height-1 mb-2">408</h1>
							<h5>You have tried to login 3 times. <br> Please try again in 1 hour.</h5>
						</div>
                        <div class="text-center">
							<a href="{{ url('/') }}" class="btn btn-primary"><i class="icon-arrow-left7 mr-2"></i> Back</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
