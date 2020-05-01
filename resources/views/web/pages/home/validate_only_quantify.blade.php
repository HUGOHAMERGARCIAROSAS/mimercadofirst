@if($item->productScale->name != \App\src\Models\ProductScale::$SCALE_ONE)
    max="1500"
    readonly
    disabled
@endif