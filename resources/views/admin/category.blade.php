@extends('admin.layout.app')

@section('title', 'Kategori')

@section('content')
<div id="wrapper">
    @include('admin.layout.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            @include('admin.layout.navbar')
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Kategori</h1>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Database</h6>
                            </div>
                            <div class="card-body">
                                <a href="{{ url('/admin/data/category/add') }}" class="btn btn-primary mb-3"><i class="fa faw fa-plus"></i> Tambah</a>
                                <div class="table-responsive">
                                    <table class="table table-bordered datatable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Kategori</th>
                                                <th>Edit</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i = 1 @endphp
                                            @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $category->nama_kategori }}</td>
                                                <td><a href="{{ url('/admin/data/category/'.$category->id_kategori.'/edit') }}" class="btn btn-warning"><i class="fa faw fa-edit"></i></a></td>
                                                <td><button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $category->id_kategori }}"><i class="fa faw fa-trash"></i></button></td>
                                            </tr>
                                            @include('admin.modal.modal_delete_category', [
                                                'id_kategori' => $category->id_kategori
                                            ])
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
        if (i === 4) {
            $(e).addClass('active')
        }
    })
</script>
@endsection