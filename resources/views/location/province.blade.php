<div class="content-inner">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-lg-inline">
            <div class="page-title d-flex">
                <h4>
                    <a href="{{ url()->previous() }}" class="text-dark"><i class="icon-arrow-left52 mr-2"></i></a>
                    <span class="font-weight-semibold">Province</span>
                </h4>
                <a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements">
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-teal btn-labeled btn-labeled-left mr-1" onclick="loadDataTable()">
                        <b><i class="icon-sync"></i></b> Refresh
                    </button>
                    <button type="button" class="btn btn-teal btn-labeled btn-labeled-left" onclick="openModal()" data-toggle="modal" data-target="#modal_form">
                        <b><i class="icon-plus-circle2"></i></b> Add
                    </button>
                </div>
            </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ url('dashboard') }}" class="breadcrumb-item">Dashboard</a>
                    <a href="javascript:void(0);" class="breadcrumb-item">Location</a>
                    <span class="breadcrumb-item active">Province</span>
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
                            <th>Country</th>
                            <th>Province</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
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
                        <label>Country :<span class="text-danger">*</span></label>
                        <select name="country_id" id="country_id" class="select2">
                            <option value="">-- Choose --</option>
                            @foreach($country as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Province :<span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label>Latitude :</label>
                        <input type="text" name="latitude" id="latitude" class="form-control" placeholder="Enter latitude">
                    </div>
                    <div class="form-group">
                        <label>Longitude :</label>
                        <input type="text" name="longitude" id="longitude" class="form-control" placeholder="Enter longitude">
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

<script>
    $(function() {
        loadDataTable();
    });

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
        $('#form_data').trigger('reset');
        $('#country_id').val(null).change();
        $('#validation_alert').hide();
        $('#validation_content').html('');
    }

    function success() {
        reset();
        $('#modal_form').modal('hide');
        $('#datatable_serverside').DataTable().ajax.reload(null, false);
    }

    function loadDataTable() {
        $('#datatable_serverside').DataTable({
            serverSide: true,
            processing: true,
            deferRender: true,
            destroy: true,
            scrollX: true,
            iDisplayInLength: 10,
            order: [[0, 'asc']],
            ajax: {
                url: '{{ url("location/province/datatable") }}',
                type: 'GET',
                error: function() {
                    swalInit.fire({
                        title: 'Server Error',
                        text: 'Please contact developer',
                        icon: 'error'
                    });
                }
            },
            columns: [
                { name: 'id', searchable: false, className: 'text-center align-middle' },
                { name: 'country_id', className: 'text-center align-middle' },
                { name: 'name', className: 'text-center align-middle' },
                { name: 'latitude', className: 'text-center align-middle' },
                { name: 'longitude', className: 'text-center align-middle' },
                { name: 'action', searchable: false, orderable: false, className: 'text-center nowrap align-middle' }
            ]
        });
    }

    function create() {
        $.ajax({
            url: '{{ url("location/province/create") }}',
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
            url: '{{ url("location/province/show") }}',
            type: 'GET',
            dataType: 'JSON',
            data: {
                id: id
            },
            beforeSend: function() {
                loadingOpen('.modal-content');
            },
            success: function(response) {
                loadingClose('.modal-content');
                $('#country_id').val(response.country_id).change();
                $('#name').val(response.name);
                $('#latitude').val(response.latitude);
                $('#longitude').val(response.longitude);
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
            url: '{{ url("location/province/update") }}' + '/' + id,
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
                        url: '{{ url("location/province/destroy") }}',
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
                                type: 'error'
                            });
                        }
                    });
                })
            ]
        }).show();
    }
</script>
