<div class="block-header">
    <div class="row">
        <div class="col-lg-5 col-md-8 col-sm-12">
            <h2>
                <a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth">
                    <i class="fa fa-arrow-left"></i></a> {{ $header_title }}
            </h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.index') }}"><i class="icon-home"></i></a>
                </li>
                {{ $breadcrumb_item }}
                {{ $breadcrumb_item_active }}
            </ul>
        </div>
        <div class="col-lg-7 col-md-4 col-sm-12 text-right">
        </div>
    </div>
</div>