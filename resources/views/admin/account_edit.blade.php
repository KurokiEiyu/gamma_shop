@extends('admin.layout.app')

@section('title', 'Edit Admin')

@section('content')
<div id="wrapper">
    @include('admin.layout.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            @include('admin.layout.navbar')
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Edit Admin</h1>
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
                    </a>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Form</h6>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    {{ $errors->first() }}
                                </div>
                                @endif
                                <form action="{{ route('admin.data.account.edit_process') }}" class="user" method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="id_admin" value="{{ $account->id_admin }}">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control form-control-user" placeholder="Nama Lengkap" name="nama_lengkap" value="{{ $account->nama_lengkap }}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control form-control-user" placeholder="Nama Pengguna" name="nama_pengguna" value="{{ $account->nama_pengguna }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input type="email" class="form-control form-control-user" placeholder="Email" name="email" value="{{ $account->email }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input type="password" class="form-control form-control-user" placeholder="Kata Sandi" name="kata_sandi">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="Password" class="form-control form-control-user" placeholder="Ketik Ulang Kata Sandi" name="konfirmasi_kata_sandi">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary float-right mt-3"><i class="fa faw fa-save"></i> Simpan</button>
                                </form>
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
        if (i === 10) {
            $(e).addClass('active')
        }
    })
</script>
@endsection