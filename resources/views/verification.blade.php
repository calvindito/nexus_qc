<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Nexus - Two Factor Authentication</title>
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
					<form class="login-form" method="POST">
                        @csrf
						<div class="card mb-0">
							<div class="card-body">
                                <div class="text-center mb-3">
                                    <i class="icon-lock icon-2x text-primary border-primary border-3 rounded-pill p-3 mb-3 mt-1"></i>
                                    <h5 class="mb-0">Two Factor Authentication</h5>
                                    <span class="d-block text-muted">Enter 6-digit code from the email we sent</span>
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
                                <div class="form-group">
                                    <input type="text" class="form-control" name="code" id="code" placeholder="Enter your code" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block"><i class="icon-paperplane mr-2"></i> Confirmation</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

    <script>
        $(function() {
            setTimeout(function() {
                window.location.replace('{{ url("/") }}');
            }, 3600000);

            $('#code').keyup(function() {
                var code = $('#code').val();
                if(code && code.length >= 6) {
                    $('#code').attr('disabled', true);
                    $('.btn-block').attr('disabled', true);
                    $('.login-form').submit();
                }
            });
        });
    </script>

</body>
</html>
