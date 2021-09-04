<div class="content-inner">
   <div class="page-header page-header-light">
      <div class="page-header-content header-elements-lg-inline">
         <div class="page-title d-flex">
            <h4>
               <a href="{{ url()->previous() }}" class="text-dark"><i class="icon-arrow-left52 mr-2"></i></a>
               <span class="font-weight-semibold">Group Defect</span>
            </h4>
            <a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
         </div>
         <div class="header-elements d-none">
            <div class="d-flex justify-content-center">
               <button type="button" class="btn btn-success btn-labeled btn-labeled-left">
                  <b><i class="icon-printer"></i></b> Print
               </button>
               <button type="button" class="btn btn-danger btn-labeled btn-labeled-left mx-1">
                  <b><i class="icon-file-excel"></i></b> Export Excel
               </button>
               <button type="button" class="btn btn-indigo btn-labeled btn-labeled-left">
                  <b><i class="icon-plus-circle2"></i></b> Add
               </button>
            </div>
         </div>
      </div>
      <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
         <div class="d-flex">
            <div class="breadcrumb">
               <a href="{{ url('dashboard') }}" class="breadcrumb-item"><i class="icon-home4"></i></a>
               <a href="javascript:void(0);" class="breadcrumb-item">Master Data</a>
               <a href="javascript:void(0);" class="breadcrumb-item">General</a>
               <span class="breadcrumb-item active">Group Defect</span>
            </div>
         </div>
      </div>
   </div>
   <div class="content">
      <div class="card">
         <div class="card-body">
            <table class="table table-bordered table-striped table-hover display nowrap w-100" id="datatable_serverside">
               <thead class="bg-primary text-white">
                  <tr class="text-center">
                     <th>No</th>
                     <th>Code</th>
                     <th>Major Defect List</th>
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

<script>
   $(function() {
      loadDataTable();
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
            url: '{{ url("master_data/general/group_defect/datatable") }}',
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
            { name: 'code', className: 'text-center align-middle' },
            { name: 'name', className: 'text-center align-middle' },
            { name: 'status', orderable: false, searchable: false, className: 'text-center align-middle' },
            { name: 'updated_by', className: 'text-center align-middle' },
            { name: 'created_at', searchable: false, className: 'text-center align-middle' },
            { name: 'action', searchable: false, orderable: false, className: 'text-center align-middle' }
         ]
      });
   }
</script>