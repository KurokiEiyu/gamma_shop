@extends('shop.layout.app')

@section('title', env("APP_NAME").' - Withdraw')

@section('content')
@include('shop.layout.header')

<div class="bg0">
    <div class="container p-b-40">
        <div class="row flex-c">
            <div class="col-11 col-md-8 col-lg-6 bor10 p-tb-24 p-lr-32">
                <h4 class="mtext-109 txt-center m-b-24">Withdraw</h4>
                @if ($errors->any())
                <div class="p-tb-16 p-lr-24 bor10 m-b-12 alert alert-danger">
                    {{ $errors->first() }}
                </div>
                @endif
                <form action="{{ route('shop.seller.withdraw.send') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="bor8 bg0 m-b-12">
                                <input type="text" class="stext-111 cl8 plh3 size-111 p-lr-16" placeholder="Nama Bank" name="nama_bank">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bor8 bg0 m-b-12">
                                <input type="text" class="stext-111 cl8 plh3 size-111 p-lr-16" placeholder="No. Rekening" name="no_rekening">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bor8 bg0 m-b-12">
                                <input type="text" class="stext-111 cl8 plh3 size-111 p-lr-16" placeholder="Nama Pemilik Rekening" name="atas_nama">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bor8 bg0 m-b-12">
                                <input type="number" class="stext-111 cl8 plh3 size-111 p-lr-16" placeholder="Nominal" name="nominal">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="stext-111 size-116 bg1 hov-btn1 p-lr-15 bor1 m-t-24 cl0">Ajukan</button>
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