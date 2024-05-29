@extends('shop.layout.app')

@section('title', env("APP_NAME").' - '.$product->nama_produk)

@section('content')

@include('shop.modal.modal_cart')
@include('shop.modal.modal_wishlist')
@include('shop.layout.header')

<div>
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <a href="product.html" class="stext-109 cl8 hov-cl1 trans-04">
            {{ $product->nama_kategori }}
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            {{ $product->nama_produk }}
        </span>
    </div>
</div>

<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-7 p-b-30">
                <div class="p-l-25 p-r-30 p-lr-0-lg">
                    <div class="wrap-slick3 flex-sb flex-w">
                        <div class="wrap-slick3-dots"></div>
                        <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                        <div class="slick3 gallery-lb">
                            <div class="item-slick3" data-thumb="{{ asset($product->path_foto.$product->id_produk.'_foto1.jpg') }}">
                                <div class="wrap-pic-w pos-relative">
                                    <img src="{{ asset($product->path_foto.$product->id_produk.'_foto1.jpg') }}" alt="IMG-PRODUCT">

                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset($product->path_foto.$product->id_produk.'_foto1.jpg') }}">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                </div>
                            </div>

                            @if (file_exists($product->path_foto.$product->id_produk.'_foto2.jpg'))
                            <div class="item-slick3" data-thumb="{{ asset($product->path_foto.$product->id_produk.'_foto2.jpg') }}">
                                <div class="wrap-pic-w pos-relative">
                                    <img src="{{ asset($product->path_foto.$product->id_produk.'_foto2.jpg') }}" alt="IMG-PRODUCT">

                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset($product->path_foto.$product->id_produk.'_foto2.jpg') }}">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                </div>
                            </div>
                            @endif

                            @if (file_exists($product->path_foto.$product->id_produk.'_foto2.jpg'))
                            <div class="item-slick3" data-thumb="{{ asset($product->path_foto.$product->id_produk.'_foto3.jpg') }}">
                                <div class="wrap-pic-w pos-relative">
                                    <img src="{{ asset($product->path_foto.$product->id_produk.'_foto3.jpg') }}" alt="IMG-PRODUCT">

                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset($product->path_foto.$product->id_produk.'_foto3.jpg') }}">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
                
            <div class="col-md-6 col-lg-5 p-b-30">
                <div class="p-r-50 p-t-5 p-lr-0-lg">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                        {{ $product->nama_produk }}
                    </h4>

                    <span class="mtext-106 cl2">
                        Rp. {{ $product->harga }}
                    </span>

                    <div class="p-t-33">
                        <div class="flex-w flex-r-m p-b-10">
                            <div class="size-203 flex-c-m respon6">
                                Ukuran
                            </div>

                            <div class="size-204 respon6-next">
                                <div class="rs1-select2 bor8 bg0">
                                    <select class="js-select2" name="size">
                                        <option value="">Pilih</option>
                                        @foreach(explode(',', $product->ukuran) as $size)
                                        <option value="{{ $size }}">Ukuran {{ $size }}</option>
                                        @endforeach
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                            </div>
                        </div>

                        <div class="flex-w flex-r-m p-b-10">
                            <div class="size-204 flex-w flex-m respon6-next">
                                <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                    </div>
                                    <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1" num-max="{{ $product->stok }}">
                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                    </div>
                                </div>

                                @if (request()->session()->has('id_pembeli'))
                                <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail m-t-25" product-id="{{ $product->id_produk }}" product-name="{{ $product->nama_produk }}">
                                    Tambah ke Troli
                                </button>
                                <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addwish-b2 m-t-25" product-id="{{ $product->id_produk }}" product-name="{{ $product->nama_produk }}">
                                    Tambah ke Wishlist
                                </button>
                                @else
                                <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-disable m-t-25" product-id="{{ $product->id_produk }}" product-name="{{ $product->nama_produk }}">
                                    Tambah ke Troli
                                </button>
                                <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-disable m-t-25" product-id="{{ $product->id_produk }}" product-name="{{ $product->nama_produk }}">
                                    Tambah ke Wishlist
                                </button>
                                @endif
                            </div>
                        </div>	
                    </div>

                </div>
            </div>
        </div>

        <div class="bor10 m-t-50 p-t-43 p-b-40">
            <div class="tab01">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item p-b-10">
                        <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Deskripsi</a>
                    </li>

                    <li class="nav-item p-b-10">
                        <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Ulasan ({{ count($reviews) }})</a>
                    </li>
                </ul>

                <div class="tab-content p-t-43">
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <div class="how-pos2 p-lr-15-md">
                            <p class="stext-102 cl6">
                                {{ $product->deskripsi }}
                            </p>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                <div class="p-b-30 m-lr-15-sm">
                                    @foreach ($reviews as $review)
                                        <div class="flex-w flex-t p-b-68">
                                            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                                <img src="{{ asset('/cs/images/avatar-01.jpg') }}" alt="AVATAR">
                                            </div>

                                            <div class="size-207">
                                                <div class="flex-w flex-sb-m p-b-17">
                                                    <span class="mtext-107 cl2 p-r-20">
                                                        {{ $review->nama_lengkap }}
                                                    </span>

                                                    <span class="fs-18 cl11">
                                                        @php $star = $review->bintang @endphp
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($star > 0)
                                                                <i class="zmdi zmdi-star"></i>
                                                            @endif
                                                            @php $star-- @endphp
                                                        @endfor
                                                    </span>
                                                </div>

                                                <p class="stext-102 cl6">
                                                    {{ $review->ulasan }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
        <span class="stext-107 cl6 p-lr-25">
            Kategori: {{ $product->nama_kategori }}
        </span>
    </div>
</section>

@isset($products)
<section class="sec-relate-product bg0 p-t-45 p-b-105">
    <div class="container">
        <div class="p-b-45">
            <h3 class="ltext-106 cl5 txt-center">
                Produk Lainnya
            </h3>
        </div>

        <div class="wrap-slick2">
            <div class="slick2">
                @php $i = 0 @endphp
                @foreach($products as $product)
                    <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                        @include('shop.layout.card_product', [
                            'id' 	    => $product->id_produk,
                            'img'	    => url($product->path_foto.'/'.$product->id_produk.'_foto1.jpg'),
                            'name'	    => $product->nama_produk,
                            'price'	    => $product->harga,
                            'ratings'   => round($ratings[$i])
                        ])
                    </div>
                    @php $i++ @endphp
                @endforeach
            </div>
        </div>
    </div>
</section>
@endisset
</div>
@include('shop.layout.footer')

@endsection

@section('script')
<script>
    $('header').addClass('header-v4')

    $('.btn-num-product-down').on('click', function(){
        var numProduct = Number($(this).next().val());
        if(numProduct > 0) $(this).next().val(numProduct - 1);
    });

    $('.btn-num-product-up').on('click', function(){
        var numProduct = Number($(this).prev().val());
        var max        = Number($(this).prev().attr('num-max'))
        if (numProduct < max) $(this).prev().val(numProduct + 1);
    });

    $('.js-addcart-detail').click(function() {
        let product_name    = $(this).attr('product-name')
        let product_id      = $(this).attr('product-id')
        let qty             = $('.num-product').val()
        let size            = $('select[name="size"]').val()

        if (size === "" || qty == 0) {
            swal(product_name, 'Ukuran belum dipilih atau Qty masih kosong', 'error')
            return
        }

        $.ajax({
            url: '{{ route("shop.customer.cart.add") }}',
            type: 'post',
            dataType: 'json',
            data: {
                '_token': '{{ csrf_token() }}',
                'product_id': product_id,
                'qty': qty,
                'size': size
            },
            success: function(response) {
                if (response.status === 'success') {
                    swal(product_name, 'Berhasil dimasukan ke keranjang', 'success')

                    let content = '';
                    let total_harga = 0;

                    response.data.forEach(function(i) {
                        content += `
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img" cart-id="${i.id_keranjang}" product-name="${i.nama_produk}">
                                <img src="{{ url('') }}/${i.path_foto}/${i.id_produk}_foto1.jpg" alt="IMG">
                            </div>

                            <div class="header-cart-item-txt p-t-8">
                                <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                    ${i.nama_produk} (${i.ukuran_terpilih})
                                </a>

                                <span class="header-cart-item-info">
                                    ${i.qty} x Rp. ${i.harga}
                                </span>
                            </div>
                        </li>`

                        total_harga += Number(i.qty) * Number(i.harga)
                    })

                    content += `
                    <div class="w-full">
                        <div class="header-cart-total w-full p-tb-40">
                            Total: Rp. ${total_harga}
                        </div>

                        <div class="header-cart-buttons flex-w w-full">
                            <a href="{{ url('/customer/cart') }}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                                Check Out
                            </a>
                        </div>
                    </div>`

                    $('.js-panel-cart').find('.header-cart-wrapitem').html(content)
                    $('.js-show-cart').attr('data-notify', response.total_cart)
                } else {
                    swal(product_name, "Gagal menambahkan item ke troli", "error");
                }
            }
        })
    })
</script>
@endsection