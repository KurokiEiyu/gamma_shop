@extends('shop.layout.app')

@section('title', env("APP_NAME").' - Tambah Produk Baru')

@section('content')
@include('shop.layout.header')

<div class="container p-tb-24">
    <div class="row">
        <div class="col-12">
            <h4 class="mtext-109 cl2 p-b-30">
                Tambah Produk Baru
            </h4>
            @if ($errors->any())
            <div class="p-tb-16 p-lr-24 bor10 m-b-12 alert alert-danger">
                {{ $errors->first() }}
            </div>
            @endif
            <form action="{{ route('shop.seller.product.add_process') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="bor8 bg0 m-b-12">
                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="nama_produk" placeholder="Nama Produk">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg0 m-b-12">
                            <select class="stext-111 cl8 plh3 size-111 p-lr-15 bor8 bg0" name="kategori">
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id_kategori }}">{{ $category->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bor8 bg0 m-b-12">
                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="ukuran" placeholder="Ukuran">
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <div class="bor8 bg0 m-b-12">
                            <textarea class="bg0 w-full p-lr-15 p-tb-15" rows="10" name="deskripsi" placeholder="Deskripsi"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg0 m-b-12">
                            <label for="" class="cl2">Foto 1</label>
                            <input type="file" name="foto_1" id="" class="m-b-12">
                            <label for="" class="cl2">Foto 2 (Opsional)</label>
                            <input type="file" name="foto_2" id="" class="m-b-12">
                            <label for="" class="cl2">Foto 3 (Opsional)</label>
                            <input type="file" name="foto_3" id="" class="m-b-12">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bor8 bg0 m-b-12">
                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="number" name="stok" placeholder="Stok">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bor8 bg0 m-b-12">
                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="number" name="harga" placeholder="Harga">
                        </div>
                    </div>
                </div>
                <button type="submit" class="bg1 bor1 hov-btn1 p-lr-15 stext-101 cl0 size-101 m-t-12 pull-right">Tambah</button>
            </form>
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