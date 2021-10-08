<div class="content-inner">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-lg-inline">
            <div class="page-title d-flex">
                <h4>
                    <a href="{{ url()->previous() }}" class="text-dark"><i class="icon-arrow-left52 mr-2"></i></a>
                    <span class="font-weight-semibold">Bulk Upload Type Product</span>
                </h4>
            </div>
            <div class="header-elements">
                <div class="d-flex justify-content-center">
                    <div class="form-group">
                        <a href="{{ url('product/type') }}" class="btn btn-secondary btn-labeled btn-labeled-left">
                            <b><i class="icon-arrow-left5"></i></b> Back To List
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ url('dashboard') }}" class="breadcrumb-item">Dashboard</a>
                    <a href="javascript:void(0);" class="breadcrumb-item">Product</a>
                    <a href="{{ url('product/type') }}" class="breadcrumb-item">Type</a>
                    <span class="breadcrumb-item active">Bulk Upload</span>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @elseif(session('success'))
            <div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                <span class="font-weight-semibold">Well done!</span>
                Your file has been processed successfully
            </div>
        @elseif(session('failed'))
            <div class="alert alert-danger alert-styled-left alert-arrow-left alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                <span class="font-weight-semibold">Failed!</span>
                Your file has failed to process
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data" id="form_data">
                    @csrf
                    <div class="form-group">
                        <label>Upload the excel file below :</label>
                        <a href="{{ url('download/excel_template/type_product') }}" class="float-right text-primary font-weight-bold">Download Template</a>
                        <input type="file" class="file-input  form-control-lg" name="file_excel" data-main-class="input-group-lg" data-fouc>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    $(function() {
        uploader(['xlsx']);
        $('.fileinput-upload-button').click(function() {
            loadingOpen('body');
            $('#form_data').submit();
        });
    });
</script>
