<div class="content-inner">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-lg-inline">
            <div class="page-title d-flex">
                <h4>
                    <a href="{{ url()->previous() }}" class="text-dark"><i class="icon-arrow-left52 mr-2"></i></a>
                    <span class="font-weight-semibold">Working Hours Chart</span>
                </h4>
            </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ url('dashboard') }}" class="breadcrumb-item">Dashboard</a>
                    <a href="javascript:void(0);" class="breadcrumb-item">Working Hours</a>
                    <span class="breadcrumb-item active">Chart</span>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="tree-default card card-body border-left-info border-left-2 mb-0">
                    <ul class="d-none mb-0">
                        @foreach($tree_view as $tv)
                            @if($tv['sub'])
                                <li class="folder expanded">
                                    <a href="company,{{ $tv['id'] }}" class="text-dark">{{ $tv['name'] }}</a>
                                    <ul>
                                        @foreach($tv['sub'] as $sb)
                                            @if($sb['sub'])
                                                <li class="folder expanded">
                                                    <a href="branch,{{ $tv['id'] }},{{ $sb['id'] }}" class="text-dark">{{ $sb['name'] }}</a>
                                                    <ul>
                                                        @foreach($sb['sub'] as $d)
                                                            @if($d['sub'])
                                                                <li class="folder expanded">
                                                                    <a href="division,{{ $tv['id'] }},{{ $sb['id'] }},{{ $d['id'] }}" class="text-dark">{{ $d['name'] }}</a>
                                                                    <ul>
                                                                        @foreach($d['sub'] as $dtt)
                                                                            @if($dtt['sub'])
                                                                                <li class="folder expanded">
                                                                                    <a href="departement,{{ $tv['id'] }},{{ $sb['id'] }},{{ $d['id'] }},{{ $dtt['id'] }}" class="text-dark">{{ $dtt['name'] }}</a>
                                                                                    <ul>
                                                                                        @foreach($dtt['sub'] as $s)
                                                                                            @if($s['sub'])
                                                                                                <li class="folder expanded">
                                                                                                    <a href="section,{{ $tv['id'] }},{{ $sb['id'] }},{{ $d['id'] }},{{ $dtt['id'] }},{{ $s['id'] }}" class="text-dark">{{ $s['name'] }}</a>
                                                                                                    <ul>
                                                                                                        @foreach($s['sub'] as $l)
                                                                                                            <li class="folder expanded">
                                                                                                                <a href="line,{{ $tv['id'] }},{{ $sb['id'] }},{{ $d['id'] }},{{ $dtt['id'] }},{{ $s['id'] }},{{ $l['id'] }}" class="text-dark">{{ $l['name'] }}</a>
                                                                                                            </li>
                                                                                                        @endforeach
                                                                                                    </ul>
                                                                                                </li>
                                                                                            @else
                                                                                                <li class="folder expanded">
                                                                                                    <a href="section,{{ $tv['id'] }},{{ $sb['id'] }},{{ $d['id'] }},{{ $dtt['id'] }},{{ $s['id'] }}" class="text-dark">{{ $s['name'] }}</a>
                                                                                                </li>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </li>
                                                                            @else
                                                                                <li class="folder expanded">
                                                                                    <a href="departement,{{ $tv['id'] }},{{ $sb['id'] }},{{ $d['id'] }},{{ $dtt['id'] }}" class="text-dark">{{ $dtt['name'] }}</a>
                                                                                </li>
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                            @else
                                                                <li class="folder expanded">
                                                                    <a href="division,{{ $tv['id'] }},{{ $sb['id'] }},{{ $d['id'] }}" class="text-dark">{{ $d['name'] }}</a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li class="folder">
                                                    <a href="branch,{{ $tv['id'] }},{{ $sb['id'] }}" class="text-dark">{{ $sb['name'] }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="folder">
                                    <a href="company,{{ $tv['id'] }}" class="text-dark">{{ $tv['name'] }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div id="content_preview">
                    <div class="alert bg-info text-white text-center">
                        <span class="font-weight-bold text-uppercase">Attention!</span><br>
                        Please select the data you want to display on the left
                    </div>
                </div>
                <div class="card" style="display:none;" id="content_detail">
                    <div class="card-header bg-transparent header-elements-sm-inline py-sm-0">
                        <h6 class="card-title py-sm-3">Detail Data</h6>
                        <div class="header-elements">
                            <ul class="pagination pagination-pager justify-content-between">
                                <li class="page-item">
                                    <a href="javascript:void(0);" class="page-link" data-toggle="modal" data-target="#modal_form" onclick="openModal()"><b><i class="icon-plus-circle2 mr-2"></i></b> Add New</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-border-dashed" style="font-size:13px;">
                            <tbody>
                                <tr>
                                    <th width="5%">Company</th>
                                    <td>
                                        <span class="font-weight-bold">:</span>
                                        <span class="ml-2" id="company"></span>
                                    </td>
                                    <th width="5%">Departement</th>
                                    <td>
                                        <span class="font-weight-bold">:</span>
                                        <span class="ml-2" id="departement"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th width="5%">Branch</th>
                                    <td>
                                        <span class="font-weight-bold">:</span>
                                        <span class="ml-2" id="branch"></span>
                                    </td>
                                    <th width="5%">Section</th>
                                    <td>
                                        <span class="font-weight-bold">:</span>
                                        <span class="ml-2" id="section"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th width="5%">Division</th>
                                    <td>
                                        <span class="font-weight-bold">:</span>
                                        <span class="ml-2" id="division"></span>
                                    </td>
                                    <th width="5%">Line</th>
                                    <td>
                                        <span class="font-weight-bold">:</span>
                                        <span class="ml-2" id="line"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group"><hr></div>
                        <table class="table table-striped display nowrap w-100" id="datatable_detail">
                            <thead class="bg-light">
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Type Working Hours</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Total Work</th>
                                    <th>Total Hours Worked</th>
                                    <th>Total All</th>
                                    <th>Total Break</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="modal_form" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_data" autocomplete="off">
                    <input type="hidden" name="flag" id="flag">
                    <input type="hidden" name="company_id" id="company_id">
                    <input type="hidden" name="branch_id" id="branch_id">
                    <input type="hidden" name="division_id" id="division_id">
                    <input type="hidden" name="departement_id" id="departement_id">
                    <input type="hidden" name="section_id" id="section_id">
                    <input type="hidden" name="line_id" id="line_id">
                    <div class="alert alert-danger" id="validation_alert" style="display:none;">
                        <ul id="validation_content" class="mb-0"></ul>
                    </div>
                    <div class="form-group">
                        <label>Type Working Hours :<span class="text-danger">*</span></label>
                        <select name="working_hours_type_id" id="working_hours_type_id" class="select2" onchange="getWhtDetail()">
                            <option value="">-- Choose --</option>
                            @foreach($wht as $w)
                                <option value="{{ $w->id }}">{{ $w->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Start Date :<span class="text-danger">*</span></label>
                                <input type="date" name="start_date" id="start_date" class="form-control" min="{{ date('Y-m-d') }}" oninput="getWhtDetail()">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>End Date :</label>
                                <input type="text" id="end_date" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Total Work :</label>
                                <input type="text" id="total_work" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Total Hours Worked :</label>
                                <input type="text" id="total_hours_worked" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Total All :</label>
                                <input type="text" id="total_all" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Total Break :</label>
                                <input type="text" id="total_break" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group"><hr></div>
                    <table class="table w-100">
                        <thead class="bg-light">
                            <tr>
                                <th>Sequence</th>
                                <th>In</th>
                                <th>Out</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="wht_detail_data"></tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <div class="form-group">
                    <button type="button" class="btn btn-danger ml-1" id="btn_cancel" onclick="openModal()" style="display:none;"><i class="icon-cross3"></i> Cancel</button>
                    <button type="button" class="btn btn-warning ml-1" id="btn_update" onclick="update()" style="display:none;"><i class="icon-pencil7"></i> Save</button>
                    <button type="button" class="btn btn-primary ml-1" id="btn_create" onclick="create()"><i class="icon-plus3"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('.sidebar-control').click();
        $('.tree-default').fancytree({
            checkbox: false,
            selectMode: 1,
            aria: true,
            init: function(event, data) {
                $('.has-tooltip .fancytree-title').tooltip();
            },
            activate: function(event, data) {
                var node  = data.node;
                var param = node.data.href;
                var split = param.split(',');

                var flag           = typeof split[0] != 'undefined' ? split[0] : null;
                var company_id     = typeof split[1] != 'undefined' ? split[1] : null;
                var branch_id      = typeof split[2] != 'undefined' ? split[2] : null;
                var division_id    = typeof split[3] != 'undefined' ? split[3] : null;
                var departement_id = typeof split[4] != 'undefined' ? split[4] : null;
                var section_id     = typeof split[5] != 'undefined' ? split[5] : null;
                var line_id        = typeof split[6] != 'undefined' ? split[6] : null;

                $('#flag').val(flag);
                $('#company_id').val(company_id);
                $('#branch_id').val(branch_id);
                $('#division_id').val(division_id);
                $('#departement_id').val(departement_id);
                $('#section_id').val(section_id);
                $('#line_id').val(line_id);

                getData();
            }
        });
    });

    function getData() {
        $.ajax({
            url: '{{ url("working_hours/chart/get_data") }}',
            type: 'GET',
            dataType: 'JSON',
            data: {
                company_id: $('#company_id').val(),
                branch_id: $('#branch_id').val(),
                division_id: $('#division_id').val(),
                departement_id: $('#departement_id').val(),
                section_id: $('#section_id').val(),
                line_id: $('#line_id').val()
            },
            beforeSend: function() {
                loadingOpen('.content');
                $('.content-inner').scrollTop(0);
                $('#content_detail').hide();
                $('#content_preview').show();
            },
            success: function(response) {
                $('#content_detail').show();
                $('#content_preview').hide();

                loadingClose('.content');
                loadDataTable();

                $('#company').html(response.company);
                $('#branch').html(response.branch);
                $('#division').html(response.division);
                $('#departement').html(response.departement);
                $('#section').html(response.section);
                $('#line').html(response.line);
            },
            error: function() {
                loadingClose('.content');
                getData();
            }
        });
    }

    function getWhtDetail() {
        if($('#working_hours_type_id').val() != '') {
            $.ajax({
                url: '{{ url("working_hours/chart/get_wht_detail") }}',
                type: 'GET',
                dataType: 'JSON',
                data: {
                    working_hours_type_id: $('#working_hours_type_id').val(),
                    start_date: $('#start_date').val()
                },
                beforeSend: function() {
                    loadingOpen('.modal-content');
                    $('#wht_detail_data').html('');
                },
                success: function(response) {
                    loadingClose('.modal-content');
                    $('#end_date').val(response.end_date);
                    $('#total_work').val(response.total_work);
                    $('#total_hours_worked').val(response.total_hours_worked);
                    $('#total_all').val(response.total_all);
                    $('#total_break').val(response.total_break);

                    $.each(response.wht_detail, function(i, val) {
                        var current = i + 1;
                        $('#wht_detail_data').append(`
                            <tr class="` + val.class + `">
                                <td class="align-middle">Day ` + current + `</td>
                                <td class="align-middle">` + val.start_time + `</td>
                                <td class="align-middle">` + val.end_time + `</td>
                                <td class="align-middle">` + val.status + `</td>
                            </tr>
                        `);
                    });
                },
                error: function() {
                    loadingClose('.modal-content');
                    getWhtDetail();
                }
            });
        } else {
            $('#wht_detail_data').html('');
            $('#end_date').val(null);
            $('#total_work').val(null);
            $('#total_hours_worked').val(null);
            $('#total_all').val(null);
            $('#total_break').val(null);
        }
    }

    function openModal() {
        reset();
        $('#btn_create').show();
        $('#btn_update').hide();
        $('#btn_cancel').hide();
    }

    function cancel() {
        reset();
        $('#modal_form').modal('hide');
        $('#btn_create').show();
        $('#btn_update').hide();
        $('#btn_cancel').hide();
    }

    function toShow() {
        reset();
        $('#modal_form').modal('show');
        $('#validation_alert').hide();
        $('#validation_content').html('');
        $('#btn_create').hide();
        $('#btn_update').show();
        $('#btn_cancel').show();
    }

    function reset() {
        $('#working_hours_type_id').val(null).change();
        $('#start_date').val('{{ date("Y-m-d") }}');
        $('#wht_detail_data').html('');
        $('#end_date').val(null);
        $('#total_work').val(null);
        $('#total_hours_worked').val(null);
        $('#total_all').val(null);
        $('#total_break').val(null);
        $('#validation_alert').hide();
        $('#validation_content').html('');
    }

    function success() {
        reset();
        $('#modal_form').modal('hide');
        $('#datatable_detail').DataTable().ajax.reload(null, false);
    }

    function loadDataTable() {
        return $('#datatable_detail').DataTable({
            dom: '<"datatable-header"fB><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            serverSide: true,
            deferRender: true,
            stateSave: true,
            destroy: true,
            scrollX: true,
            iDisplayInLength: 10,
            order: [[0, 'asc']],
            ajax: {
                url: '{{ url("working_hours/chart/datatable") }}',
                type: 'GET',
                beforeSend: function() {
                    loadingOpen('.dataTables_scroll');
                },
                data: {
                    flag: $('#flag').val(),
                    company_id: $('#company_id').val(),
                    branch_id: $('#branch_id').val(),
                    division_id: $('#division_id').val(),
                    departement_id: $('#departement_id').val(),
                    section_id: $('#section_id').val(),
                    line_id: $('#line_id').val()
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
                { name: 'id', searchable: false, className: 'text-center align-middle' },
                { name: 'working_hours_type_id', className: 'text-center align-middle' },
                { name: 'start_date', searchable: false, className: 'text-center align-middle' },
                { name: 'end_date', orderable: false, searchable: false, className: 'text-center align-middle' },
                { name: 'total_work', orderable: false, searchable: false, className: 'text-center align-middle' },
                { name: 'total_hours_worked', orderable: false, searchable: false, className: 'text-center align-middle' },
                { name: 'total_all', orderable: false, searchable: false, className: 'text-center align-middle' },
                { name: 'total_break', orderable: false, searchable: false, className: 'text-center align-middle' },
                { name: 'action', orderable: false, searchable: false, className: 'text-center align-middle' }
            ]
        });
    }

    function create() {
        $.ajax({
            url: '{{ url("working_hours/chart/create") }}',
            type: 'POST',
            dataType: 'JSON',
            data: $('#form_data').serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#validation_alert').hide();
                $('#validation_content').html('');
                loadingOpen('.modal-content');
            },
            success: function(response) {
                loadingClose('.modal-content');
                if(response.status == 200) {
                    success();
                    notif('success', 'bg-success', response.message);
                } else if(response.status == 422) {
                    $('#validation_alert').show();
                    $('.modal-body').scrollTop(0);
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
                $('.modal-body').scrollTop(0);
                loadingClose('.modal-content');
                swalInit.fire({
                    title: 'Server Error',
                    text: 'Please contact developer',
                    icon: 'error'
                });
            }
        });
    }

    function show(id) {
        toShow();
        $.ajax({
            url: '{{ url("working_hours/chart/show") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                loadingOpen('.modal-content');
            },
            success: function(response) {
                loadingClose('.modal-content');
                $('#working_hours_type_id').val(response.working_hours_type_id).change();
                $('#start_date').val(response.start_date);
                $('#btn_update').attr('onclick', 'update(' + id + ')');
            },
            error: function() {
                cancel();
                loadingClose('.modal-content');
                swalInit.fire({
                    title: 'Server Error',
                    text: 'Please contact developer',
                    icon: 'error'
                });
            }
        });
    }

    function update(id) {
        $.ajax({
            url: '{{ url("working_hours/chart/update") }}' + '/' + id,
            type: 'POST',
            dataType: 'JSON',
            data: $('#form_data').serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#validation_alert').hide();
                $('#validation_content').html('');
                loadingOpen('.modal-content');
            },
            success: function(response) {
                loadingClose('.modal-content');
                if(response.status == 200) {
                    success();
                    notif('success', 'bg-success', response.message);
                } else if(response.status == 422) {
                    $('#validation_alert').show();
                    $('.modal-body').scrollTop(0);
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
                $('.modal-body').scrollTop(0);
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
                        url: '{{ url("working_hours/chart/destroy") }}',
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
                                $('#datatable_detail').DataTable().ajax.reload(null, false);
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
