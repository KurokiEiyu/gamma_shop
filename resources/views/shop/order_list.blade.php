@extends('shop.layout.app')

@section('title', env("APP_NAME").' - Permintaan Pesanan Baru')

@section('style')
<style>
    @media screen and (max-width: 767px) {
        .container {
            padding: 32px;
        }
    }
</style>
@endsection

@section('content')
    @include('shop.layout.header')

    <div class="container p-tb-32">
        <div class="row">
            <div class="col-12 bor10 p-tb-32">
                <span class="mtext-109 cl2">
                    {{ $store_name }}
                </span>
            </div>
            <div class="col-12 bor10 p-tb-24">
                <span class="mtext-109 cl2">
                    Permintaan Pesanan Baru
                </span>
                <div class="table-responsive m-t-24">
                    <table class="table-shopping-cart">
                        <tr class="table-head">
                            <th class="column-1">Produk</th>
                            <th class="column-2"></th>
                            <th class="column-1">Qty</th>
                            <th class="column-2">Total Bayar</th>
                            <th class="column-2">Alamat Pengiriman</th>
                            <th class="column-1">Status</th>
                            <th class="column-1">Update</th>
                        </tr>
                        @foreach ($order_list as $order)
                        <form action="{{ route('shop.seller.order.list.update') }}" method="post">
                            @csrf
                            <tr class="table-row">
                                <td class="column-1 p-tb-12">
                                    <div class="how-itemcart1">
                                        <img src="{{ asset($order->path_foto.$order->id_produk.'_foto1.jpg') }}" alt="IMG">
                                    </div>
                                </td>
                                <td class="column-2">{{ $order->nama_produk }}</td>
                                <td class="column-1">{{ $order->qty }}</td>
                                <td class="column-2">Rp. {{ $order->qty * $order->harga }}</td>
                                <td class="column-2">{{ $order->alamat_penerima }}</td>
                                <td class="column-1">
                                    <div class="rs1-select2 rs2-select2 bor8 bg0">
                                        <select class="js-select2" name="status">
                                            @if ($order->status === 'menunggu konfirmasi')
                                                <option value="menunggu konfirmasi" selected>Menunggu Konfirmasi</option>
                                                <option value="dikemas">Dikemas</option>
                                            @endif
                                            @if ($order->status === 'dikemas')
                                                <option value="dikemas" selected>Dikemas</option>
                                                <option value="dikirim">Dikirim</option>
                                            @endif
                                            @if ($order->status === 'dikirim')
                                                <option value="dikirim" selected>Dikirim</option>
                                            @endif
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </td>
                                <td class="column-1">
                                    <input type="hidden" name="id_order_item" value="{{ $order->id_order_item }}">
                                    <input type="hidden" name="id_produk" value="{{ $order->produk_id }}">
                                    <input type="hidden" name="qty" value="{{ $order->qty }}">
                                    <input type="hidden" name="old_status" value="{{ $order->status }}">
                                    <button type="submit" class="hov-btn1 stext-101 bg1 bor2 p-lr-15 cl0 p-tb-4"><i class="fa fa-save"></i></button>
                                </td>
                            </tr>
                        </form>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('shop.layout.footer')
@endsection

@section('script')
<script>
    $('header').addClass('header-v4')
    $('.main-menu > li:nth-child(4)').addClass('active-menu')
</script>
@endsection