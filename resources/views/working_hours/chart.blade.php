<div class="content-inner">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-lg-inline">
            <div class="page-title d-flex">
                <h4>
                    <a href="{{ url()->previous() }}" class="text-dark"><i class="icon-arrow-left52 mr-2"></i></a>
                    <span class="font-weight-semibold">Working Hours Chart</span>
                </h4>
            </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ url('dashboard') }}" class="breadcrumb-item">Dashboard</a>
                    <a href="javascript:void(0);" class="breadcrumb-item">Working Hours</a>
                    <span class="breadcrumb-item active">Chart</span>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="tree-default card card-body border-left-info border-left-2 mb-0">
                    <ul class="d-none mb-0">
                        @foreach($tree_view as $tv)
                            @if($tv['sub'])
                                <li class="folder expanded">
                                    <a href="javascript:void(0);" class="text-dark">{{ $tv['name'] }}</a>
                                    <ul>
                                        @foreach($tv['sub'] as $sb)
                                            @if($sb['sub'])
                                                <li class="folder expanded">
                                                    <a href="javascript:void(0);" class="text-dark">{{ $sb['name'] }}</a>
                                                    <ul>
                                                        @foreach($sb['sub'] as $d)
                                                            @if($d['sub'])
                                                                <li class="folder expanded">
                                                                    <a href="javascript:void(0);" class="text-dark">{{ $d['name'] }}</a>
                                                                    <ul>
                                                                        @foreach($d['sub'] as $dtt)
                                                                            @if($dtt['sub'])
                                                                                <li class="folder expanded">
                                                                                    <a href="javascript:void(0);" class="text-dark">{{ $dtt['name'] }}</a>
                                                                                    <ul>
                                                                                        @foreach($dtt['sub'] as $s)
                                                                                            @if($s['sub'])
                                                                                                <li class="folder expanded">
                                                                                                    <a href="javascript:void(0);" class="text-dark">{{ $s['name'] }}</a>
                                                                                                    <ul>
                                                                                                        @foreach($s['sub'] as $l)
                                                                                                            <li class="folder expanded">
                                                                                                                <a href="javascript:void(0);" class="text-dark">{{ $l['name'] }}</a>
                                                                                                            </li>
                                                                                                        @endforeach
                                                                                                    </ul>
                                                                                                </li>
                                                                                            @else
                                                                                                <li class="folder expanded">
                                                                                                    <a href="javascript:void(0);" class="text-dark">{{ $s['name'] }}</a>
                                                                                                </li>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </li>
                                                                            @else
                                                                                <li class="folder expanded">
                                                                                    <a href="javascript:void(0);" class="text-dark">{{ $dtt['name'] }}</a>
                                                                                </li>
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                            @else
                                                                <li class="folder expanded">
                                                                    <a href="javascript:void(0);" class="text-dark">{{ $d['name'] }}</a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li class="folder">
                                                    <a href="javascript:void(0);" class="text-dark">{{ $sb['name'] }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="folder">
                                    <a href="javascript:void(0);" class="text-dark">{{ $tv['name'] }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

<script>
    $(function() {
        $('.sidebar-control').click();
        $('.tree-default').fancytree({
            init: function(event, data) {
                $('.has-tooltip .fancytree-title').tooltip();
            }
        });
    });
</script>
