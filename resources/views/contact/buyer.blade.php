<div class="content-inner">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-lg-inline">
            <div class="page-title d-flex">
                <h4>
                    <a href="{{ url()->previous() }}" class="text-dark"><i class="icon-arrow-left52 mr-2"></i></a>
                    <span class="font-weight-semibold">Buyer</span>
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
                        <div class="d-inline">
                            <button type="button" class="btn btn-teal ml-1" data-toggle="dropdown"><i class="icon-menu"></i></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ url('contact/buyer/bulk') }}" class="dropdown-item"><i class="icon-archive"></i> Bulk Upload</a>
                                <a href="{{ url('download/excel/buyer') }}" target="_blank" class="dropdown-item"><i class="icon-file-excel"></i> Export Excel</a>
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
                    <a href="javascript:void(0);" class="breadcrumb-item">Contact</a>
                    <span class="breadcrumb-item active">Buyer</span>
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
                            <th>#</th>
                            <th>No</th>
                            <th>ID</th>
                            <th>Company</th>
                            <th>Description</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Province</th>
                            <th>Country</th>
                            <th>Remark</th>
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
                            <a href="#tab_contact" class="nav-link rounded-top" data-toggle="tab">Contact</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab_general">
                            <div class="form-group">
                                <label>Company :<span class="text-danger">*</span></label>
                                <input type="text" name="company" id="company" class="form-control" placeholder="Enter company">
                            </div>
                            <div class="form-group">
                                <label>Description :</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Enter description" style="resize:none;"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Address :<span class="text-danger">*</span></label>
                                <textarea name="address" id="address" class="form-control" placeholder="Enter address" style="resize:none;"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Country :<span class="text-danger">*</span></label>
                                <select name="country_id" id="country_id" class="select2" onchange="getProvince()">
                                    <option value="">-- Choose --</option>
                                    @foreach($country as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Province :<span class="text-danger">*</span></label>
                                <select name="province_id" id="province_id" class="select2" onchange="getCity()"></select>
                            </div>
                            <div class="form-group">
                                <label>City :<span class="text-danger">*</span></label>
                                <select name="city_id" id="city_id" class="select2"></select>
                            </div>
                            <div class="form-group">
                                <label>Remark :<span class="text-danger">*</span></label>
                                <input type="text" name="remark" id="remark" class="form-control" placeholder="Enter remark">
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_contact">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name :<span class="text-danger">*</span></label>
                                                <input type="text" id="contact_name" class="form-control" placeholder="Enter name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Job Desc :<span class="text-danger">*</span></label>
                                                <select id="contact_job_desc" class="select2">
                                                    <option value="">-- Choose --</option>
                                                    @foreach($job_desc as $jd)
                                                        <option value="{{ $jd->id }};{{ $jd->name }}">{{ $jd->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Type :<span class="text-danger">*</span></label>
                                                <select id="contact_type" class="custom-select">
                                                    <option value="">-- Choose --</option>
                                                    <option value="1">Office</option>
                                                    <option value="2">HP</option>
                                                    <option value="3">Fax</option>
                                                    <option value="4">Email</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Value :<span class="text-danger">*</span></label>
                                                <input type="text" id="contact_value" class="form-control" placeholder="Enter value">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-0 text-right">
                                                <button type="button" onclick="addContact()" class="btn btn-success btn-sm"><i class="icon-plus2"></i> Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group"><hr></div>
                            <table class="table table-bordered w-100" id="datatable_contact">
                                <thead class="bg-light">
                                    <tr class="text-center">
                                        <th>Name</th>
                                        <th>Rank</th>
                                        <th>Type</th>
                                        <th>Value</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
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
        var table = loadDataTable();
        $('#datatable_contact').DataTable({
			scrollX: true,
            columnDefs: [
                {
                    targets: '_all',
                    className: 'text-center align-middle'
                }
            ]
		});

        $('#datatable_contact tbody').on('click', '#delete_data_contact', function() {
			$('#datatable_contact').DataTable().row($(this).parents('tr')).remove().draw();
		});

        $('a[data-toggle="tab"]').on('shown.bs.tab', function() {
			$('#datatable_contact').DataTable().columns.adjust();
		});

        $('#datatable_serverside tbody').on('click', 'td.details-control', function() {
			var tr    = $(this).closest('tr');
			var badge = tr.find('span > i');
			var icon  = tr.find('span > i');
			var row   = table.row(tr);

			if(row.child.isShown()) {
				row.child.hide();
				tr.removeClass('shown');
				badge.first().removeClass('text-danger');
				badge.first().addClass('text-success');
				icon.first().removeClass('icon-minus-circle2');
				icon.first().addClass('icon-plus-circle2');
			} else {
				row.child(rowDetail(row.data())).show();
				tr.addClass('shown');
				badge.first().removeClass('text-success');
				badge.first().addClass('text-danger');
				icon.first().removeClass('icon-plus-circle2');
				icon.first().addClass('icon-minus-circle2');
			}
		});
    });

    function rowDetail(data) {
		var content = '';

		$.ajax({
			url: '{{ url("contact/buyer/row_detail") }}',
			type: 'POST',
			async: false,
			data: {
				id: $(data[0]).data('id')
			},
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(response) {
				content += response;
			},
			error: function() {
				swalInit.fire({
                    title: 'Server Error',
                    text: 'Please contact developer',
                    icon: 'error'
                });
			}
		});

		return content;
	}

    function getProvince(id = null) {
        $.ajax({
            url: '{{ url("load_data/province") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                country_id: $('#country_id').val()
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                loadingOpen('.modal-content');
                $('#province_id').html('<option value="">-- Choose --</option>');
                $('#city_id').html('<option value="">-- Choose --</option>');
            },
            success: function(response) {
                loadingClose('.modal-content');
                if($('#country_id').val()) {
                    $.each(response, function(i, val) {
                        if(id == val.id) {
                            var selected = 'selected';
                        } else {
                            var selected = null;
                        }

                        $('#province_id').append(`
                            <option value="` + val.id + `" ` + selected + `>` + val.name + `</option>
                        `);
                    });
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

    function getCity(id = null) {
        $.ajax({
            url: '{{ url("load_data/city") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                province_id: $('#province_id').val()
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                loadingOpen('.modal-content');
                $('#city_id').html('<option value="">-- Choose --</option>');
            },
            success: function(response) {
                loadingClose('.modal-content');
                if($('#province_id').val()) {
                    $.each(response, function(i, val) {
                        if(id == val.id) {
                            var selected = 'selected';
                        } else {
                            var selected = null;
                        }

                        $('#city_id').append(`
                            <option value="` + val.id + `" ` + selected + `>` + val.name + `</option>
                        `);
                    });
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

    function addContact() {
        var contact_job_desc = $('#contact_job_desc').val();
        var contact_name     = $('#contact_name').val();
        var contact_value    = $('#contact_value').val();
        var contact_type     = $('#contact_type').val();

        if(contact_job_desc && contact_name && contact_type && contact_value) {
            var job_descable = contact_job_desc.split(';');
            if(contact_type == 1) {
                var type = 'Office';
            } else if(contact_type == 2) {
                var type = 'HP';
            } else if(contact_type == 3) {
                var type = 'Fax';
            } else if(contact_type == 4) {
                var type = 'Email';
            }

            $('#datatable_contact').DataTable().row.add([
                contact_name,
                job_descable[1],
                type,
                contact_value,
                `
                    <button type="button" class="btn btn-danger btn-sm" id="delete_data_contact"><i class="icon-trash-alt"></i></button>
                    <input type="hidden" name="contact[]" value="` + true + `">
                    <input type="hidden" name="contact_job_desc_id[]" value="` + job_descable[0] + `">
                    <input type="hidden" name="contact_name[]" value="` + contact_name + `">
                    <input type="hidden" name="contact_value[]" value="` + contact_value + `">
                    <input type="hidden" name="contact_type[]" value="` + contact_type + `">
                `
            ]).draw().node();

            $('#contact_job_desc').val(null).change();
            $('#contact_name').val(null);
            $('#contact_type').val(null);
            $('#contact_value').val(null);
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
        $('#country_id').val(null).change();
        $('#province_id').html('<option value="">-- Choose --</option>');
        $('#city_id').html('<option value="">-- Choose --</option>');
        $('#datatable_contact').DataTable().clear().draw();
        $('input[name="status"][value="1"]').prop('checked', true);
        $('#validation_alert').hide();
        $('#validation_content').html('');
    }

    function success() {
        reset();
        $('#modal_form').modal('hide');
        $('#datatable_serverside').DataTable().ajax.reload(null, false);
    }

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
                url: '{{ url("contact/buyer/datatable") }}',
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
                { name: 'row_detail', orderable: false, searchable: false, className: 'text-center align-middle details-control' },
                { name: 'no', orderable: false, searchable: false, className: 'text-center align-middle' },
                { name: 'id', searchable: false, className: 'text-center align-middle' },
                { name: 'company', className: 'text-center align-middle' },
                { name: 'description', className: 'text-center align-middle' },
                { name: 'address', className: 'text-center align-middle' },
                { name: 'city_id', className: 'text-center align-middle' },
                { name: 'province_id', className: 'text-center align-middle' },
                { name: 'country_id', className: 'text-center align-middle' },
                { name: 'remark', className: 'text-center align-middle' },
                { name: 'status', searchable: false, className: 'text-center align-middle' },
                { name: 'updated_by', className: 'text-center align-middle' },
                { name: 'created_at', searchable: false, className: 'text-center align-middle' },
                { name: 'action', orderable: false, searchable: false, className: 'text-center align-middle' }
            ]
        });
    }

    function create() {
        $.ajax({
            url: '{{ url("contact/buyer/create") }}',
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
            url: '{{ url("contact/buyer/show") }}',
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
                $('#country_id').val(response.country_id).change();
                getProvince(response.province_id);
                getCity(response.city_id);
                $('#company').val(response.company);
                $('#description').val(response.description);
                $('#remark').val(response.remark);
                $('#address').val(response.address);
                $('input[name="status"][value="' + response.status + '"]').prop('checked', true);
                $('#btn_update').attr('onclick', 'update(' + id + ')');

                $.each(response.contact, function(i, val) {
                    $('#datatable_contact').DataTable().row.add([
                        val.name,
                        val.job_desc_name,
                        val.type_name,
                        val.value,
                        `
                            <button type="button" class="btn btn-danger btn-sm" id="delete_data_contact"><i class="icon-trash-alt"></i></button>
                            <input type="hidden" name="contact[]" value="` + true + `">
                            <input type="hidden" name="contact_job_desc_id[]" value="` + val.job_desc_id + `">
                            <input type="hidden" name="contact_name[]" value="` + val.name + `">
                            <input type="hidden" name="contact_value[]" value="` + val.value + `">
                            <input type="hidden" name="contact_type[]" value="` + val.type + `">
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
            url: '{{ url("contact/buyer/update") }}' + '/' + id,
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

    function changeStatus(id, value) {
        $.ajax({
            url: '{{ url("contact/buyer/change_status") }}',
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
                    success();
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
                        url: '{{ url("contact/buyer/destroy") }}',
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
