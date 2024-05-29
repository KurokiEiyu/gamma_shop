@extends('shop.layout.app')

@section('title', env("APP_NAME").' - Daftar Pelapak')

@section('content')
@include('shop.layout.header')

<div class="bg0">
    <div class="container p-b-40">
        <div class="row flex-c">
            <div class="col-11 col-md-8 col-lg-6 bor10 p-tb-24 p-lr-32">
                <h4 class="mtext-109 txt-center m-b-24">Daftar Pelapak</h4>
                @if ($errors->any())
                <div class="p-tb-16 p-lr-24 bor10 m-b-12 alert alert-danger">
                    {{ $errors->first() }}
                </div>
                @endif
                <form action="{{ route('shop.seller.register_process') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="bor8 bg0 m-b-12">
                                <input type="text" class="stext-111 cl8 plh3 size-111 p-lr-16" placeholder="Nama Toko" name="nama_toko">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="bor8 bg0 m-b-12">
                                <input type="text" class="stext-111 cl8 plh3 size-111 p-lr-16" placeholder="Nama Pemilik" name="nama_pemilik">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="bor8 bg0 m-b-12">
                                <input type="text" class="stext-111 cl8 plh3 size-111 p-lr-16" placeholder="Nama Pengguna" name="nama_pengguna">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="bor8 bg0 m-b-12">
                                <input type="email" class="stext-111 cl8 plh3 size-111 p-lr-16" placeholder="Email" name="email">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="bor8 bg0 m-b-12">
                                <input type="text" class="stext-111 cl8 plh3 size-111 p-lr-16" placeholder="Telepon" name="telepon">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bor8 bg0 m-b-12">
                                <textarea class="stext-111 cl8 plh3 size-120 p-lr-16 p-tb-10" placeholder="Alamat" name="alamat"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12">
                                <select class="js-select2" name="jenis_kelamin">
                                    <option value="">Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="bor8 bg0 m-b-12">
                                <input type="password" class="stext-111 cl8 plh3 size-111 p-lr-16" placeholder="Kata Sandi" name="kata_sandi">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="bor8 bg0 m-b-12">
                                <input type="password" class="stext-111 cl8 plh3 size-111 p-lr-16" placeholder="Ketik Ulang Kata Sandi" name="konfirmasi_kata_sandi">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="stext-111 size-116 bg1 hov-btn1 p-lr-15 bor1 m-t-24 cl0">Daftar</button>
                    <hr>
                    <a href="{{ route('shop.seller.login') }}" class="m-t-12 m-b-0 stext-100 m-lr-auto cl6 dis-block">
                        Sudah punya akun? Masuk disini
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
    $('header').addClass('header-v4')
</script>
@endsection