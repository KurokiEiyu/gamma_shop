@extends('shop.layout.app')

@section('title', env("APP_NAME").' - Login Pelapak')

@section('content')
@include('shop.layout.header')

<div class="bg0 h-full">
    <div class="container h-full">
        <div class="row dis-flex flex-c-m h-full">
            <div class="col-11 col-md-6 col-lg-4 bor10 p-tb-24 p-lr-32">
                <h4 class="mtext-109 txt-center m-b-24">Pelapak</h4>
                @if ($errors->any())
                <div class="p-tb-16 p-lr-24 bor10 m-b-12 alert alert-danger">
                    {{ $errors->first() }}
                </div>
                @endif
                <form action="{{ route('shop.seller.login.auth') }}" method="post">
                    @csrf
                    <div class="bor8 bg0 m-b-12">
                        <input type="text" class="stext-111 cl8 plh3 size-111 p-lr-16" name="nama_pengguna" placeholder="Nama Pengguna">
                    </div>
                    <div class="bor8 bg0 m-b-12">
                        <input type="password" class="stext-111 cl8 plh3 size-111 p-lr-16" name="kata_sandi" placeholder="Kata Sandi">
                    </div>
                    <button type="submit" class="stext-111 size-116 bg1 hov-btn1 p-lr-15 bor1 m-t-24 cl0">Login</button>
                    <hr>
                    <a href="{{ route('shop.seller.register') }}" class="m-t-12 m-b-0 stext-100 m-lr-auto cl6 dis-block">
                        Belum punya akun? Daftar disini
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@include('shop.layout.footer')
@endsection

@section('script')
<script>
    $('.main-menu > li:nth-child(4)').addClass('active-menu')
    $('header').addClass('header-v4')
</script>
@endsection