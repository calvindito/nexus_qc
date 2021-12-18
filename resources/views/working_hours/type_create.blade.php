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
                                    <input type="number" name="total_working_day" id="total_working_day" class="form-control" min="1" placeholder="0" oninput="loop()">
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
                                    <input type="number" name="late_tolerance" id="late_tolerance" class="form-control" min="1" placeholder="0">
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
                                        <label>Status</label>
                                        <div class="input-group">
                                            <select id="wht_bulk_status" class="form-control" onchange="bulkEdit()">
                                                <option value="1">Workday</option>
                                                <option value="2">Holiday</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <label>Working Time :</label>
                                        <div class="input-group">
                                            <input type="time" id="wht_bulk_work_start_time" class="form-control" value="08:00" oninput="bulkEdit()">
                                            <div class="input-group-append">
                                                <span class="input-group-text">-</span>
                                            </div>
                                            <input type="time" id="wht_bulk_work_end_time" class="form-control" value="17:00" oninput="bulkEdit()">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <label>Break Time :</label>
                                        <div class="input-group">
                                            <input type="time" id="wht_bulk_break_start_time" class="form-control" value="12:00" oninput="bulkEdit()">
                                            <div class="input-group-append">
                                                <span class="input-group-text">-</span>
                                            </div>
                                            <input type="time" id="wht_bulk_break_end_time" class="form-control" value="13:00" oninput="bulkEdit()">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><hr></div>
                    </div>
                    <div id="wht_detail_show" style="display:none;">
                        <table class="table table-bordered">
                            <thead class="bg-light">
                                <tr class="text-center">
                                    <th class="align-middle" colspan="2" rowspan="2">Day Of The Work</th>
                                    <th class="align-middle" rowspan="2">Set As</th>
                                    <th class="align-middle" colspan="2">Working Time</th>
                                    <th class="align-middle" colspan="2">Break Time</th>
                                    <th class="align-middle" rowspan="2">Total Work Hours</th>
                                </tr>
                                <tr class="text-center">
                                    <th class="align-middle">Start Time</th>
                                    <th class="align-middle">End Time</th>
                                    <th class="align-middle">Start Time</th>
                                    <th class="align-middle">End Time</th>
                                </tr>
                            </thead>
                            <tbody id="data_wht_detail"></tbody>
                        </table>
                    </div>
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
    $(function() {
        $('.sidebar-control').click();
    });

    function bulkEdit() {
        var work_start_time  = $('#wht_bulk_work_start_time').val();
        var work_end_time    = $('#wht_bulk_work_end_time').val();
        var break_start_time = $('#wht_bulk_break_start_time').val();
        var break_end_time   = $('#wht_bulk_break_end_time').val();
        var status           = $('#wht_bulk_status').val();

        $('input[name="wht_work_start_time[]"]:not([readonly])').val(work_start_time);
        $('input[name="wht_work_end_time[]"]:not([readonly])').val(work_end_time);
        $('input[name="wht_break_start_time[]"]:not([readonly])').val(break_start_time);
        $('input[name="wht_break_end_time[]"]:not([readonly])').val(break_end_time);
        $('select[name="wht_status[]"]').val(status);

        if(status == 1) {
            $('.statusable').html('<i class="icon-check font-weight-bold text-success"></i>');
            $('.readonlyable').attr('readonly', false);
            $('input[name="wht_work_start_time[]"]').val(work_start_time);
            $('input[name="wht_work_end_time[]"]').val(work_end_time);
            $('input[name="wht_break_start_time[]"]').val(break_start_time);
            $('input[name="wht_break_end_time[]"]').val(break_end_time);
            differenceTime('all');
        } else {
            $('.statusable').html('<i class="icon-cross font-weight-bold text-danger"></i>');
            $('.readonlyable').attr('readonly', true);
            $('input[name="wht_work_start_time[]"]').val(null);
            $('input[name="wht_work_end_time[]"]').val(null);
            $('input[name="wht_break_start_time[]"]').val(null);
            $('input[name="wht_break_end_time[]"]').val(null);
            $('.total_hours_work').html('-');
        }
    }

    function whtDetailStatus(param) {
        var wht_status = $('#wht_status' + param).val();
        if(wht_status == 1) {
            $('#statusable' + param).html('<i class="icon-check font-weight-bold text-success"></i>');
            $('#wht_detail' + param + ' .readonlyable').attr('readonly', false);
            $('#wht_detail' + param + ' input[name="wht_work_start_time[]"]').val('08:00');
            $('#wht_detail' + param + ' input[name="wht_work_end_time[]"]').val('17:00');
            $('#wht_detail' + param + ' input[name="wht_break_start_time[]"]').val('12:00');
            $('#wht_detail' + param + ' input[name="wht_break_end_time[]"]').val('13:00');
            $('#wht_detail' + param + ' .total_hours_work').html('8 Hours 0 Minutes');
        } else {
            $('#statusable' + param).html('<i class="icon-cross font-weight-bold text-danger"></i>');
            $('#wht_detail' + param + ' .readonlyable').attr('readonly', true);
            $('#wht_detail' + param + ' input[name="wht_work_start_time[]').val(null);
            $('#wht_detail' + param + ' input[name="wht_work_end_time[]').val(null);
            $('#wht_detail' + param + ' input[name="wht_break_start_time[]').val(null);
            $('#wht_detail' + param + ' input[name="wht_break_end_time[]').val(null);
            $('#wht_detail' + param + ' .total_hours_work').html('-');
        }
    }

    function loop() {
        $('#data_wht_detail').html('');
        var total_working_day = $('#total_working_day').val();

        if(total_working_day > 0) {
            $('#wht_detail_show').show();
            $('#bulk_edit').show();

            for(var i = 1; i <= total_working_day; i++) {
                $('#data_wht_detail').append(`
                    <tr id="wht_detail` + i + `">
                        <input type="hidden" name="wht_detail[]" value="` + true + `">
                        <td class="text-center">
                            <span class="statusable" id="statusable` + i + `">
                                <i class="icon-check font-weight-bold text-success"></i>
                            </span>
                        </td>
                        <td class="text-left">Day ` + i + `</td>
                        <td class="text-center">
                            <select name="wht_status[]" id="wht_status` + i + `" class="form-control" onchange="whtDetailStatus(` + i + `)">
                                <option value="1">Workday</option>
                                <option value="2">Holiday</option>
                            </select>
                        </td>
                        <td class="text-center">
                            <input type="time" name="wht_work_start_time[]" id="work_start_time` + i + `" value="08:00" class="form-control readonlyable" oninput="differenceTime(` + i + `)">
                        </td>
                        <td class="text-center">
                            <input type="time" name="wht_work_end_time[]" id="work_end_time` + i + `" value="17:00" class="form-control readonlyable" oninput="differenceTime(` + i + `)">
                        </td>
                        <td class="text-center">
                            <input type="time" name="wht_break_start_time[]" id="break_start_time` + i + `" value="12:00" class="form-control readonlyable" oninput="differenceTime(` + i + `)">
                        </td>
                        <td class="text-center">
                            <input type="time" name="wht_break_end_time[]" id="break_end_time` + i + `" value="13:00" class="form-control readonlyable" oninput="differenceTime(` + i + `)">
                        </td>
                        <td class="text-center">
                            <span class="total_hours_work" id="total_hours_work` + i + `">8 Hours 0 Minutes</span>
                        </td>
                    </tr>
                `);
            }
        } else {
            $('#wht_detail_show').hide();
            $('#bulk_edit').hide();
        }
    }

    function differenceTime(param) {
        if(param == 'all') {
            var work_start_time  = $('#wht_bulk_work_start_time').val();
            var work_end_time    = $('#wht_bulk_work_end_time').val();
            var break_start_time = $('#wht_bulk_break_start_time').val();
            var break_end_time   = $('#wht_bulk_break_end_time').val();
            var selector         = '.total_hours_work';
        } else {
            var work_start_time  = $('#work_start_time' + param).val();
            var work_end_time    = $('#work_end_time' + param).val();
            var break_start_time = $('#break_start_time' + param).val();
            var break_end_time   = $('#break_end_time' + param).val();
            var selector         = '#total_hours_work' + param;
        }

        var work_start  = new Date('Jan 1, 1970 ' + work_start_time + ':00');
        var work_end    = new Date('Jan 1, 1970 ' + work_end_time + ':00');
        var work_res    = Math.abs(work_start - work_end) / 1000;
        var work_hour   = Math.floor(work_res / 3600) % 24;
        var work_minute = Math.floor(work_res / 60) % 60;

        var break_start  = new Date('Jan 1, 1970 ' + break_start_time + ':00');
        var break_end    = new Date('Jan 1, 1970 ' + break_end_time + ':00');
        var break_res    = Math.abs(break_start - break_end) / 1000;
        var break_hour   = Math.floor(break_res / 3600) % 24;
        var break_minute = Math.floor(break_res / 60) % 60;

        var hour   = work_hour - break_hour;
        var minute = work_minute - break_minute;

        $(selector).html(hour + ' Hours ' + minute + ' Minutes');
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
