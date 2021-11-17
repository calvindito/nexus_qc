<div class="content-inner">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-lg-inline">
            <div class="page-title d-flex">
                <h4>
                    <a href="{{ url()->previous() }}" class="text-dark"><i class="icon-arrow-left52 mr-2"></i></a>
                    <span class="font-weight-semibold">Sub Group</span>
                </h4>
            </div>
            <div class="header-elements">
                <div class="d-flex justify-content-center">
                    <div class="form-group">
                        <button type="button" class="btn btn-teal btn-labeled btn-labeled-left" onclick="loadDataTable()">
                            <b><i class="icon-sync"></i></b> Refresh
                        </button>
                        <button type="button" class="btn btn-teal btn-labeled btn-labeled-left" onclick="openModal()" data-toggle="modal" data-target="#modal_form">
                            <b><i class="icon-plus-circle2"></i></b> Add
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-teal" data-toggle="dropdown"><i class="icon-menu"></i></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ url('download/pdf/sub_group_defect') }}" target="_blank" class="dropdown-item"><i class="icon-printer"></i> Print</a>
                                <a href="javascript:void(0);" onclick="location.href='{{ url('download/excel/sub_group_defect') }}'" class="dropdown-item"><i class="icon-file-excel"></i> Export Excel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ url('dashboard') }}" class="breadcrumb-item">Dashboard</a>
                    <a href="javascript:void(0);" class="breadcrumb-item">Group Defect</a>
                    <span class="breadcrumb-item active">Sub Group</span>
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
                            <th>ID</th>
                            <th>Group</th>
                            <th>Code</th>
                            <th>Sub Group</th>
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
                    <div class="alert alert-danger" id="validation_alert" style="display:none;">
                        <ul id="validation_content" class="mb-0"></ul>
                    </div>
                    <div class="form-group">
                        <label>Group :<span class="text-danger">*</span></label>
                        <div class="row">
                            <div class="col-md-9">
                                <select name="parent_id" id="parent_id" class="select2">
                                    <option value="">-- Choose --</option>
                                    @foreach($parent as $p)
                                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-light col-12" onclick="showAddNew()"><i class="icon-plus2"></i> Add New</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Sub Group :<span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label>Code :<span class="text-danger">*</span></label>
                        <input type="text" name="code" id="code" class="form-control" placeholder="Enter code">
                    </div>
                    <div class="form-group text-center mt-4">
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
                </form>
            </div>
            <div class="modal-footer bg-light">
                <div class="form-group">
                    <button type="button" class="btn btn-danger" id="btn_cancel" onclick="openModal()" style="display:none;"><i class="icon-cross3"></i> Cancel</button>
                    <button type="button" class="btn btn-warning" id="btn_update" onclick="update()" style="display:none;"><i class="icon-pencil7"></i> Save</button>
                    <button type="button" class="btn btn-primary" id="btn_create" onclick="create()"><i class="icon-plus3"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_add_new" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">Add New Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_data" autocomplete="off">
                    <div class="alert alert-danger" id="validation_alert" style="display:none;">
                        <ul id="validation_content" class="mb-0"></ul>
                    </div>
                    <input type="hidden" name="status" value="1">
                    <div class="form-group">
                        <label>Group :<span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label>Code :<span class="text-danger">*</span></label>
                        <input type="text" name="code" id="code" class="form-control" placeholder="Enter code">
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <div class="form-group">
                    <button type="button" class="btn btn-danger" onclick="showForm()"><i class="icon-arrow-left5"></i> Back to Form</button>
                    <button type="button" class="btn btn-primary" onclick="createNewGroup()"><i class="icon-plus3"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        loadDataTable();
    });

    function showAddNew() {
        $('#modal_form').modal('hide');
        $('#modal_add_new').modal('show');
        $('#modal_add_new #form_data').trigger('reset');
    }

    function showForm() {
        $('#modal_form').modal('show');
        $('#modal_add_new').modal('hide');
    }

    function createNewGroup() {
        $.ajax({
            url: '{{ url("group_defect/group/create") }}',
            type: 'POST',
            dataType: 'JSON',
            data: $('#modal_add_new #form_data').serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#modal_add_new #validation_alert').hide();
                $('#modal_add_new #validation_content').html('');
                loadingOpen('#modal_add_new .modal-content');
            },
            success: function(response) {
                loadingClose('#modal_add_new .modal-content');
                if(response.status == 200) {
                    $('#modal_form #parent_id').append('<option value="' + response.data.id + '">' + response.data.name + '</option>');
                    notif('success', 'bg-success', response.message);
                    $('#modal_add_new').modal('hide');
                    $('#modal_form').modal('show');
                } else if(response.status == 422) {
                    $('#modal_add_new #validation_alert').show();
                    $('#modal_add_new .modal-body').scrollTop(0);
                    notif('warning', 'bg-warning', 'Please check the form');

                    $.each(response.error, function(i, val) {
                        $.each(val, function(i, val) {
                            $('#modal_add_new #validation_content').append(`
                                <li>` + val + `</li>
                            `);
                        });
                    });
                } else {
                    notif('error', 'bg-danger', response.message);
                }
            },
            error: function() {
                $('#modal_add_new .modal-body').scrollTop(0);
                loadingClose('#modal_add_new .modal-content');
                swalInit.fire({
                    title: 'Server Error',
                    text: 'Please contact developer',
                    icon: 'error'
                });
            }
        });
    }

    function openModal() {
        reset();
        $('#modal_form #btn_create').show();
        $('#modal_form #btn_update').hide();
        $('#modal_form #btn_cancel').hide();
    }

    function cancel() {
        reset();
        $('#modal_form').modal('hide');
        $('#modal_form #btn_create').show();
        $('#modal_form #btn_update').hide();
        $('#modal_form #btn_cancel').hide();
    }

    function toShow() {
        reset();
        $('#modal_form').modal('show');
        $('#modal_form #validation_alert').hide();
        $('#modal_form #validation_content').html('');
        $('#modal_form #btn_create').hide();
        $('#modal_form #btn_update').show();
        $('#modal_form #btn_cancel').show();
    }

    function reset() {
        $('#modal_form #form_data').trigger('reset');
        $('#modal_form #parent_id').val(null).change();
        $('#modal_form input[name="status"][value="1"]').prop('checked', true);
        $('#modal_form #validation_alert').hide();
        $('#modal_form #validation_content').html('');
    }

    function success() {
        reset();
        $('#modal_form').modal('hide');
        $('#datatable_serverside').DataTable().ajax.reload(null, false);
    }

    function loadDataTable() {
        $('#datatable_serverside').DataTable({
            dom: '<"datatable-header"fB><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            serverSide: true,
            deferRender: true,
            stateSave: true,
            destroy: true,
            scrollX: true,
            iDisplayInLength: 10,
            order: [[0, 'asc']],
            ajax: {
                url: '{{ url("group_defect/sub_group/datatable") }}',
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
                { name: 'parent_id', searchable: false, className: 'text-center align-middle' },
                { name: 'code', className: 'text-center align-middle' },
                { name: 'name', className: 'text-center align-middle' },
                { name: 'status', searchable: false, className: 'text-center align-middle' },
                { name: 'updated_by', className: 'text-center align-middle' },
                { name: 'created_at', searchable: false, className: 'text-center align-middle' },
                { name: 'action', searchable: false, orderable: false, className: 'text-center nowrap align-middle' }
            ]
        });
    }

    function create() {
        $.ajax({
            url: '{{ url("group_defect/sub_group/create") }}',
            type: 'POST',
            dataType: 'JSON',
            data: $('#modal_form #form_data').serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#modal_form #validation_alert').hide();
                $('#modal_form #validation_content').html('');
                loadingOpen('#modal_form .modal-content');
            },
            success: function(response) {
                loadingClose('#modal_form .modal-content');
                if(response.status == 200) {
                    success();
                    notif('success', 'bg-success', response.message);
                } else if(response.status == 422) {
                    $('#modal_form #validation_alert').show();
                    $('#modal_form .modal-body').scrollTop(0);
                    notif('warning', 'bg-warning', 'Please check the form');

                    $.each(response.error, function(i, val) {
                        $.each(val, function(i, val) {
                            $('#modal_form #validation_content').append(`
                                <li>` + val + `</li>
                            `);
                        });
                    });
                } else {
                    notif('error', 'bg-danger', response.message);
                }
            },
            error: function() {
                $('#modal_form .modal-body').scrollTop(0);
                loadingClose('#modal_form .modal-content');
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
            url: '{{ url("group_defect/sub_group/show") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                loadingOpen('#modal_form .modal-content');
            },
            success: function(response) {
                loadingClose('#modal_form .modal-content');
                $('#modal_form #code').val(response.code);
                $('#modal_form #name').val(response.name);
                $('#modal_form #parent_id').val(response.parent_id).change();
                $('#modal_form input[name="status"][value="' + response.status + '"]').prop('checked', true);
                $('#modal_form #btn_update').attr('onclick', 'update(' + id + ')');
            },
            error: function() {
                cancel();
                loadingClose('#modal_form .modal-content');
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
            url: '{{ url("group_defect/sub_group/update") }}' + '/' + id,
            type: 'POST',
            dataType: 'JSON',
            data: $('#modal_form #form_data').serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#modal_form #validation_alert').hide();
                $('#modal_form #validation_content').html('');
                loadingOpen('#modal_form .modal-content');
            },
            success: function(response) {
                loadingClose('#modal_form .modal-content');
                if(response.status == 200) {
                    success();
                    notif('success', 'bg-success', response.message);
                } else if(response.status == 422) {
                    $('#modal_form #validation_alert').show();
                    $('#modal_form .modal-body').scrollTop(0);
                    notif('warning', 'bg-warning', 'Please check the form');

                    $.each(response.error, function(i, val) {
                        $.each(val, function(i, val) {
                            $('#modal_form #validation_content').append(`
                                <li>` + val + `</li>
                            `);
                        });
                    });
                } else {
                    notif('error', 'bg-danger', response.message);
                }
            },
            error: function() {
                $('#modal_form .modal-body').scrollTop(0);
                loadingClose('#modal_form .modal-content');
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
            url: '{{ url("group_defect/sub_group/change_status") }}',
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
                loadingOpen('#modal_form .modal-content');
            },
            success: function(response) {
                loadingClose('#modal_form .modal-content');
                if(response.status == 200) {
                    success();
                    notif('success', 'bg-success', response.message);
                } else {
                    notif('error', 'bg-danger', response.message);
                }
            },
            error: function() {
                loadingClose('#modal_form .modal-content');
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
                        url: '{{ url("group_defect/sub_group/destroy") }}',
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
