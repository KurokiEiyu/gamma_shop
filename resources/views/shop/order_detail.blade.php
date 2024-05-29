@extends('shop.layout.app')

@section('title', env("APP_NAME").' - Detail Pesanan')

@section('content')
@include('shop.modal.modal_cart')
@include('shop.modal.modal_wishlist')
@include('shop.layout.header')

<div class="container m-b-72">
    <div class="row">
        <div class="col-12 m-b-32">
            <p class="stext-102 cl6">
                Tanggal order: {{ $order[0]->tgl_pesan }}
            </p>
        </div>
        <div class="col-12">
            <span class="mtext-109 cl2 m-b-16">
                Alamat Pengiriman
            </span>
            <p class="stext-102 cl6">
                {{ $order[0]->alamat_penerima }} - {{ $order[0]->telepon_penerima }}
            </p>
            <hr>
        </div>
        <div class="col-12">
            <span class="mtext-109 cl2">
                Item
            </span>
            <div class="table-responsive m-t-16">
                <table>
                    <tbody>
                        @php $subtotal = 0 @endphp
                        @foreach ($order as $item)
                        @php $subtotal += $item->qty * $item->harga @endphp
                        <tr>
                            <td class="p-tb-4">
                                <div class="how-itemcart1">
                                    <img src="{{ asset($item->path_foto.'/'.$item->id_produk.'_foto1.jpg') }}" alt="">
                                </div>
                            </td>
                            <td class="p-tb-4 w-full">
                                <a href="" class="mtext-110 m-b-8 cl2">{{ $item->nama_produk }}</a>
                                <span class="stext-111 dis-block">x{{ $item->qty }}</span>
                                <span class="stext-111">Rp. {{ $item->qty * $item->harga }}</span>
                            </td>
                            <td class="p-tb-4">
                                <a href="{{ route('shop.product.detail', ['id_product' => $item->id_produk]) }}" class="hov-btn1 stext-101 size-101 bg1 bor2 p-lr-15 cl0 p-tb-4">Lihat</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr>
        </div>
        <div class="col-12">
            <span class="mtext-109 cl2 m-b-16">
                Metode Pembayaran
            </span>
            <p class="stext-102 cl6">
                {{ $order[0]->metode_pembayaran }}
            </p>
            <hr>
        </div>
        <div class="col-12">
            <span class="mtext-109 cl2 m-b-16">
                Total
            </span>
            <div class="m-t-8">
                <div class="flex-sb">
                    <span class="stext-102 cl6">Subtotal</span>
                    <span>Rp. {{ $subtotal }}</span>
                </div>
                <!-- <div class="flex-sb">
                    <span class="stext-102 cl6">Ongkir</span>
                    <span>Rp. 8000</span>
                </div> -->
                <hr class="">
                <div class="flex-sb">
                    <span class="stext-102 cl6">Total Bayar</span>
                    <span>Rp. {{ $order[0]->total_bayar }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

@include('shop.layout.footer')
@endsection

@section('script')
<script>
    $('header').addClass('header-v4')
</script>
@endsection