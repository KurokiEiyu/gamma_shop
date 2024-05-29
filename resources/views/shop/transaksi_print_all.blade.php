@extends('shop.layout.app')

@section('title', env("APP_NAME").' - Laporan Transaksi')

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
<div class="container">
    @foreach ($transactions as $transaction)
        @php $total_bayar = 0 @endphp
        @foreach ($products as $product)
            @if ($product->id_transaksi === $transaction->id_transaksi)
                @php $total_bayar += $product->qty * $product->harga @endphp
            @endif
        @endforeach
        <div class="m-t-32">
            <div class="col-12 bor16 p-tb-12">
                <span class="dis-block cl3">Tanggal: {{ $transaction->tgl_pesan }}</span>
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
@endsection

@section('script')
<script>
    window.print()
</script>
@endsection