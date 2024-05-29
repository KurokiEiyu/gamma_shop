@extends('shop.layout.app')

@section('title', env("APP_NAME").' - Akun Saya')

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
        <div class="col-md-4 col-lg-3 p-tb-16 p-tb-0-md">
            <div class="row flex-c-m">
                <div class="col-4 col-md-5">
                    <img src="{{ asset('/sb_admin_2/img/SW.png') }}" alt="" class="dis-block profile m-lr-auto">
                </div>
                <div class="col-8 col-md-7">
                    <h6 class="stext-102 p-tb-4">{{ $customer_name }}</h6>
                    <a href="{{ route('shop.customer.account.edit') }}" class="stext-102 fs15 p-tb-4"><i class="fa fa-pencil"></i> Ubah Profil</a>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-lg-9 p-t-18 bor10">
            <span class="mtext-109 cl2 m-l-16">
                Riwayat Pesanan Saya
            </span>
            <div class="tab01">
                <ul class="nav nav-tabs p-t-18" role="tablist">
                    <li class="nav-item p-b-10">
                        <a class="nav-link active" data-toggle="tab" href="#unconfirm" role="tab">Menunggu Konfirmasi Penjual</a>
                    </li>
                    <li class="nav-item p-b-10">
                        <a class="nav-link" data-toggle="tab" href="#packaged" role="tab">Dikemas</a>
                    </li>
                    <li class="nav-item p-b-10">
                        <a class="nav-link" data-toggle="tab" href="#shipping" role="tab">Dikirim</a>
                    </li>
                    <li class="nav-item p-b-10">
                        <a class="nav-link" data-toggle="tab" href="#rating" role="tab">Penilaian</a>
                    </li>
                    <li class="nav-item p-b-10">
                        <a class="nav-link" data-toggle="tab" href="#finish" role="tab">Selesai</a>
                    </li>
                </ul>

                <div class="tab-content p-tb-24 p-lr-18">
                    <div class="tab-pane fade show active" id="unconfirm" role="tabpanel">
                    @if ((count($history_orders) > 0) && (count($items['unconfirm']) > 0))
                            <div class="table-responsive">
                                @foreach ($history_orders as $order)
                                    @php $i = 0 @endphp
                                    @foreach ($items['unconfirm'] as $item)
                                        @if (($item->id_riwayat_pesanan === $order->id_riwayat_pesanan))
                                            @php $i++ @endphp
                                        @endif
                                    @endforeach
                                    @if ($i > 0)
                                    <div class="bor16 p-l-24 m-b-24">
                                        <div class="m-b-24 flex-sb">
                                            <span class="stext-111 cl3">{{ $order->tgl_pesan }}</span>
                                            <a href="{{ url('/customer/order/'.$order->id_riwayat_pesanan) }}" class="stext-111 cl3">Lihat rincian ></a>
                                        </div>
                                        <table>
                                            <tbody>
                                                @foreach ($items['unconfirm'] as $item)
                                                    @if (($item->id_riwayat_pesanan === $order->id_riwayat_pesanan))
                                                    <tr>
                                                        <td class="p-tb-4">
                                                            <div class="how-itemcart1">
                                                                <img src="{{ asset($item->path_foto.'/'.$item->id_produk.'_foto1.jpg') }}" alt="">
                                                            </div>
                                                        </td>
                                                        <td class="p-tb-4">
                                                            <a href="{{ route('shop.product.detail', ['id_product' => $item->id_produk]) }}" class="mtext-110 m-b-8 cl2">{{ $item->nama_produk }}</a>
                                                            <span class="stext-111 dis-block">x{{ $item->qty }}</span>
                                                            <span class="stext-111">Rp. {{ $item->qty * $item->harga }}</span>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach 
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div class="stext-111 cl3 txt-center">Tidak ada</div>
                        @endif
                    </div>
                    <div class="tab-pane fade show" id="packaged" role="tabpanel">
                        @if ((count($history_orders) > 0) && (count($items['packaged']) > 0))
                            <div class="table-responsive">
                                @foreach ($history_orders as $order)
                                    @php $i = 0 @endphp
                                    @foreach ($items['packaged'] as $item)
                                        @if (($item->id_riwayat_pesanan === $order->id_riwayat_pesanan))
                                            @php $i++ @endphp
                                        @endif
                                    @endforeach
                                    @if ($i > 0)
                                    <div class="bor16 p-l-24 m-b-24">
                                        <div class="m-b-24 flex-sb">
                                            <span class="stext-111 cl3">{{ $order->tgl_pesan }}</span>
                                            <a href="{{ url('/customer/order/'.$order->id_riwayat_pesanan) }}" class="stext-111 cl3">Lihat rincian ></a>
                                        </div>
                                        <table>
                                            <tbody>
                                                @foreach ($items['packaged'] as $item)
                                                    @if (($item->id_riwayat_pesanan === $order->id_riwayat_pesanan))
                                                    <tr>
                                                        <td class="p-tb-4">
                                                            <div class="how-itemcart1">
                                                                <img src="{{ asset($item->path_foto.'/'.$item->id_produk.'_foto1.jpg') }}" alt="">
                                                            </div>
                                                        </td>
                                                        <td class="p-tb-4">
                                                            <a href="{{ route('shop.product.detail', ['id_product' => $item->id_produk]) }}" class="mtext-110 m-b-8 cl2">{{ $item->nama_produk }}</a>
                                                            <span class="stext-111 dis-block">x{{ $item->qty }}</span>
                                                            <span class="stext-111">Rp. {{ $item->qty * $item->harga }}</span>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach 
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div class="stext-111 cl3 txt-center">Tidak ada</div>
                        @endif
                    </div>
                    <div class="tab-pane fade show" id="shipping" role="tabpanel">
                        @if ((count($history_orders) > 0) && (count($items['shipping']) > 0))
                            <div class="table-responsive">
                                @foreach ($history_orders as $order)
                                    @php $i = 0 @endphp
                                    @foreach ($items['shipping'] as $item)
                                        @if (($item->id_riwayat_pesanan === $order->id_riwayat_pesanan))
                                            @php $i++ @endphp
                                        @endif
                                    @endforeach
                                    @if ($i > 0)
                                    <div class="bor16 p-l-24 m-b-24">
                                        <div class="m-b-24 flex-sb">
                                            <span class="stext-111 cl3">{{ $order->tgl_pesan }}</span>
                                            <a href="{{ url('/customer/order/'.$order->id_riwayat_pesanan) }}" class="stext-111 cl3">Lihat rincian ></a>
                                        </div>
                                        <table>
                                            <tbody>
                                                @foreach ($items['shipping'] as $item)
                                                    @if (($item->id_riwayat_pesanan === $order->id_riwayat_pesanan))
                                                    <tr>
                                                        <td class="p-tb-4">
                                                            <div class="how-itemcart1">
                                                                <img src="{{ asset($item->path_foto.'/'.$item->id_produk.'_foto1.jpg') }}" alt="">
                                                            </div>
                                                        </td>
                                                        <td class="p-tb-4 w-full">
                                                            <a href="{{ route('shop.product.detail', ['id_product' => $item->id_produk]) }}" class="mtext-110 m-b-8 cl2">{{ $item->nama_produk }}</a>
                                                            <span class="stext-111 dis-block">x{{ $item->qty }}</span>
                                                            <span class="stext-111">Rp. {{ $item->qty * $item->harga }}</span>
                                                        </td>
                                                        <td class="p-tb-4">
                                                            <form action="{{ route('shop.customer.order.status.update') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="id_order_item" value="{{ $item->id_order_item }}">
                                                                <button type="submit" class="bg1 size-102 hov-btn1 cl0 bor14 m-tb-16">Sudah Diterima</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach 
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div class="stext-111 cl3 txt-center">Tidak ada</div>
                        @endif
                    </div>
                    <div class="tab-pane fade show" id="rating" role="tabpanel">
                        @if ((count($history_orders) > 0) && (count($items['rating']) > 0))
                            <div class="table-responsive">
                                @foreach ($history_orders as $order)
                                    @php $i = 0 @endphp
                                    @foreach ($items['rating'] as $item)
                                        @if (($item->id_riwayat_pesanan === $order->id_riwayat_pesanan))
                                            @php $i++ @endphp
                                        @endif
                                    @endforeach
                                    @if ($i > 0)
                                    <div class="bor16 p-l-24 m-b-24">
                                        <div class="m-b-24 flex-sb">
                                            <span class="stext-111 cl3">{{ $order->tgl_pesan }}</span>
                                            <a href="{{ url('/customer/order/'.$order->id_riwayat_pesanan) }}" class="stext-111 cl3">Lihat rincian ></a>
                                        </div>
                                        <table>
                                            <tbody>
                                                @foreach ($items['rating'] as $item)
                                                    @if (($item->id_riwayat_pesanan === $order->id_riwayat_pesanan))
                                                    <tr>
                                                        <td class="p-tb-4">
                                                            <div class="how-itemcart1">
                                                                <img src="{{ asset($item->path_foto.'/'.$item->id_produk.'_foto1.jpg') }}" alt="">
                                                            </div>
                                                        </td>
                                                        <td class="p-tb-4 w-full">
                                                            <a href="{{ route('shop.product.detail', ['id_product' => $item->id_produk]) }}" class="mtext-110 m-b-8 cl2">{{ $item->nama_produk }}</a>
                                                            <span class="stext-111 dis-block">x{{ $item->qty }}</span>
                                                            <span class="stext-111">Rp. {{ $item->qty * $item->harga }}</span>
                                                        </td>
                                                        <td class="p-tb-4">
                                                            <a href="{{ route('shop.customer.order.review', ['id' => $item->id_order_item]) }}" class="bg1 size-102 hov-btn1 cl0 bor14 m-tb-16 p-lr-16 p-tb-12">Ulas</a>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach 
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div class="stext-111 cl3 txt-center">Tidak ada</div>
                        @endif
                    </div>
                    <div class="tab-pane fade show" id="finish" role="tabpanel">
                        @if ((count($history_orders) > 0) && (count($items['finish']) > 0))
                            <div class="table-responsive">
                                @foreach ($history_orders as $order)
                                    @php $i = 0 @endphp
                                    @foreach ($items['finish'] as $item)
                                        @if (($item->id_riwayat_pesanan === $order->id_riwayat_pesanan))
                                            @php $i++ @endphp
                                        @endif
                                    @endforeach
                                    @if ($i > 0)
                                    <div class="bor16 p-l-24 m-b-24">
                                        <div class="m-b-24 flex-sb">
                                            <span class="stext-111 cl3">{{ $order->tgl_pesan }}</span>
                                            <a href="{{ url('/customer/order/'.$order->id_riwayat_pesanan) }}" class="stext-111 cl3">Lihat rincian ></a>
                                        </div>
                                        <table>
                                            <tbody>
                                                @foreach ($items['finish'] as $item)
                                                    @if (($item->id_riwayat_pesanan === $order->id_riwayat_pesanan))
                                                    <tr>
                                                        <td class="p-tb-4">
                                                            <div class="how-itemcart1">
                                                                <img src="{{ asset($item->path_foto.'/'.$item->id_produk.'_foto1.jpg') }}" alt="">
                                                            </div>
                                                        </td>
                                                        <td class="p-tb-4">
                                                            <a href="{{ route('shop.product.detail', ['id_product' => $item->id_produk]) }}" class="mtext-110 m-b-8 cl2">{{ $item->nama_produk }}</a>
                                                            <span class="stext-111 dis-block">x{{ $item->qty }}</span>
                                                            <span class="stext-111">Rp. {{ $item->qty * $item->harga }}</span>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach 
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div class="stext-111 cl3 txt-center">Tidak ada</div>
                        @endif
                    </div>
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
    
    $('.main-menu > li:nth-child(3)').addClass('active-menu')
</script>
@endsection