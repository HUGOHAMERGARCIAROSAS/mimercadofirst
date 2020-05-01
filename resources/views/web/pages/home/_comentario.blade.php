<div class="slider best-seller-slider mb-35">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!--=======  category slider section title  =======-->

                <div class="section-title">
                    <h3>TESTIMONIOS</h3>
                </div>

                <!--=======  End of category slider section title  =======-->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!--=======  best seller slider container  =======-->

                <div class="best-seller-slider-container pt-15 pb-15">

                    @foreach($comments as $item)
                        <div class="col">
                            <div class="single-best-seller-item">
                                <div class="best-seller-sub-product">
                                    <div class="row">
                                        <div class="col-lg-4 pl-0 pr-0">
                                            <div class="image">
                                                @if ($item->image == null)
                                                    <img src="{{ asset('web/img/comment/default.jpg') }}"
                                                         class="img-fluid" alt="user">
                                                @else
                                                    <img src="{{ assetImage($item->image) }}"
                                                         class="img-fluid" alt="user">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-8 pl-0 pr-0">
                                            <div class="product-content">
                                                <div class="product-categories">
                                                    <div>
                                                        {{ $item->comment }}
                                                    </div>
                                                </div>
                                                <div class="product-categories negrita pt-3"><em>{{ $item->user }}</em></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <!--=======  End of best seller slider container  =======-->
            </div>
        </div>
    </div>
</div>