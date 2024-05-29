@extends('admin.layout.app')

@section('title', 'Pelapak')

@section('content')
<div id="wrapper">
    @include('admin.layout.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            @include('admin.layout.navbar')
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Pelapak</h1>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-5 order-md-2">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Total Akun</h6>
                            </div>
                            <div class="card-body">
                                <h1 class="text-center">{{ $jumlah_pelapak }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8 col-md-7 order-md-1">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Database</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered datatable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Toko</th>
                                                <th>Nama Pemilik</th>
                                                <th>Nama Pengguna</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Email</th>
                                                <th>Telepon</th>
                                                <th>Alamat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i = 1 @endphp
                                            @foreach($sellers as $seller)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $seller->nama_toko }}</td>
                                                <td>{{ $seller->nama_pemilik }}</td>
                                                <td>{{ $seller->nama_pengguna }}</td>
                                                <td>{{ $seller->jenis_kelamin }}</td>
                                                <td>{{ $seller->email }}</td>
                                                <td>{{ $seller->telepon }}</td>
                                                <th>{{ $seller->alamat }}</th>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
        if (i === 2) {
            $(e).addClass('active')
        }
    })
</script>
@endsection