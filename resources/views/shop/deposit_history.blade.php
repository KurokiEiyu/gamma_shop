@extends('shop.layout.app')

@section('title', env("APP_NAME").' - Riwayat Deposit')

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
                    Riwayat Deposit
                </span>
            </div>
            @foreach ($deposits as $deposit)
                <div class="col-12 bor10 p-tb-32">
                    <span class="dis-block cl3">{{ $deposit->tgl_deposit }}</span>
                    <span class="mtext-109">Rp. {{ $deposit->nominal }}</span>
                    <span class="dis-block">Status: <span class="cl1 text-capitalize">{{ $deposit->status }}</span></span>
                </div>
            @endforeach
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