@if($image == null)
    <a href="{{ $imageByDefault }}"
       data-lightbox="image-1">
        <img src="{{ $imageByDefault }}"
             width="48" alt="">
    </a>
@else
    <a href="{{ assetImage($image) }}"
       data-lightbox="image-1">
        <img src="{{ assetImage($image) }}"
             width="48" alt="">
    </a>
@endif