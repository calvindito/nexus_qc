<div class="content-inner">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-lg-inline">
            <div class="page-title d-flex">
                <h4>
                    <a href="{{ url()->previous() }}" class="text-dark"><i class="icon-arrow-left52 mr-2"></i></a>
                    <span class="font-weight-semibold">Manage Product</span>
                </h4>
            </div>
            <div class="header-elements">
                <div class="d-flex justify-content-center">
                    <div class="form-group">
                        <button type="button" class="btn btn-teal btn-labeled btn-labeled-left" onclick="loadDataTable()" data-toggle="modal" data-target="#modal_type_product">
                            <b><i class="icon-list2"></i></b> Choice
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ url('dashboard') }}" class="breadcrumb-item">Dashboard</a>
                    <a href="javascript:void(0);" class="breadcrumb-item">Product</a>
                    <span class="breadcrumb-item active">Manage</span>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div id="no_choose">
            <div class="alert bg-info text-white text-center">
                <span class="font-weight-bold text-uppercase">Attention!</span><br>
                Please select a product by clicking the <b class="font-italic">"Choice"</b> button to display detailed product data.
            </div>
        </div>
        <div id="is_choose" style="display:none;">
            <div class="card">
                <div class="card-body">
                    <input type="hidden" id="product_type_id">
                    <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                        <li class="nav-item">
                            <a href="#justified-left-icon-data-type-product" class="nav-link active" data-toggle="tab">
                                <i class="icon-info22 mr-2"></i> Data Type Product
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#justified-left-check-point" class="nav-link" data-toggle="tab">
                                <i class="icon-stack-check mr-2"></i> Check Point
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#justified-left-defect" class="nav-link" data-toggle="tab">
                                <i class="icon-ungroup mr-2"></i> Defect
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="justified-left-icon-data-type-product">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Type Product :</label>
                                        <div class="form-control-plaintext" id="type_product"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Class Product :</label>
                                        <div class="form-control-plaintext" id="class_product"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Gender :</label>
                                        <div class="form-control-plaintext" id="gender"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Group Size :</label>
                                        <div class="form-control-plaintext" id="group_size"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Smv Global :</label>
                                        <div class="form-control-plaintext" id="smv_global"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Created By :</label>
                                        <div class="form-control-plaintext" id="created_by"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Modified By :</label>
                                        <div class="form-control-plaintext" id="modified_by"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Date Created :</label>
                                        <div class="form-control-plaintext" id="date_created"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Last Modified Date :</label>
                                        <div class="form-control-plaintext" id="last_modified_date"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Status :</label>
                                        <div class="form-control-plaintext" id="status"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="justified-left-check-point">
                            <form id="form_check_point">
                                <div class="form-group">
                                    <select name="check_point_id[]" id="check_point_id" multiple="multiple" class="form-control listbox" data-fouc></select>
                                </div>
                                <div class="form-group"><hr></div>
                                <div class="form-group">
                                    <div class="text-right">
                                        <button type="button" class="btn btn-success" onclick="submitable('check_point')"><i class="icon-floppy-disk"></i> Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="justified-left-defect">
                            <form id="form_defect">
                                <table class="table w-100" id="datatable_defect">
                                    <thead class="bg-light">
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Code</th>
                                            <th>Check Point</th>
                                            <th>Defect</th>
                                        </tr>
                                    </thead>
                                </table>
                                <div class="form-group"><hr></div>
                                <div class="form-group">
                                    <div class="text-right">
                                        <button type="button" class="btn btn-success" onclick="submitable('defect')"><i class="icon-floppy-disk"></i> Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="modal_type_product" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">List Type Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table display nowrap w-100" id="datatable_serverside">
                    <thead class="bg-light">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Class Product</th>
                            <th>Gender</th>
                            <th>Type Product</th>
                            <th><i class="icon-list2"></i></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#datatable_defect').DataTable({
            scrollX: true,
            columnDefs: [
                {
                    targets: '_all',
                    className: 'text-center align-middle'
                }
            ]
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function() {
			$('#datatable_defect').DataTable().columns.adjust();
		});
    });

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
                url: '{{ url("product/manage/datatable") }}',
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
                { name: 'product_class_id', className: 'text-center align-middle' },
                { name: 'gender_id', className: 'text-center align-middle' },
                { name: 'name', className: 'text-center align-middle' },
                { name: 'action', orderable: false, searchable: false, className: 'text-center align-middle tbody-action' }
            ]
        });
    }

    function chooseProduct(id) {
        $('#modal_type_product').modal('hide');
        $('#no_choose').hide();
        $('#is_choose').fadeIn(500);
        $('#product_type_id').val(id);
        loadContent(id);
    }

    function loadContent(id) {
        $.ajax({
            url: '{{ url("product/manage/load_content") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                loadingOpen('.content');
                $('#check_point_id').html('');
                $('#datatable_defect').DataTable().clear().draw();
            },
            success: function(response) {
                loadingClose('.content');
                $('#type_product').html(response.type_product);
                $('#class_product').html(response.class_product);
                $('#gender').html(response.gender);
                $('#group_size').html(response.group_size);
                $('#smv_global').html(response.smv_global);
                $('#created_by').html(response.created_by);
                $('#modified_by').html(response.modified_by);
                $('#date_created').html(response.date_created);
                $('#last_modified_date').html(response.last_modified_date);
                $('#status').html(response.status);

                $.each(response.check_point, function(i, val) {
                    $('#check_point_id').append(val);
                });

                refreshListBox('#check_point_id');

                $.each(response.defect, function(i, val) {
                    $('#datatable_defect').DataTable().row.add([
                        val.no,
                        val.code,
                        val.name,
                        val.button
                    ]).draw().node();
                });
            },
            error: function() {
                loadingClose('.content');
                swalInit.fire({
                    title: 'Server Error',
                    text: 'Please contact developer',
                    icon: 'error'
                });
            }
        });
    }

    function submitable(param) {
        var product_type_id = $('#product_type_id').val();

        if(param == 'check_point') {
            var form_data = $('#form_check_point').serialize();
        } else {
            var form_data = $('#form_defect').serialize();
        }

        $.ajax({
            url: '{{ url("product/manage/submitable") }}?product_type_id=' + product_type_id + '&param=' + param,
            type: 'POST',
            dataType: 'JSON',
            data: form_data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                loadingOpen('.content');
            },
            success: function(response) {
                loadingClose('.content');
                loadContent(product_type_id);
                if(response.status == 200) {
                    swalInit.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success'
                    });
                } else {
                    swalInit.fire({
                        title: 'Failed',
                        text: response.message,
                        icon: 'error'
                    });
                }
            },
            error: function() {
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
