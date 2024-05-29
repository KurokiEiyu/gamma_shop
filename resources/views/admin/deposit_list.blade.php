@extends('admin.layout.app')

@section('title', 'Riwayat Deposit')

@section('content')
<div id="wrapper">
    @include('admin.layout.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            @include('admin.layout.navbar')
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Riwayat Deposit</h1>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Database</h6>
                            </div>
                            <div class="card-body">
                                @foreach ($deposits as $deposit)
                                    <div class="border-bottom">
                                        <span class="d-block mb-2">{{ $deposit->tgl_deposit }}</span>
                                        <h5 style="color: black;">{{ $deposit->nama_toko }}</h5>
                                        <h6>Jumlah Deposit: Rp. {{ $deposit->nominal }}</h6>
                                        <img class="my-2" src="{{ asset($deposit->bukti_transfer) }}" style="width: 100px; height: 100px;" alt="">
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
        if (i === 8) {
            $(e).addClass('active')
        }
    })
</script>
@endsection