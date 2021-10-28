<div class="content-inner">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-lg-inline">
            <div class="page-title d-flex">
                <h4>
                    <a href="{{ url()->previous() }}" class="text-dark"><i class="icon-arrow-left52 mr-2"></i></a>
                    <span class="font-weight-semibold">Check Point Type Product</span>
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
                    <span class="breadcrumb-item active">Check Point</span>
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
                Your data has been processed successfully
            </div>
        @elseif(session('failed'))
            <div class="alert alert-danger alert-styled-left alert-arrow-left alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                <span class="font-weight-semibold">Failed!</span>
                Your data has failed to process
            </div>
        @endif
        <form method="POST" id="form_data">
            @csrf
            <div class="card">
                <div class="card-header bg-transparent">
                    <h6 class="card-title">
                        <i class="icon-info22 mr-2"></i>
                        Data Type Product
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-semibold">Type Product :</label>
                                <div class="form-control-plaintext">{{ $type_product->name }}</div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold">Class Product :</label>
                                <div class="form-control-plaintext">{{ $type_product->productClass->name }}</div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold">Gender :</label>
                                <div class="form-control-plaintext">{{ $type_product->gender->name }}</div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold">Group Size :</label>
                                <div class="form-control-plaintext">
                                    @if($type_product->size->sizeDetail)
                                        @foreach($type_product->size->sizeDetail as $key => $sd)
                                            @php $separator = $key + 1 == $type_product->size->sizeDetail->count() ? '' : ', '; @endphp
                                            {{ $sd->value . $separator }}
                                        @endforeach
                                    @else
                                        Value not selected
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold">Smv Global :</label>
                                <div class="form-control-plaintext">{{ $type_product->smv_global }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-semibold">Created By :</label>
                                <div class="form-control-plaintext">{{ $type_product->createdBy->name }}</div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold">Modified By :</label>
                                <div class="form-control-plaintext">{{ $type_product->updatedBy->name }}</div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold">Date Created :</label>
                                <div class="form-control-plaintext">{{ $type_product->created_at->format('d F Y, H:i') }}</div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold">Last Modified Date :</label>
                                <div class="form-control-plaintext">{{ $type_product->updated_at->format('d F Y, H:i') }}</div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold">Status :</label>
                                <div class="form-control-plaintext">{!! $type_product->status() !!}</div>
                            </div>
                        </div>
                        @if($type_product->description)
                            <div class="col-md-12">
                                <div class="form-group mb-0"><hr></div>
                                <div class="row">
                                    <div class="col-md-4 font-weight-bold font-italic">Description :</div>
                                    <div class="col-md-8">
                                        <div class="text-right">
                                            <p class="font-italic">{{ $type_product->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-transparent">
                    <h6 class="card-title">
                        <i class="icon-stack-check mr-2"></i>
                        Check Point
                    </h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <select name="check_point_id[]" multiple="multiple" class="form-control listbox" data-fouc>
                            @foreach($check_point as $cp)
                                @php
                                    $check_selected = $type_product->productTypeCheckPoint()->where('check_point_id', $cp->id)->count();
                                    $data           = $type_product->productTypeCheckPoint()
                                        ->where('check_point_id', $cp->id)
                                        ->where('product_type_id', $type_product->id)
                                        ->first();

                                    if($data) {
                                        $existsable = $type_product->productTypeDefect()->where('product_type_check_point_id', $data->id)->count();
                                    } else {
                                        $existsable = 0;
                                    }
                                @endphp
                                <option value="{{ $cp->id }}" {{ $check_selected > 0 ? 'selected' : '' }} {{ $existsable > 0 ? 'disabled' : '' }}>{{ $cp->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-0">
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary btn-labeled btn-labeled-left" id="btn_submit">
                                <b><i class="icon-floppy-disk"></i></b> Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

<script>
    $(function() {
        $('#btn_submit').click(function() {
			$('#form_data').submit();
			loadingOpen('.content');
		});
    });
</script>
