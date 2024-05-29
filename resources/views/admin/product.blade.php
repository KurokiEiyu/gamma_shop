@extends('admin.layout.app')

@section('title', 'Produk')

@section('content')
<div id="wrapper">
    @include('admin.layout.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            @include('admin.layout.navbar')
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Produk</h1>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-5 order-md-2">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Total Produk</h6>
                            </div>
                            <div class="card-body">
                                <h1 class="text-center">{{ $jumlah_produk }}</h1>
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
                                                <th>Nama Produk</th>
                                                <th>Nama Toko</th>
                                                <th>Kategori</th>
                                                <th>Deskripsi</th>
                                                <th>Ukuran</th>
                                                <th>Harga</th>
                                                <th>Stok</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i = 1 @endphp
                                            @foreach($products as $product)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $product->nama_produk }}</td>
                                                <td>{{ $product->nama_toko }}</td>
                                                <td>{{ $product->nama_kategori }}</td>
                                                <td>{{ $product->deskripsi }}</td>
                                                <td>{{ $product->ukuran }}</td>
                                                <td>{{ $product->harga }}</td>
                                                <td>{{ $product->stok }}</td>
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
        if (i === 3) {
            $(e).addClass('active')
        }
    })
</script>
@endsection