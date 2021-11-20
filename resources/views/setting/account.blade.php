<div class="content-inner">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-lg-inline">
            <div class="page-title d-flex">
                <h4>
                    <a href="{{ url()->previous() }}" class="text-dark"><i class="icon-arrow-left52 mr-2"></i></a>
                    <span class="font-weight-semibold">Account</span>
                </h4>
            </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ url('dashboard') }}" class="breadcrumb-item">Dashboard</a>
                    <a href="javascript:void(0);" class="breadcrumb-item">Setting</a>
                    <span class="breadcrumb-item active">Account</span>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="d-lg-flex align-items-lg-start">
            <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-left wmin-300 border-0 shadow-none sidebar-expand-lg">
                <div class="sidebar-content">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="card-img-actions d-inline-block mb-3">
                                <img class="img-fluid rounded-circle" src="{{ session('image') }}" width="170" height="170">
                            </div>
                            <h6 class="font-weight-semibold mb-0">{{ session('name') }}</h6>
                            <span class="d-block opacity-75">{{ '@' . session('username') }}</span>
                        </div>
                        <ul class="nav nav-sidebar">
                            <li class="nav-item">
                                <a href="#profile" class="nav-link active" data-toggle="tab">
                                    <i class="icon-user"></i> My profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#change_password" class="nav-link" data-toggle="tab">
                                    <i class="icon-lock"></i> Change Password
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#activity" class="nav-link" data-toggle="tab">
                                    <i class="icon-calendar3"></i> My Activity
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#two_factor_authentication" class="nav-link" data-toggle="tab">
                                    <i class="icon-key"></i> Two Factor Authentication
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content flex-1">
                <div class="tab-pane fade active show" id="profile">
                    <div class="card">
                        <div class="card-header bg-transparent header-elements-inline">
                            <h6 class="card-title">Profile</h6>
                        </div>
                        <div class="card-body">
                            <form id="form_profile">
                                <div class="alert alert-danger" id="validation_alert" style="display:none;">
                                    <ul id="validation_content" class="mb-0"></ul>
                                </div>
                                <div class="form-group">
                                    <label>Image :</label>
                                    <input type="file" name="image" id="image" class="form-control h-auto">
                                </div>
                                <div class="form-group">
                                    <label>Name :<sup class="text-danger">*</sup></label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ session('name') }}" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label>Username :<sup class="text-danger">*</sup></label>
                                    <input type="text" name="username" id="username" class="form-control" value="{{ session('username') }}" placeholder="Enter username">
                                </div>
                                <div class="form-group">
                                    <label>Email :<sup class="text-danger">*</sup></label>
                                    <input type="text" name="email" id="email" class="form-control" value="{{ session('email') }}" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label>Gender :<sup class="text-danger">*</sup></label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="">-- Choose --</option>
                                        <option value="1" {{ session('gender') == 1 ? 'selected' : '' }}>Male</option>
                                        <option value="2" {{ session('gender') == 2 ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="text-right">
                                        <button type="button" class="btn btn-primary" onclick="profile()"><i class="icon-floppy-disk"></i> Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="change_password">
                    <div class="card">
                        <div class="card-header bg-transparent header-elements-inline">
                            <h6 class="card-title">Change Password</h6>
                        </div>
                        <div class="card-body">
                            <form id="form_change_password">
                                <div class="alert alert-danger" id="validation_alert" style="display:none;">
                                    <ul id="validation_content" class="mb-0"></ul>
                                </div>
                                <div class="form-group">
                                    <label>New Password :<sup class="text-danger">*</sup></label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter new password">
                                </div>
                                <div class="form-group">
                                    <label>Confirmation Password :<sup class="text-danger">*</sup></label>
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Enter confirmation password">
                                </div>
                                <div class="form-group mb-0">
                                    <div class="text-right">
                                        <button type="button" class="btn btn-primary" onclick="changePassword()"><i class="icon-floppy-disk"></i> Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="activity">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div class="row">
                                <div class="col-md-6 my-auto">
                                    <h6 class="card-title">My Activity</h6>
                                </div>
                                <div class="col-md-6 text-right">
                                    <div class="text-right">
                                        <button type="button" class="btn btn-teal btn-labeled btn-labeled-left btn-sm" onclick="loadDataTable()">
                                            <b><i class="icon-sync"></i></b> Refresh
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped display w-100" id="datatable_activity">
                                <thead class="bg-light">
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Menu</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="two_factor_authentication">
                    <div class="card">
                        <div class="card-header bg-transparent header-elements-inline">
                            <h6 class="card-title">Two Factor Authentication</h6>
                        </div>
                        <div class="card-body">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 my-auto">
                                            <div class="text-uppercase" id="text_tfa">
                                                @if(session('tfa'))
                                                    2 step verification enabled
                                                @else
                                                    2 step verification not enabled
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-right" id="btn_tfa">
                                            @if(session('tfa'))
                                                <button type="button" class="btn btn-danger" onclick="tfa({{ session('tfa') }})">Disable</button>
                                            @else
                                                <button type="button" class="btn btn-success" onclick="tfa({{ session('tfa') }})">Enable</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0"><hr></div>
                            <div class="form-group">
                                <h6 class="font-weight-semibold">What is Two Factor Authentication?</h6>
                                <p class="mt-2">
                                    Two Factor Authentication or two-step verification is an optional security feature, where it functions to better secure your account from various digital crimes, one of which is hacking. Two-step verification itself has been used by many developers in the world to secure the data belonging to its users, even Facebook one of the famous social networks uses this feature, as well as Google, WhatsApp, and many others.<br><br>
                                    This security technology is proven to be powerful to minimize the theft of digital-based privacy belonging to someone. Matters related to privacy are indeed better kept secret as secret as possible, because if misused by irresponsible parties it will be fatal as a result. Not only is your good name tainted, it could be that your privacy is used to commit unlawful acts. For example, for deceptive deceptive activities and the like. Therefore, to prevent this from happening, two-step verification is present to better secure social network accounts, email, internet payment, cloud storage, and others that are yours.
                                </p>
                            </div>
                            <div class="form-group">
                                <h6 class="font-weight-semibold">How Two Factor Authentication Works?</h6>
                                <p class="mt-2">
                                    This two-step verification security usually utilizes the phone number of its users to make it more secure. Because the phone number is private, including incoming messages and calls also feels personal. This means that only the owner of the phone number concerned can access it. Therefore, it is not wrong that this security relies on phone numbers as a verification medium.<br><br>
                                    The way security works is fairly simple, but difficult to break into or manipulate by hackers. Here's how this two-step verification works in a nutshell:
                                    <ul>
                                        <li>Account owners (who use a two-step verification system) will usually be asked to enter phone number information as a complement to data from their social media accounts.</li>
                                        <li>When using two-step verification, the system sends the verification code to the previously registered phone number.</li>
                                        <li>Then the account owner is asked to fill in the code column on the social media page, usually six digits sent to the phone number earlier.</li>
                                    </ul>
                                    So if the user enables the Two Factor Authentication feature or two-step verification, then each wants to login to the social network or another. Users are asked to enter a code sent through a previously verified phone number. The code is then entered in the code column provided by the online service concerned.<br><br>
                                    Thus, the privacy accounts that users have will be more difficult to hack. This is because the account is integrated with the account owner's number. Therefore, if an unknown person tries to login to the account, then he must have access to the phone number of the account owner (victim) to get a verification code, then the unknown person can log into the victim's account. Of course with code verification through a phone number it feels safer. And this will automatically make it difficult for hackers to hijack someone's privacy account. That's how this two-step verification system works.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    $(function() {
        $('.sidebar-control').click();
        loadDataTable();

        $('a[data-toggle="tab"]').on('shown.bs.tab', function() {
			$('#datatable_activity').DataTable().columns.adjust();
		});
    });

    function profile() {
        $.ajax({
            url: '{{ url("setting/account/profile") }}',
            type: 'POST',
            dataType: 'JSON',
            data: new FormData($('#form_profile')[0]),
            contentType: false,
            processData: false,
            cache: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#profile #validation_alert').hide();
                $('#profile #validation_content').html('');
                loadingOpen('#profile');
            },
            success: function(response) {
                if(response.status == 200) {
                    location.reload(true);
                    notif('success', 'bg-success', response.message);
                } else if(response.status == 422) {
                    loadingClose('#profile');
                    $('#profile #validation_alert').show();
                    $('#profile').scrollTop(0);
                    notif('warning', 'bg-warning', 'Please check the form');

                    $.each(response.error, function(i, val) {
                        $.each(val, function(i, val) {
                            $('#profile #validation_content').append(`
                                <li>` + val + `</li>
                            `);
                        });
                    });
                } else {
                    loadingClose('#profile');
                    notif('error', 'bg-danger', response.message);
                }
            },
            error: function() {
                $('#profile').scrollTop(0);
                loadingClose('#profile');
                swalInit.fire({
                    title: 'Server Error',
                    text: 'Please contact developer',
                    icon: 'error'
                });
            }
        });
    }

    function changePassword() {
        $.ajax({
            url: '{{ url("setting/account/change_password") }}',
            type: 'POST',
            dataType: 'JSON',
            data: $('#form_change_password').serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#change_password #validation_alert').hide();
                $('#change_password #validation_content').html('');
                loadingOpen('#change_password');
            },
            success: function(response) {
                loadingClose('#change_password');
                if(response.status == 200) {
                    $('#password').val(null);
                    $('#confirm_password').val(null);
                    notif('success', 'bg-success', response.message);
                } else if(response.status == 422) {
                    $('#change_password #validation_alert').show();
                    $('#change_password').scrollTop(0);
                    notif('warning', 'bg-warning', 'Please check the form');

                    $.each(response.error, function(i, val) {
                        $.each(val, function(i, val) {
                            $('#change_password #validation_content').append(`
                                <li>` + val + `</li>
                            `);
                        });
                    });
                } else {
                    notif('error', 'bg-danger', response.message);
                }
            },
            error: function() {
                $('#change_password').scrollTop(0);
                loadingClose('#change_password');
                swalInit.fire({
                    title: 'Server Error',
                    text: 'Please contact developer',
                    icon: 'error'
                });
            }
        });
    }

    function loadDataTable() {
        $('#datatable_activity').DataTable({
            dom: '<"datatable-header"fB><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            serverSide: true,
            deferRender: true,
            destroy: true,
            scrollX: true,
            iDisplayInLength: 10,
            order: [[0, 'desc']],
            ajax: {
                url: '{{ url("setting/account/load_activity") }}',
                type: 'GET',
                beforeSend: function() {
                    loadingOpen('.dataTables_scroll');
                },
                complete: function() {
                    loadingClose('.dataTables_scroll');
                },
                error: function() {
                    loadingClose('.dataTables_scroll');
                    swalInit.fire({
                        title: 'Server Error',
                        text: 'Please contact developer',
                        icon: 'error'
                    });
                }
            },
            columns: [
                { name: 'id', searchable: false, className: 'text-center align-middle' },
                { name: 'log_name', className: 'text-center align-middle' },
                { name: 'description', className: 'text-center align-middle' },
                { name: 'created_at', searchable: false, className: 'text-center align-middle' }
            ]
        });
    }

    function tfa(param) {
        $.ajax({
            url: '{{ url("setting/account/two_factor_authentication") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                tfa: param == 1 ? 0 : 1
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                loadingOpen('#two_factor_authentication');
            },
            success: function(response) {
                loadingClose('#two_factor_authentication');
                if(response.status == 200) {
                    notif('success', 'bg-success', response.message);
                    if(param == true) {
                        $('#text_tfa').html('2 step verification not enabled');
                        $('#btn_tfa').html('<button type="button" class="btn btn-success" onclick="tfa(' + false + ')">Enable</button>');
                    } else {
                        $('#text_tfa').html('2 step verification enabled');
                        $('#btn_tfa').html('<button type="button" class="btn btn-danger" onclick="tfa(' + true + ')">Disable</button>');
                    }
                } else {
                    notif('error', 'bg-danger', response.message);
                }
            },
            error: function() {
                loadingClose('#two_factor_authentication');
                swalInit.fire({
                    title: 'Server Error',
                    text: 'Please contact developer',
                    icon: 'error'
                });
            }
        });
    }
</script>
