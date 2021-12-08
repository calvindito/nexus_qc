<div class="content-inner">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-lg-inline">
            <div class="page-title d-flex">
                <h4>
                    <a href="{{ url()->previous() }}" class="text-dark"><i class="icon-arrow-left52 mr-2"></i></a>
                    <span class="font-weight-semibold">Departement</span>
                </h4>
            </div>
            <div class="header-elements">
                <div class="d-flex justify-content-center">
                    <div class="form-group">
                        <button type="button" class="btn btn-teal btn-labeled btn-labeled-left" onclick="loadDataTable()">
                            <b><i class="icon-sync"></i></b> Refresh
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ url('dashboard') }}" class="breadcrumb-item">Dashboard</a>
                    <a href="javascript:void(0);" class="breadcrumb-item">General</a>
                    <span class="breadcrumb-item active">Departement</span>
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
                            <th>Departement</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

<script>
    $(function() {
        loadDataTable();
    });

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
                url: '{{ url("general/departement/datatable") }}',
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
                { name: 'department', className: 'text-center align-middle' },
                { name: 'description', className: 'text-center align-middle' },
                { name: 'status', searchable: false, className: 'text-center align-middle' }
            ]
        });
    }
</script>
