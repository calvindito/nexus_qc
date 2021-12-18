<div class="content-inner">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-lg-inline">
            <div class="page-title d-flex">
                <h4>
                    <a href="{{ url()->previous() }}" class="text-dark"><i class="icon-arrow-left52 mr-2"></i></a>
                    <span class="font-weight-semibold">Type Working Hours</span>
                </h4>
            </div>
            <div class="header-elements">
                <div class="d-flex justify-content-center">
                    <div class="form-group">
                        <button type="button" class="btn btn-teal btn-labeled btn-labeled-left ml-1" onclick="loadDataTable()">
                            <b><i class="icon-sync"></i></b> Refresh
                        </button>
                        <a href="{{ url('working_hours/type/create') }}" class="btn btn-teal btn-labeled btn-labeled-left ml-1">
                            <b><i class="icon-plus-circle2"></i></b> Add
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
                    <span class="breadcrumb-item active">Type</span>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped display nowrap w-100" id="datatable_serverside">
                    <thead class="bg-dark text-white">
                        <tr class="text-center">
                            <th><i class="icon-eye"></i></th>
                            <th>No</th>
                            <th>Type Working Hours</th>
                            <th>Total Working Day</th>
                            <th>Total Holiday</th>
                            <th>Total Working Hours</th>
                            <th>Status</th>
                            <th>Modified By</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

