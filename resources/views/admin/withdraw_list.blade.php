@extends('admin.layout.app')

@section('title', 'Riwayat Withdraw')

@section('content')
<div id="wrapper">
    @include('admin.layout.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            @include('admin.layout.navbar')
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Riwayat Withdraw</h1>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Database</h6>
                            </div>
                            <div class="card-body">
                                @foreach ($withdraws as $withdraw)
                                    <div class="border-bottom">
                                        <span class="d-block mb-2">{{ $withdraw->tgl_withdraw }}</span>
                                        <h5 style="color: black;">{{ $withdraw->nama_toko }}</h5>
                                        <h6>Jumlah withdraw: Rp. {{ $withdraw->nominal }}</h6>
                                        <h6>Transfer Ke: {{ $withdraw->atas_nama }}</h6>
                                        <h6>No. Rekening: {{ $withdraw->no_rek_tujuan }}</h6>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.layout.footer')
        </div>
    </div>
</div>
@include('admin.layout.scroll_to_top')
@endsection

@section('script')
<script>
    $('body').attr('id', 'page-top')

    $('ul.sidebar').find('li').each(function(i, e) {
        if (i === 9) {
            $(e).addClass('active')
        }
    })
</script>
@endsection