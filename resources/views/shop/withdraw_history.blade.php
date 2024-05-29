@extends('shop.layout.app')

@section('title', env("APP_NAME").' - Riwayat Withdraw')

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
            @foreach ($withdraws as $withdraw)
                <div class="col-12 bor10 p-tb-32">
                    <span class="dis-block cl3">{{ $withdraw->tgl_withdraw }}</span>
                    <span class="dis-block cl2">Atas Nama: {{ $withdraw->atas_nama }}</span>
                    <span class="dis-block cl2">No. Rekening: {{ $withdraw->no_rek_tujuan }}</span>
                    <span class="mtext-109">Rp. {{ $withdraw->nominal }}</span>
                    <span class="dis-block">Status: <span class="cl1 text-capitalize">{{ $withdraw->status }}</span></span>
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