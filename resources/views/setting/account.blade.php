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
                            <li class="nav-item bg-light mt-3">
                                <a href="javascript:void(0);" class="nav-link no-pointer font-weight-semibold" style="font-size:12px;">
                                    Last Login : {{ date('d M Y, H:i A', strtotime(session('last_login'))) }}
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
                            <h6 class="card-title">Form Profile</h6>
                        </div>
                        <div class="card-body">
                            <form id="form_profile">
                                <div class="alert alert-danger" id="validation_alert" style="display:none;">
                                    <ul id="validation_content" class="mb-0"></ul>
                                </div>
                                <div class="form-group">
                                    <label>Image :</label>
                                    <input type="file" name="image" id="image" class="form-control">
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
                            <h6 class="card-title">Form Change Password</h6>
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
                        <div class="card-header bg-transparent header-elements-inline">
                            <h6 class="card-title">List My Activity</h6>
                        </div>
                        <div class="card-body">
                            <div class="text-right">
                                <button type="button" class="btn btn-teal btn-labeled btn-labeled-left" onclick="loadDataTable()">
                                    <b><i class="icon-sync"></i></b> Refresh
                                </button>
                            </div>
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
                $('#form_profile #validation_alert').hide();
                $('#form_profile #validation_content').html('');
                loadingOpen('#form_profile');
            },
            success: function(response) {
                if(response.status == 200) {
                    location.reload(true);
                    notif('success', 'bg-success', response.message);
                } else if(response.status == 422) {
                    loadingClose('#form_profile');
                    $('#form_profile #validation_alert').show();
                    $('#form_profile').scrollTop(0);
                    notif('warning', 'bg-warning', 'Please check the form');

                    $.each(response.error, function(i, val) {
                        $.each(val, function(i, val) {
                            $('#form_profile #validation_content').append(`
                                <li>` + val + `</li>
                            `);
                        });
                    });
                } else {
                    loadingClose('#form_profile');
                    notif('error', 'bg-danger', response.message);
                }
            },
            error: function() {
                $('#form_profile').scrollTop(0);
                loadingClose('#form_profile');
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
                $('#form_change_password #validation_alert').hide();
                $('#form_change_password #validation_content').html('');
                loadingOpen('#form_change_password');
            },
            success: function(response) {
                loadingClose('#form_change_password');
                if(response.status == 200) {
                    $('#password').val(null);
                    $('#confirm_password').val(null);
                    notif('success', 'bg-success', response.message);
                } else if(response.status == 422) {
                    $('#form_change_password #validation_alert').show();
                    $('#form_change_password').scrollTop(0);
                    notif('warning', 'bg-warning', 'Please check the form');

                    $.each(response.error, function(i, val) {
                        $.each(val, function(i, val) {
                            $('#form_change_password #validation_content').append(`
                                <li>` + val + `</li>
                            `);
                        });
                    });
                } else {
                    notif('error', 'bg-danger', response.message);
                }
            },
            error: function() {
                $('#form_change_password').scrollTop(0);
                loadingClose('#form_change_password');
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
</script>
