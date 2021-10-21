<div class="content-inner">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-lg-inline">
            <div class="page-title d-flex">
                <h4>
                    <a href="{{ url()->previous() }}" class="text-dark"><i class="icon-arrow-left52 mr-2"></i></a>
                    <span class="font-weight-semibold">Working Hours Chart</span>
                </h4>
            </div>
            <div class="header-elements">
                <div class="d-flex justify-content-center">
                    <div class="form-group">
                        <button type="button" class="btn btn-teal btn-labeled btn-labeled-left" onclick="loadDataTable()">
                            <b><i class="icon-sync"></i></b> Refresh
                        </button>
                        <a href="{{ url('working_hours/type/create') }}" class="btn btn-teal btn-labeled btn-labeled-left">
                            <b><i class="icon-plus-circle2"></i></b> Add
                        </a>
                    </div>
                </div>
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
                        <li class="folder expanded">Expanded folder with children
                            <ul>
                                <li class="expanded">Expanded sub-item
                                    <ul>
                                        <li class="active focused">Active sub-item (active and focus on init)</li>
                                        <li>Basic <i>menu item</i> with <strong class="font-weight-semibold">HTML support</strong></li>
                                    </ul>
                                </li>
                                <li>Collapsed sub-item
                                    <ul>
                                        <li>Sub-item 2.2.1</li>
                                        <li>Sub-item 2.2.2</li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="has-tooltip" title="Look, a tool tip!">Menu item with key and tooltip</li>
                        <li class="folder">Collapsed folder
                            <ul>
                                <li>Sub-item 1.1</li>
                                <li>Sub-item 1.2</li>
                            </ul>
                        </li>
                        <li class="selected">This is a selected item</li>
                        <li class="expanded">Document with some children (expanded on init)
                            <ul>
                                <li>Document sub-item</li>
                                <li>Another document sub-item
                                    <ul>
                                        <li>Sub-item 2.1.1</li>
                                        <li>Sub-item 2.1.2</li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
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
