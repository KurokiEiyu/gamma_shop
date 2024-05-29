@extends('admin.layout.app')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image" ></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-5">Sepuh Admin</h1>
                                </div>
                                @if ($errors->any())
                                <div class="alert alert-danger m-b-12">
                                    {{ $errors->first() }}
                                </div>
                                @endif
                                <form class="user" action="{{ route('admin.login.auth') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="nama_pengguna" placeholder="Nama Pengguna">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="kata_sandi" placeholder="Kata Sandi">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block mt-5">
                                        Login
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="forgot-password.html"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('body').addClass('bg-gradient-primary')
</script>
@endsection