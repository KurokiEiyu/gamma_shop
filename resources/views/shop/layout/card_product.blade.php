<div class="block2">
    <div class="block2-pic hov-img0">
        <img class="img-product" src="{{ asset($img) }}" alt="IMG-PRODUCT">
        <a href="{{ url('/product/'.$id) }}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
            Beli
        </a>
    </div>
    <div class="block2-txt flex-w flex-t p-t-14">
        <div class="block2-txt-child1 flex-col-l ">
            <a href="{{ url('/product/'.$id) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                {{ $name }}
            </a>
            <span class="fs-18 cl11">
               @php $star = $ratings @endphp
                @for ($i = 1; $i <= 5; $i++)
                     @if ($star > 0)
                        <i class="zmdi zmdi-star"></i>
                    @endif
                    @php $star-- @endphp
                @endfor
            </span>
            <span class="stext-105 cl3">
                Rp. {{ $price }}
            </span>
        </div>
        <div class="block2-txt-child2 flex-r p-t-3">
            @if (request()->session()->has('id_pembeli'))
            <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2" product-id="{{ $id }}" product-name="{{ $name }}" product-price="{{ $price }}">
                <img class="icon-heart1 dis-block trans-04" src="{{ asset('/cs/images/icons/icon-heart-01.png') }}" alt="ICON">
                <img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{ asset('/cs/images/icons/icon-heart-02.png') }}" alt="ICON">
            </a>
            @else
            <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-disable">
                <img class="icon-heart1 dis-block trans-04" src="{{ asset('/cs/images/icons/icon-heart-01.png') }}" alt="ICON">
                <img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{ asset('/cs/images/icons/icon-heart-02.png') }}" alt="ICON">
            </a>
            @endif
        </div>
    </div>
</div>