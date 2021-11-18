<div class="content-inner">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-lg-inline">
            <div class="page-title d-flex">
                <h4>
                    <a href="{{ url()->previous() }}" class="text-dark"><i class="icon-arrow-left52 mr-2"></i></a>
                    <span class="font-weight-semibold">SO Production</span>
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
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ url('dashboard') }}" class="breadcrumb-item">Dashboard</a>
                    <a href="javascript:void(0);" class="breadcrumb-item">Production Order</a>
                    <span class="breadcrumb-item active">SO Production</span>
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
                            <th>Code</th>
                            <th>Buyer</th>
                            <th>Brand</th>
                            <th>Product Class</th>
                            <th>Style Code</th>
                            <th>Style Name</th>
                            <th>Destination</th>
                            <th>Delivery Date</th>
                            <th>Price</th>
                            <th>Tax</th>
                            <th>Subtotal</th>
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
                            <div class="form-group">
                                <label>No SO :<span class="text-danger">*</span></label>
                                <input type="text" name="code" id="code" class="form-control" placeholder="Enter no">
                            </div>
                            <div class="form-group">
                                <label>Buyer :<span class="text-danger">*</span></label>
                                <select name="buyer_id" id="buyer_id" class="select2">
                                    <option value="">-- Choose --</option>
                                    @foreach($buyer as $b)
                                        <option value="{{ $b->id }}">{{ $b->company }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Style :<span class="text-danger">*</span></label>
                                        <select name="style_id" id="style_id" class="select2" onchange="getSize()">
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Price :<span class="text-danger">*</span></label>
                                        <input type="number" name="price" id="price" class="form-control" placeholder="Enter price">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tax :</label>
                                        <div class="form-group-feedback form-group-feedback-right">
                                            <input type="number" name="tax" id="tax" class="form-control" placeholder="Enter tax">
                                            <div class="form-control-feedback"><b>%</b></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Delivery Date :<span class="text-danger">*</span></label>
                                        <input type="date" name="delivery_date" id="delivery_date" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_detail">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Color :<span class="text-danger">*</span></label>
                                                <select id="detail_color_id" class="select2">
                                                    <option value="">-- Choose --</option>
                                                    @foreach($color as $c)
                                                        <option value="{{ $c->id }};{{ $c->name }}">{{ $c->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Size :<span class="text-danger">*</span></label>
                                                <select id="detail_size_detail_id" class="select2">
                                                    <option value="">-- Choose --</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Qty :<span class="text-danger">*</span></label>
                                                <input type="number" id="detail_qty" class="form-control" placeholder="Enter qty">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0 text-right">
                                        <label class="text-white">.</label>
                                        <button type="button" onclick="addDetail()" class="btn btn-success btn-sm"><i class="icon-plus2"></i> Add</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group"><hr></div>
                            <table class="table table-bordered w-100" id="datatable_detail">
                                <thead class="bg-light">
                                    <tr class="text-center">
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Qty</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                            </table>
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

<script>
    $(function() {
        loadDataTable();
        $('#datatable_detail').DataTable({
			scrollX: true,
            columnDefs: [
                {
                    targets: '_all',
                    className: 'text-center align-middle'
                }
            ]
		});

        $('#datatable_detail tbody').on('click', '#delete_data_detail', function() {
			$('#datatable_detail').DataTable().row($(this).parents('tr')).remove().draw();
		});

        $('a[data-toggle="tab"]').on('shown.bs.tab', function() {
			$('#datatable_detail').DataTable().columns.adjust();
		});
    });

    function getSize() {
        $.ajax({
            url: '{{ url("production_order/so_production/get_size") }}',
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
                $('#detail_size_detail_id').html('<option value="">-- Choose --</option>');
            },
            success: function(response) {
                loadingClose('.modal-content');
                $.each(response, function(i, val) {
                    $('#detail_size_detail_id').append(`
                        <option value="` + val.id + `;` + val.value + `">` + val.value + `</option>
                    `);
                });
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

    function addDetail() {
        var detail_color_id       = $('#detail_color_id').val();
        var detail_size_detail_id = $('#detail_size_detail_id').val();
        var detail_qty            = $('#detail_qty').val();

        if(detail_color_id && detail_size_detail_id && detail_qty) {
            var colorable = detail_color_id.split(';');
            var sizeable  = detail_size_detail_id.split(';');

            $('#datatable_detail').DataTable().row.add([
                colorable[1],
                sizeable[1],
                detail_qty,
                `
                    <button type="button" class="btn btn-danger btn-sm" id="delete_data_detail"><i class="icon-trash-alt"></i></button>
                    <input type="hidden" name="detail[]" value="` + true + `">
                    <input type="hidden" name="detail_color_id[]" value="` + colorable[0] + `">
                    <input type="hidden" name="detail_size_detail_id[]" value="` + sizeable[0] + `">
                    <input type="hidden" name="detail_qty[]" value="` + detail_qty + `">
                `
            ]).draw().node();

            $('#detail_color_id').val(null).change();
            $('#detail_size_detail_id').val(null).change();
            $('#detail_qty').val(null);
        } else {
            swalInit.fire('Ooppss', 'Please fill in all input', 'warning');
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
        $('.nav-tabs > li.nav-item > a.nav-link').removeClass('active');
        $('.nav-tabs > li.nav-item > a[href="#tab_general"]').addClass('active');
        $('.tab-pane').removeClass('show active');
        $('.tab-pane#tab_general').addClass('show active');
        $('#form_data').trigger('reset');
        $('#buyer_id').val(null).change();
        $('#style_id').val(null).change();
        $('#city_id').val(null).change();
        $('#datatable_detail').DataTable().clear().draw();
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
            order: [[0, 'asc']],
            ajax: {
                url: '{{ url("production_order/so_production/datatable") }}',
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
                { name: 'code', className: 'text-center align-middle' },
                { name: 'buyer_id', className: 'text-center align-middle' },
                { name: 'brand_id', orderable: false, className: 'text-center align-middle' },
                { name: 'product_class_id', orderable: false, className: 'text-center align-middle' },
                { name: 'style_code', orderable: false, className: 'text-center align-middle' },
                { name: 'style_id', className: 'text-center align-middle' },
                { name: 'city_id', className: 'text-center align-middle' },
                { name: 'delivery_date', searchable: false, className: 'text-center align-middle' },
                { name: 'price', searchable: false, className: 'text-center align-middle' },
                { name: 'tax', searchable: false, className: 'text-center align-middle' },
                { name: 'subtotal', orderable: false, searchable: false, className: 'text-center align-middle' },
                { name: 'action', orderable: false, searchable: false, className: 'text-center align-middle' }
            ]
        });
    }

    function create() {
        $.ajax({
            url: '{{ url("production_order/so_production/create") }}',
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
            url: '{{ url("production_order/so_production/show") }}',
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
                $('#code').val(response.code);
                $('#price').val(response.price);
                $('#tax').val(response.tax);
                $('#delivery_date').val(response.delivery_date);
                $('#btn_update').attr('onclick', 'update(' + id + ')');

                $.each(response.detail, function(i, val) {
                    $('#datatable_detail').DataTable().row.add([
                        val.color_name,
                        val.size_detail_value,
                        val.qty,
                        `
                            <button type="button" class="btn btn-danger btn-sm" id="delete_data_detail"><i class="icon-trash-alt"></i></button>
                            <input type="hidden" name="detail[]" value="` + true + `">
                            <input type="hidden" name="detail_color_id[]" value="` + val.color_id + `">
                            <input type="hidden" name="detail_size_detail_id[]" value="` + val.size_detail_id + `">
                            <input type="hidden" name="detail_qty[]" value="` + val.qty + `">
                        `
                    ]).draw().node();
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
            url: '{{ url("production_order/so_production/update") }}' + '/' + id,
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
                        url: '{{ url("production_order/so_production/destroy") }}',
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
