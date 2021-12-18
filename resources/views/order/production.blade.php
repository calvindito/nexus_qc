<div class="content-inner">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-lg-inline">
            <div class="page-title d-flex">
                <h4>
                    <a href="{{ url()->previous() }}" class="text-dark"><i class="icon-arrow-left52 mr-2"></i></a>
                    <span class="font-weight-semibold">Production</span>
                </h4>
            </div>
            <div class="header-elements">
                <div class="d-flex justify-content-center">
                    <div class="form-group">
                        <button type="button" class="btn btn-teal btn-labeled btn-labeled-left ml-1" onclick="loadDataTable()">
                            <b><i class="icon-sync"></i></b> Refresh
                        </button>
                        <button type="button" class="btn btn-teal btn-labeled btn-labeled-left ml-1" onclick="openModal()" data-toggle="modal" data-target="#modal_form">
                            <b><i class="icon-plus-circle2"></i></b> Add
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ url('dashboard') }}" class="breadcrumb-item">Dashboard</a>
                    <a href="javascript:void(0);" class="breadcrumb-item">Order</a>
                    <span class="breadcrumb-item active">Production</span>
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
                            <th>No</th>
                            <th>ID</th>
                            <th>No Production</th>
                            <th>No Job Order</th>
                            <th>No Buyer</th>
                            <th>Buyer</th>
                            <th>Brand</th>
                            <th>Delivery Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

