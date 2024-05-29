@extends('shop.layout.app')

@section('title', env("APP_NAME").' - Daftar Transaksi')

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
                <span class="mtext-109 cl2 dis-block m-b-32">
                    Daftar Transaksi
                </span>
                <a href="{{ route('shop.seller.transaksi.print.all') }}" target="_blank" class="hov-btn1 stext-101 size-101 bg1 bor2 p-lr-15 cl0 p-tb-4">Print Semua</a>
                @foreach ($transactions as $transaction)
                    @php $total_bayar = 0 @endphp
                    @foreach ($products as $product)
                        @if ($product->id_transaksi === $transaction->id_transaksi)
                            @php $total_bayar += $product->qty * $product->harga @endphp
                        @endif
                    @endforeach
                    <div class="m-t-32">
                        <div class="col-12 bor16 p-tb-12">
                            <a href="{{ route('shop.seller.transaksi.print', ['id' => $transaction->id_transaksi]) }}" target="_blank" class="hov-btn1 stext-101 size-101 bg1 bor2 p-lr-15 cl0 p-tb-4">Print</a>
                            <span class="dis-block cl3 m-t-8">Tanggal: {{ $transaction->tgl_pesan }}</span>
                            <span class="dis-block cl3">Alamat:</span>
                            <span class="dis-block cl3">{{ $transaction->alamat_penerima }}</span>
                            <span class="dis-block cl3">Total Bayar: Rp. {{ $total_bayar }}</span>
                            <span class="dis-block cl3">Metode Pembayaran: {{ $transaction->metode_pembayaran }}</span>
                            <span class="dis-block">Status: <span class="cl1 text-capitalize">{{ $transaction->status }}</span></span>
                            <div class="table-responsive m-t-24">
                                <table class="table-shopping-cart">
                                    <tr class="table-head">
                                        <th class="column-1">Produk</th>
                                        <th class="column-2"></th>
                                        <th class="column-1">Harga</th>
                                        <th class="column-1">Qty</th>
                                        <th class="column-2">Total Bayar</th>
                                    </tr>
                                    @foreach ($products as $product)
                                        @if ($product->id_transaksi === $transaction->id_transaksi)
                                            <tr class="table-row">
                                                <td class="column-1 p-tb-12">
                                                    <div class="how-itemcart1">
                                                        <img src="{{ asset($product->path_foto.$product->id_produk.'_foto1.jpg') }}" alt="IMG">
                                                    </div>
                                                </td>
                                                <td class="column-2">{{ $product->nama_produk }}</td>
                                                <td class="column-1">{{ $product->harga }}</td>
                                                <td class="column-1">{{ $product->qty }}</td>
                                                <td class="column-2">Rp. {{ $product->harga * $product->qty }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </table>
                            </div>
                        </div>
                @endforeach
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