@extends('shop.layout.app')

@section('title', env("APP_NAME").' - Ulasan')

@section('style')
<style>
    .profile {
        width: 72px;
        height: 72px;
    }

    .tab01 .nav-tabs {
        justify-content: start;
    }

    @media screen and (max-width: 767px) {
        .container {
            padding: 0 32px;
        }
    }

    @media screen and (min-width: 768px) {
        .profile {
            width: 100%;
            height: 100%;
        }
    }
</style>
@endsection

@section('content')
@include('shop.modal.modal_cart')
@include('shop.modal.modal_wishlist')
@include('shop.layout.header')

<div class="container p-b-64">
    <div class="row">
        <div class="col-12 bor8">
            <table>
                <tr>
                    <td class="p-tb-12 p-lr-12">
                        <div class="how-itemcart1">
                            <img src="{{ asset($product->path_foto.'/'.$product->id_produk.'_foto1.jpg') }}" alt="">
                        </div>
                    </td>
                    <td class="p-tb-12 p-lr-12">
                        <a href="{{ route('shop.product.detail', ['id_product' => $product->id_produk]) }}" class="mtext-110 m-b-8 cl2">{{ $product->nama_produk }}</a>
                        <span class="stext-111 dis-block">Rp. {{ $product->qty * $product->harga }}</span>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-12 bor8 p-b-32">
            <form action="{{ route('shop.customer.order.review_process', ['id' => $product->id_produk]) }}" method="post">
                @csrf
                <div class="flex-w flex-m p-tb-24 p-l-4">
                    <span class="stext-102 cl3 m-r-16">
                        Bintang
                    </span>

                    <span class="wrap-rating fs-18 cl11 pointer rating">
                        <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                        <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                        <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                        <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                        <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                        <input class="dis-none" type="number" name="bintang" value="0">
                    </span>
                </div>
                <div class="bor8 bg0">
                    <textarea class="stext-111 cl8 plh3 size-120 p-lr-15 p-tb-8" type="text" name="ulasan" placeholder="Ketik ulasan disini"></textarea>
                </div>
                <input type="hidden" name="id_riwayat_pesanan" value="{{ $product->id_riwayat_pesanan }}">
                <input type="hidden" name="id_order_item" value="{{ $product->id_order_item }}">
                <button class="bg1 size-102 hov-btn1 cl0 bor14 m-t-24 float-right">Kirim</button>
            </form>
        </div>
    </div>
</div>
@include('shop.layout.footer')
@endsection

@section('script')
<script>
    $('header').addClass('header-v4')

    $('.rating').on('click', 'i', function() {
        $('.rating input[name="bintang"]').val($('.rating .zmdi-star').length)
    })
</script>
@endsection