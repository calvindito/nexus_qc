<div class="content-inner">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-lg-inline">
            <div class="page-title d-flex">
                <h4>
                    <a href="{{ url()->previous() }}" class="text-dark"><i class="icon-arrow-left52 mr-2"></i></a>
                    <span class="font-weight-semibold">Create Working Hours Type</span>
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
                <form id="form_data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Departement :<span class="text-danger">*</span></label>
                                <select name="departement_id" id="departement_id" class="custom-select">
                                    <option value="">-- Choose --</option>
                                    @foreach($departement as $d)
                                        <option value="{{ $d->id }}">{{ $d->department }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Type Working Hours :<span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-0"><hr></div>
                    <div class="form-group">
                        <div class="text-right">
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_detail"><i class="icon-plus2"></i> Add</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <table class="table table-bordered w-100" id="datatable_wht_detail">
                            <thead class="bg-light">
                                <tr class="text-center">
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Shift</th>
                                    <th>Duration</th>
                                    <th>Order Sequence</th>
                                    <th>Total Minutes</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="form-group mb-0"><hr></div>
                    <div class="form-group text-center">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" value="2">
                                Inactive
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" value="1" checked>
                                Active
                            </label>
                        </div>
                    </div>
                    <div class="form-group mb-0"><hr></div>
                    <div class="form-group">
                        <div class="text-right">
                            <button type="button" class="btn btn-primary" onclick="create()"><i class="icon-plus3"></i> Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<div class="modal fade" id="modal_detail" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Start Time :<span class="text-danger">*</span></label>
                            <input type="time" id="wht_start_time" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>End Time :<span class="text-danger">*</span></label>
                            <input type="time" id="wht_end_time" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Duration (Minutes) :<span class="text-danger">*</span></label>
                            <input type="number" id="wht_duration" class="form-control" placeholder="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Total Minutes :<span class="text-danger">*</span></label>
                            <input type="number" id="wht_total_minutes" class="form-control" placeholder="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Shift :<span class="text-danger">*</span></label>
                            <select id="wht_shift" class="custom-select">
                                <option value="">-- Choose --</option>
                                <option value="1">Work</option>
                                <option value="2">Break</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Order Sequence :<span class="text-danger">*</span></label>
                            <input type="number" id="wht_order_sequence" class="form-control" placeholder="0">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="addDetail()"><i class="icon-plus3"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#datatable_wht_detail').DataTable({
            order: [[4, 'asc']],
			scrollX: true,
            columnDefs: [
                {
                    targets: '_all',
                    className: 'text-center align-middle'
                }
            ]
		});

        $('#datatable_wht_detail tbody').on('click', '#delete_data_detail', function() {
			$('#datatable_wht_detail').DataTable().row($(this).parents('tr')).remove().draw();
		});
    });

    function addDetail() {
        var wht_start_time     = $('#wht_start_time').val();
        var wht_end_time       = $('#wht_end_time').val();
        var wht_duration       = $('#wht_duration').val();
        var wht_total_minutes  = $('#wht_total_minutes').val();
        var wht_shift          = $('#wht_shift').val();
        var wht_order_sequence = $('#wht_order_sequence').val();

        if(wht_start_time && wht_end_time && wht_duration && wht_total_minutes && wht_shift && wht_order_sequence) {
            if(wht_shift == 1) {
                var shift = 'Work';
            } else if(wht_shift == 2) {
                var shift = 'Break';
            }

            $('#datatable_wht_detail').DataTable().row.add([
                wht_start_time,
                wht_end_time,
                shift,
                wht_duration + ' Minutes',
                wht_order_sequence,
                wht_total_minutes,
                `
                    <button type="button" class="btn btn-danger btn-sm" id="delete_data_detail"><i class="icon-trash-alt"></i></button>
                    <input type="hidden" name="wht_detail[]" value="` + true + `">
                    <input type="hidden" name="wht_start_time[]" value="` + wht_start_time + `">
                    <input type="hidden" name="wht_end_time[]" value="` + wht_end_time + `">
                    <input type="hidden" name="wht_duration[]" value="` + wht_duration + `">
                    <input type="hidden" name="wht_total_minutes[]" value="` + wht_total_minutes + `">
                    <input type="hidden" name="wht_shift[]" value="` + wht_shift + `">
                    <input type="hidden" name="wht_order_sequence[]" value="` + wht_order_sequence + `">
                `
            ]).draw().node();

            $('#wht_start_time').val(null);
            $('#wht_end_time').val(null);
            $('#wht_duration').val(null);
            $('#wht_total_minutes').val(null);
            $('#wht_shift').val(null);
            $('#wht_order_sequence').val(null);
            $('#modal_detail').modal('hide');
        } else {
            swalInit.fire('Ooppss', 'Please fill in all input', 'warning');
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
                loadingOpen('body');
            },
            success: function(response) {
                loadingClose('body');
                if(response.status == 200) {
                    let timerInterval;
                    swalInit.fire({
                        title: 'Success!',
                        icon: 'success',
                        html: response.message + '<br><b></b>',
                        allowOutsideClick: false,
                        timer: 3500,
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
                        loadingOpen('body');
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
                loadingClose('body');
                swalInit.fire({
                    title: 'Server Error',
                    text: 'Please contact developer',
                    icon: 'error'
                });
            }
        });
    }
</script>
