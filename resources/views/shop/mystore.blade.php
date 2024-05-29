@extends('shop.layout.app')

@section('title', env("APP_NAME").' - Lapak Saya')

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
            <div class="col-12 bor10 p-tb-16">
                <a href="{{ route('shop.seller.transaksi') }}" class="stext-102 fs15 p-tb-4">Lihat Riwayat Transaksi ></a>
                <a href="{{ route('shop.seller.deposit.history') }}" class="stext-102 fs15 p-tb-4 m-l-12">Lihat Riwayat Deposit ></a>
                <a href="{{ route('shop.seller.withdraw.history') }}" class="stext-102 fs15 p-tb-4 m-l-12">Lihat Riwayat Withdraw ></a>
            </div>
            <div class="col-12 bor10 p-tb-32">
                <span class="mtext-109 cl2">
                    {{ $store_name }}
                </span>
                <a href="{{ route('shop.seller.store.edit') }}" class="stext-102 fs15 p-tb-4 dis-block"><i class="fa fa-pencil"></i> Ubah Informasi Toko</a>
            </div>
            <div class="col-12 bor10 p-tb-32">
                <span class="mtext-109 cl2">SALDO</span>
                    <div class="mtext-108">Rp. {{ $saldo }}</div>
                    <a href="{{ route('shop.seller.deposit') }}" class="stext-102 fs15 p-tb-4">Deposit</a>
                    <a href="{{ route('shop.seller.withdraw') }}" class="stext-102 fs15 p-tb-4 m-l-8">Withdraw</a>
            </div>
            <div class="col-12 col-md-6 col-lg-3 bor10 text-center p-tb-32">
                <span class="mtext-109 cl2 dis-block">Produk</span>
                <span class="mtext-109 cl3">{{ count($products) }}</span>
            </div>
            <div class="col-12 col-md-6 col-lg-3 bor10 text-center p-tb-32">
                <span class="mtext-109 cl2 dis-block">Produk Terjual</span>
                <span class="mtext-109 cl3">{{ $terjual }}</span>
            </div>
            <div class="col-12 col-md-6 col-lg-3 bor10 text-center p-tb-32">
                <span class="mtext-109 cl2 dis-block">Stok Gudang</span>
                <span class="mtext-109 cl3">{{ $stok }}</span>
            </div>
            <div class="col-12 col-md-6 col-lg-3 bor10 text-center p-tb-32">
                <span class="mtext-109 cl2 dis-block">Pendapatan</span>
                <span class="mtext-109 cl3">{{ $pendapatan }}</span>
            </div>
            <div class="col-12 bor10 p-tb-24">
                <a href="{{ route('shop.seller.product.add') }}" class="bg1 hov-btn1 stext-101 size-101 bor1 cl0 p-lr-15 p-tb-10">
                    <i class="fa fa-plus"></i> Tambah Produk Baru
                </a>
                <a href="{{ route('shop.seller.report') }}" target="_blank" class="bg1 hov-btn1 stext-101 size-101 bor1 cl0 p-lr-15 p-tb-10 m-l-16">
                    <i class="fa fa-file"></i> Laporan
                </a>
            </div>
            <div class="col-12 bor10 p-tb-24">
                <span class="mtext-109 cl2">
                    Produk Saya
                </span>
                <div class="table-responsive m-t-24">
                    <table class="table-shopping-cart">
                        <tr class="table-head">
                            <th class="column-1">No</th>
                            <th class="column-1">Gambar</th>
                            <th class="column-1">Nama Produk</th>
                            <th class="column-1">Stok</th>
                            <th class="column-1">Harga</th>
                            <th class="column-1">Edit</th>
                            <th class="column-1">Hapus</th>
                        </tr>
                        @php $no = 1 @endphp
                        @foreach ($products as $product)
                        <tr class="table-row">
                            <td class="column-1">{{ $no++ }}</td>
                            <td class="column-1 p-tb-12">
                                <div class="how-itemcart1">
                                    <img src="{{ asset($product->path_foto.$product->id_produk.'_foto1.jpg') }}" alt="IMG">
                                </div>
                            </td>
                            <td class="column-1">{{ $product->nama_produk }}</td>
                            <td class="column-1">{{ $product->stok }}</td>
                            <td class="column-1">Rp. {{ $product->harga }}</td>
                            <td class="column-1">
                                <a href="{{ route('shop.seller.product.edit', ['id' => $product->id_produk]) }}" class="hov-btn1 stext-101 size-101 bg1 bor2 p-lr-15 cl0 p-tb-4"><i class="fa fa-edit"></i></a>
                            </td>
                            <td class="column-1">
                                <form method="post" action="{{ route('shop.seller.product.delete_process')}}">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="id_produk" value="{{ $product->id_produk }}">
                                    <button type="submit" class="hov-btn1 stext-101 bg1 bor2 p-lr-15 cl0 p-tb-4"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
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
    $('.main-menu > li:nth-child(3)').addClass('active-menu')
</script>
@endsection