<div class="modal fade" id="modal_detail" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-border-dashed">
                    <tbody>
                        <tr>
                            <th width="20%">Type Working Hours</th>
                            <td>
                                <span class="font-weight-bold">:</span>
                                <span class="ml-2" id="name"></span>
                            </td>
                            <th width="20%">Late Tolerance</th>
                            <td>
                                <span class="font-weight-bold">:</span>
                                <span class="ml-2" id="late_tolerance"></span>
                            </td>
                        </tr>
                        <tr>
                            <th width="20%">Total Day</th>
                            <td>
                                <span class="font-weight-bold">:</span>
                                <span class="ml-2" id="total_day"></span>
                            </td>
                            <th width="20%">Date Created</th>
                            <td>
                                <span class="font-weight-bold">:</span>
                                <span class="ml-2" id="created_at"></span>
                            </td>
                        </tr>
                        <tr>
                            <th width="20%">Total Working Day</th>
                            <td>
                                <span class="font-weight-bold">:</span>
                                <span class="ml-2" id="total_working_day"></span>
                            </td>
                            <th width="20%">Created By</th>
                            <td>
                                <span class="font-weight-bold">:</span>
                                <span class="ml-2" id="created_by"></span>
                            </td>
                        </tr>
                        <tr>
                            <th width="20%">Total Holiday</th>
                            <td>
                                <span class="font-weight-bold">:</span>
                                <span class="ml-2" id="total_holiday"></span>
                            </td>
                            <th width="20%">Modified By</th>
                            <td>
                                <span class="font-weight-bold">:</span>
                                <span class="ml-2" id="updated_by"></span>
                            </td>
                        </tr>
                        <tr>
                            <th width="20%">Total Working Hours</th>
                            <td>
                                <span class="font-weight-bold">:</span>
                                <span class="ml-2" id="total_working_hours"></span>
                            </td>
                            <th width="20%">Status</th>
                            <td>
                                <span class="font-weight-bold">:</span>
                                <span class="ml-2" id="status"></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group"><hr></div>
                <table class="table table-bordered w-100">
                    <thead class="bg-light">
                        <tr class="text-center">
                            <th class="align-middle" rowspan="2">Day Of The Work</th>
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
                    <tbody id="wht_detail"></tbody>
                </table>
            </div>
            <div class="modal-footer bg-light">
                <div class="form-group">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icon-switch"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        loadDataTable();
    });

    function loadDataTable() {
        return $('#datatable_serverside').DataTable({
            dom: '<"datatable-header"fB><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            serverSide: true,
            deferRender: true,
            stateSave: true,
            destroy: true,
            scrollX: true,
            iDisplayInLength: 10,
            order: [[2, 'asc']],
            ajax: {
                url: '{{ url("working_hours/type/datatable") }}',
                type: 'GET',
                beforeSend: function() {
                    loadingOpen('.dataTables_scroll');
                },
                complete: function() {
                    loadingClose('.dataTables_scroll');
                },
                error: function() {
                    loadingClose('.dataTables_scroll');
                    loadDataTable();
                }
            },
            columns: [
                { name: 'detail', orderable: false, searchable: false, className: 'text-center align-middle' },
                { name: 'no', orderable: false, searchable: false, className: 'text-center align-middle' },
                { name: 'name', className: 'text-center align-middle' },
                { name: 'total_working_day', orderable: false, searchable: false, className: 'text-center align-middle' },
                { name: 'total_holiday', orderable: false, searchable: false, className: 'text-center align-middle' },
                { name: 'total_working_hours', orderable: false, searchable: false, className: 'text-center align-middle' },
                { name: 'status', searchable: false, className: 'text-center align-middle' },
                { name: 'updated_by', className: 'text-center align-middle' },
                { name: 'created_at', searchable: false, className: 'text-center align-middle' },
                { name: 'action', orderable: false, searchable: false, className: 'text-center align-middle' }
            ]
        });
    }

    function detail(id) {
        $('#modal_detail').modal('show');
        $.ajax({
            url: '{{ url("working_hours/type/detail") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#wht_detail').html('');
                loadingOpen('.modal-content');
            },
            success: function(response) {
                loadingClose('.modal-content');
                $('#name').html(response.name);
                $('#total_day').html(response.total_day);
                $('#total_working_day').html(response.total_working_day);
                $('#total_holiday').html(response.total_holiday);
                $('#total_working_hours').html(response.total_working_hours);
                $('#late_tolerance').html(response.late_tolerance);
                $('#created_at').html(response.created_at);
                $('#created_by').html(response.created_by);
                $('#updated_by').html(response.updated_by);
                $('#status').html(response.status);

                $.each(response.wht_detail, function(i, val) {
                    var current = i + 1;
                    $('#wht_detail').append(`
                        <tr class="` + val.class + `">
                            <td class="align-middle text-left">Day ` + current + `</td>
                            <td class="align-middle text-center">` + val.status + `</td>
                            <td class="align-middle text-center">` + val.work_start_time + `</td>
                            <td class="align-middle text-center">` + val.work_end_time + `</td>
                            <td class="align-middle text-center">` + val.break_start_time + `</td>
                            <td class="align-middle text-center">` + val.break_end_time + `</td>
                            <td class="align-middle text-center">` + val.total_work_hours + `</td>
                        </tr>
                    `);
                });
            },
            error: function() {
                loadingClose('.modal-content');
                $('#modal_detail').modal('hide');
                swalInit.fire({
                    title: 'Server Error',
                    text: 'Please contact developer',
                    icon: 'error'
                });
            }
        });
    }

    function changeStatus(id, value) {
        $.ajax({
            url: '{{ url("working_hours/type/change_status") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id,
                status: value
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                loadingOpen('.modal-content');
            },
            success: function(response) {
                loadingClose('.modal-content');
                if(response.status == 200) {
                    $('#datatable_serverside').DataTable().ajax.reload(null, false);
                    notif('success', 'bg-success', response.message);
                } else {
                    notif('error', 'bg-danger', response.message);
                }
            },
            error: function() {
                loadingClose('.modal-content');
                swalInit.fire({
                    title: 'Server Error',
                    text: 'Please contact developer',
                    icon: 'error'
                });
            }
        });
    }

    function destroy(id) {
        var notify_confirmation = new Noty({
            text: '<h6 class="font-weight-bold mb-3">Confirmation Delete Data</h6><div class="font-italic text-danger mb-3">*) Deleted data can no longer be recovered.</div>',
            theme: 'limitless',
            timeout: false,
            modal: true,
            layout: 'center',
            closeWith: 'button',
            type: 'confirm',
            buttons: [
                Noty.button('Cancel', 'btn btn-light btn-sm', function() {
                    notify_confirmation.close();
                }),
                Noty.button('Delete', 'btn btn-danger btn-sm ml-1', function() {
                    $.ajax({
                        url: '{{ url("working_hours/type/destroy") }}',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            id: id
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if(response.status == 200) {
                                $('#datatable_serverside').DataTable().ajax.reload(null, false);
                                notif('success', 'bg-success', response.message);
                                notify_confirmation.close();
                            } else {
                                notif('error', 'bg-danger', response.message);
                            }
                        },
                        error: function() {
                            swalInit.fire({
                                title: 'Server Error',
                                text: 'Please contact developer',
                                icon: 'error'
                            });
                        }
                    });
                })
            ]
        }).show();
    }
</script>