<div class="modal fade" id="modal_form" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
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
                    <ul class="nav nav-tabs nav-justified">
                        <li class="nav-item">
                            <a href="#tab_general" class="nav-link rounded-top active" data-toggle="tab">General</a>
                        </li>
                        <li class="nav-item">
                            <a href="#tab_detail" class="nav-link rounded-top" data-toggle="tab">Detail</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab_general">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>No Production :<span class="text-danger">*</span></label>
                                        <input type="text" id="code_production" class="form-control" placeholder="Auto Generate" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>No Job Order :<span class="text-danger">*</span></label>
                                        <input type="text" name="code_job_order" id="code_job_order" class="form-control" placeholder="Enter no job order">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>No Buyer :<span class="text-danger">*</span></label>
                                        <input type="text" name="code_buyer" id="code_buyer" class="form-control" placeholder="Enter no buyer">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Buyer :<span class="text-danger">*</span></label>
                                        <select name="buyer_id" id="buyer_id" class="select2">
                                            <option value="">-- Choose --</option>
                                            @foreach($buyer as $b)
                                                <option value="{{ $b->id }}">{{ $b->company }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Style :<span class="text-danger">*</span></label>
                                        <select name="style_id" id="style_id" class="select2" onchange="$('#detail_data').html('');">
                                            <option value="">-- Choose --</option>
                                            @foreach($style as $s)
                                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Destination :<span class="text-danger">*</span></label>
                                        <select name="city_id" id="city_id" class="select2">
                                            <option value="">-- Choose --</option>
                                            @foreach($city as $c)
                                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Delivery Date :<span class="text-danger">*</span></label>
                                        <input type="date" name="delivery_date" id="delivery_date" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_detail">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger col-12" onclick="$('#detail_data').html('')">Remove All</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success col-12" onclick="addNewDetail()">Add New Data</button>
                                    </div>
                                </div>
                            </div>
                            <div id="detail_data" style="height:232px; overflow-y:auto; overflow-x:hidden;"></div>
                        </div>
                    </div>
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
        loadDataTable();

        $('#detail_data').on('click', '.remove', function() {
            $(this).parent().parent().parent().remove();
        });
    });

    function addNewDetail() {
        var random_selector = random(5, 'alpha');
        var style_id        = $('#style_id').val();

        if(style_id) {
            $('#detail_data').append(`
                <div class="row p-1">
                    <input type="hidden" name="detail[]" value="` + true + `">
                    <div class="col-md-4">
                        <div class="form-group mb-0">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">Color</span>
                                </div>
                                <select name="detail_color_id[]" class="form-control">
                                    @foreach($color as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-0">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">Size</span>
                                </div>
                                <select name="detail_size_detail_id[]" id="` + random_selector + `" class="form-control"></select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-0">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">Qty</span>
                                </div>
                                <input type="number" name="detail_qty[]" class="form-control" min="1" value="1" placeholder="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group mb-0">
                            <button type="button" class="btn bg-transparent text-danger border-danger col-12 remove"><i class="icon-cross"></i></button>
                        </div>
                    </div>
                </div>
            `);
        } else {
            swalInit.fire({
                title: 'Ooppss',
                text: 'Please select a style first',
                icon: 'info'
            });
        }

        getSize('' + random_selector + '');
    }

    function getSize(param, id = '') {
        $.ajax({
            url: '{{ url("order/production/get_size") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: $('#style_id').val()
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                loadingOpen('.modal-content');
                $('#' + param).html('');
            },
            success: function(response) {
                loadingClose('.modal-content');
                $.each(response, function(i, val) {
                    if(id) {
                        var selected = id == val.id ? 'selected' : '';
                    } else {
                        var selected = '';
                    }

                    $('#' + param).append(`<option value="` + val.id + `" ` + selected + `>` + val.value + `</option>`);
                });
            },
            error: function() {
                loadingClose('.modal-content');
                loadDataTable();
            }
        });
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
        $('#detail_data').html('');
        $('.nav-tabs > li.nav-item > a.nav-link').removeClass('active');
        $('.nav-tabs > li.nav-item > a[href="#tab_general"]').addClass('active');
        $('.tab-pane').removeClass('show active');
        $('.tab-pane#tab_general').addClass('show active');
        $('#form_data').trigger('reset');
        $('#buyer_id').val(null).change();
        $('#style_id').val(null).change();
        $('#city_id').val(null).change();
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
            dom: '<"datatable-header"fB><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            serverSide: true,
            deferRender: true,
            stateSave: true,
            destroy: true,
            scrollX: true,
            iDisplayInLength: 10,
            order: [[1, 'asc']],
            ajax: {
                url: '{{ url("order/production/datatable") }}',
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
                { name: 'no', orderable: false, searchable: false, className: 'text-center align-middle' },
                { name: 'id', searchable: false, className: 'text-center align-middle' },
                { name: 'code_production', className: 'text-center align-middle' },
                { name: 'code_job_order', className: 'text-center align-middle' },
                { name: 'code_buyer', className: 'text-center align-middle' },
                { name: 'buyer_id', className: 'text-center align-middle' },
                { name: 'brand_id', orderable: false, className: 'text-center align-middle' },
                { name: 'delivery_date', searchable: false, className: 'text-center align-middle' },
                { name: 'action', orderable: false, searchable: false, className: 'text-center align-middle' }
            ]
        });
    }

    function create() {
        $.ajax({
            url: '{{ url("order/production/create") }}',
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
            url: '{{ url("order/production/show") }}',
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
                $('#buyer_id').val(response.buyer_id).change();
                $('#style_id').val(response.style_id).change();
                $('#city_id').val(response.city_id).change();
                $('#code_production').val(response.code_production);
                $('#code_job_order').val(response.code_job_order);
                $('#code_buyer').val(response.code_buyer);
                $('#delivery_date').val(response.delivery_date);
                $('#btn_update').attr('onclick', 'update(' + id + ')');

                $.each(response.detail, function(i, val) {
                    var random_selector = random(5, 'alpha');
                    $('#detail_data').append(`
                        <div class="row p-1">
                            <input type="hidden" name="detail[]" value="` + true + `">
                            <div class="col-md-4">
                                <div class="form-group mb-0">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Color</span>
                                        </div>
                                        <select name="detail_color_id[]" id="` + random_selector + `_color" class="form-control">
                                            @foreach($color as $c)
                                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-0">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Size</span>
                                        </div>
                                        <select name="detail_size_detail_id[]" id="` + random_selector + `" class="form-control"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-0">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Qty</span>
                                        </div>
                                        <input type="number" name="detail_qty[]" class="form-control" min="1" value="` + val.qty + `" placeholder="0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group mb-0">
                                    <button type="button" class="btn bg-transparent text-danger border-danger col-12 remove"><i class="icon-cross"></i></button>
                                </div>
                            </div>
                        </div>
                    `);

                    getSize('' + random_selector + '', val.size_detail_id);
                    $('#' + random_selector + '_color').val(val.color_id);
                });
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
            url: '{{ url("order/production/update") }}' + '/' + id,
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
                        url: '{{ url("order/production/destroy") }}',
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
