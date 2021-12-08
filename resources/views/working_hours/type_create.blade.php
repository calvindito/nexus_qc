<div class="content-inner">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-lg-inline">
            <div class="page-title d-flex">
                <h4>
                    <a href="{{ url()->previous() }}" class="text-dark"><i class="icon-arrow-left52 mr-2"></i></a>
                    <span class="font-weight-semibold">Create Type Working Hours</span>
                </h4>
            </div>
            <div class="header-elements">
                <div class="d-flex justify-content-center">
                    <div class="form-group">
                        <a href="{{ url('working_hours/type') }}" class="btn btn-secondary btn-labeled btn-labeled-left">
                            <b><i class="icon-arrow-left5"></i></b> Back To List
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ url('dashboard') }}" class="breadcrumb-item">Dashboard</a>
                    <a href="javascript:void(0);" class="breadcrumb-item">Working Hours</a>
                    <a href="{{ url('working_hours/type') }}" class="breadcrumb-item">Type</a>
                    <span class="breadcrumb-item active">Create</span>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="alert alert-danger" id="validation_alert" style="display:none;">
            <ul id="validation_content" class="mb-0"></ul>
        </div>
        <div class="card">
            <div class="card-body">
                <form id="form_data" autocomplete="off">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Type Working Hours :<span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter type">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Total Day :<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="total_working_day" id="total_working_day" class="form-control" placeholder="0" oninput="loop()">
                                    <span class="input-group-append">
                                        <span class="input-group-text">Day</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Late Tolerance :</label>
                                <div class="input-group">
                                    <input type="number" name="late_tolerance" id="late_tolerance" class="form-control" placeholder="0">
                                    <span class="input-group-append">
                                        <span class="input-group-text">Minutes</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Status :<span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">-- Choose --</option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group"><hr></div>
                    <div id="bulk_edit" style="display:none;">
                        <div class="alert alert-dark">
                            <div class="form-group text-center">
                                <span class="text-uppercase font-weight-bold">Bulk Edit</span>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Start Time</span>
                                            </div>
                                            <input type="time" id="wht_bulk_start_time" class="form-control" value="08:00" oninput="bulkEdit()">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <span class="input-group-text">End Time</span>
                                            </div>
                                            <input type="time" id="wht_bulk_end_time" class="form-control" value="17:00" oninput="bulkEdit()">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Status</span>
                                            </div>
                                            <select id="wht_bulk_status" class="form-control" onchange="bulkEdit()">
                                                <option value="1">Work</option>
                                                <option value="2">Break</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><hr></div>
                    </div>
                    <div id="wht_detail_show"></div>
                    <div class="form-group mb-0"><hr></div>
                    <div class="form-group mb-0">
                        <div class="text-right">
                            <button type="button" class="btn btn-primary" onclick="create()"><i class="icon-plus3"></i> Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    function bulkEdit() {
        var start_time = $('#wht_bulk_start_time').val();
        var end_time   = $('#wht_bulk_end_time').val();
        var status     = $('#wht_bulk_status').val();

        $('input[name="wht_start_time[]"]:not([readonly])').val(start_time);
        $('input[name="wht_end_time[]"]:not([readonly])').val(end_time);
        $('select[name="wht_status[]"]').val(status);

        if(status == 1) {
            $('.statusable').html('<i class="icon-check font-weight-bold text-success"></i>');
            $('.readonlyable').attr('readonly', false);
            $('input[name="wht_start_time[]"]').val(start_time);
            $('input[name="wht_end_time[]"]').val(end_time);
        } else {
            $('.statusable').html('<i class="icon-cross font-weight-bold text-danger"></i>');
            $('.readonlyable').attr('readonly', true);
            $('input[name="wht_start_time[]"]').val(null);
            $('input[name="wht_end_time[]"]').val(null);
        }
    }

    function whtDetailStatus(param) {
        var wht_status = $('#wht_status' + param).val();
        if(wht_status == 1) {
            $('#statusable' + param).html('<i class="icon-check font-weight-bold text-success"></i>');
            $('#wht_detail' + param + ' .readonlyable').attr('readonly', false);
            $('#wht_detail' + param + ' input[name="wht_start_time[]"]').val('08:00');
            $('#wht_detail' + param + ' input[name="wht_end_time[]"]').val('17:00');
        } else {
            $('#statusable' + param).html('<i class="icon-cross font-weight-bold text-danger"></i>');
            $('#wht_detail' + param + ' .readonlyable').attr('readonly', true);
            $('#wht_detail' + param + ' input[name="wht_start_time[]').val(null);
            $('#wht_detail' + param + ' input[name="wht_end_time[]').val(null);
        }
    }

    function loop() {
        var total_working_day = $('#total_working_day').val();

        $('#wht_detail_show').html('');
        $('#bulk_edit').hide();

        if(total_working_day > 0) {
            $('#bulk_edit').show();
            for(var i = 1; i <= total_working_day; i++) {
                $('#wht_detail_show').append(`
                    <div class="row" id="wht_detail` + i + `">
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="hidden" name="wht_detail[]" value="` + true + `">
                                <div class="input-group">
                                    <span class="input-group-append">
                                        <span class="input-group-text statusable" id="statusable` + i + `">
                                            <i class="icon-check font-weight-bold text-success"></i>
                                        </span>
                                    </span>
                                    <input type="text" class="form-control font-weight-bold" value="Day ` i + `" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="time" name="wht_start_time[]" value="08:00" class="form-control readonlyable">
                                    <span class="input-group-append">
                                        <span class="input-group-text">until</span>
                                    </span>
                                    <input type="time" name="wht_end_time[]" value="17:00" class="form-control readonlyable">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <select name="wht_status[]" id="wht_status` + i + `" class="form-control" onchange="whtDetailStatus(` + i + `)">
                                    <option value="1">Work</option>
                                    <option value="2">Break</option>
                                </select>
                            </div>
                        </div>
                    </div>
                `);
            }
        }
    }

    function create() {
        $.ajax({
            url: '{{ url("working_hours/type/create") }}',
            type: 'POST',
            dataType: 'JSON',
            data: $('#form_data').serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#validation_alert').hide();
                $('#validation_content').html('');
                loadingOpen('.content');
            },
            success: function(response) {
                loadingClose('.content');
                if(response.status == 200) {
                    let timerInterval;
                    swalInit.fire({
                        title: 'Success!',
                        icon: 'success',
                        html: response.message + '<br><b></b>',
                        allowOutsideClick: false,
                        timer: 2500,
                        timerProgressBar: true,
                        didOpen: function() {
                            Swal.showLoading();
                            timerInterval = setInterval(function() {
                                const content = Swal.getContent();
                                if(content) {
                                    const b = content.querySelector('b');
                                    if(b) {
                                        b.textContent = Swal.getTimerLeft();
                                    }
                                }
                            }, 100);
                        },
                        willClose: function() {
                            clearInterval(timerInterval);
                        }
                    }).then(function (result) {
                        loadingOpen('.content');
                        location.reload(true);
                    });
                    notif('success', 'bg-success', response.message);
                } else if(response.status == 422) {
                    $('#validation_alert').show();
                    $('.content-inner').scrollTop(0);
                    notif('warning', 'bg-warning', 'Please check the form');

                    $.each(response.error, function(i, val) {
                        $.each(val, function(i, val) {
                            $('#validation_content').append(`
                                <li>` + val + `</li>
                            `);
                        });
                    });
                } else {
                    notif('error', 'bg-danger', response.message);
                }
            },
            error: function() {
                $('.content-inner').scrollTop(0);
                loadingClose('.content');
                swalInit.fire({
                    title: 'Server Error',
                    text: 'Please contact developer',
                    icon: 'error'
                });
            }
        });
    }
</script>
