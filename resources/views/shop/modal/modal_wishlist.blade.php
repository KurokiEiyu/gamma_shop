<div class="wrap-header-cart js-panel-wishlist">
    <div class="s-full js-hide-wishlist"></div>
    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Favorit
            </span>
            
            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-wishlist">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>
        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full">
                @if (isset($favorites) && count($favorites) > 0)
                @foreach($favorites as $favorite)
                <li class="header-cart-item flex-w flex-t m-b-12">
                    <div class="header-cart-item-img" favorit-id="{{ $favorite->id_favorit }}" product-name="{{ $favorite->nama_produk }}">
                        <img src="{{ asset($favorite->path_foto.'/'.$favorite->id_produk.'_foto1.jpg') }}" alt="IMG">
                    </div>
                    <div class="header-cart-item-txt p-t-8">
                        <a href="{{ url('/product/'.$favorite->produk_id) }}" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                            {{ $favorite->nama_produk }}
                        </a>
                        <span class="header-cart-item-info">
                            Rp. {{ $favorite->harga }}
                        </span>
                    </div>
                </li>
                @endforeach
                @else
                <div class="p-tb-24">
                    <p class="stext-101 cl2">Tidak ada</p>
                </div>
                @endif
            </ul>
        </div>
    </div>
</div>