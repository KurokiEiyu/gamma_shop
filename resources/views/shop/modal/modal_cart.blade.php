<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Troli
            </span>
            
            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>
        
        <div class="header-cart-content flex-w js-pscroll">
            @if (isset($carts) && count($carts) > 0)
            @php
            $total_harga = 0
            @endphp
            <ul class="header-cart-wrapitem w-full">
                @foreach($carts as $cart)
                @php
                $total_harga += ($cart->qty * $cart->harga)
                @endphp
                <li class="header-cart-item flex-w flex-t m-b-12">
                    <div class="header-cart-item-img" cart-id="{{ $cart->id_keranjang }}" product-name="{{ $cart->nama_produk }}">
                        <img src="{{ asset($cart->path_foto.'/'.$cart->id_produk.'_foto1.jpg') }}" alt="IMG">
                    </div>

                    <div class="header-cart-item-txt p-t-8">
                        <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                            {{ $cart->nama_produk.' ('.$cart->ukuran_terpilih.')' }}
                        </a>

                        <span class="header-cart-item-info">
                            {{ $cart->qty }} x Rp. {{ $cart->harga }}
                        </span>
                    </div>
                </li>
                @endforeach
            
            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40">
                    Total: Rp. {{ $total_harga }}
                </div>

                <div class="header-cart-buttons flex-w w-full">
                    <a href="{{ url('/customer/cart') }}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                        Check Out
                    </a>
                </div>
            </div>
            @else
            <ul class="header-cart-wrapitem w-full">
                <div class="p-tb-24">
                    <p class="stext-101 cl2">Tidak ada</p>
                </div>
            </ul>
            @endif
        </div>
    </div>
</div>