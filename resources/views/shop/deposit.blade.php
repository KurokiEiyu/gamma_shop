@extends('shop.layout.app')

@section('title', env("APP_NAME").' - Deposit')

@section('content')
@include('shop.layout.header')

<div class="bg0">
    <div class="container p-b-40">
        <div class="row flex-c">
            <div class="col-11 col-md-8 col-lg-6 bor10 p-tb-24 p-lr-32">
                <h4 class="mtext-109 txt-center m-b-24">Deposit</h4>
                @if ($errors->any())
                <div class="p-tb-16 p-lr-24 bor10 m-b-12 alert alert-danger">
                    {{ $errors->first() }}
                </div>
                @endif
                <form action="{{ route('shop.seller.deposit.send') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12">
                                <select class="js-select2" name="rekening">
                                    <option value="">Rekening</option>
                                    @foreach ($rekenings as $rekening)
                                        <option value="{{ $rekening->id_rekening }}">{{ $rekening->nama_bank }} - {{ $rekening->atas_nama }} - {{ $rekening->no_rekening }}</option>
                                    @endforeach
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bor8 bg0 m-b-12">
                                <input type="number" class="stext-111 cl8 plh3 size-111 p-lr-16" placeholder="Nominal" name="nominal">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bg0 m-b-12">
                                <span class="cl2">Bukti Transfer</span>
                                <input type="file" name="bukti_transfer" class="stext-111 cl8 plh3 size-111">
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