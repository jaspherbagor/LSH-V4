<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <link rel="icon" type="image/png" href="{{ asset('uploads/lsh_favicon_admin.svg') }}">

    <title>Admin Reset Password</title>

    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">

    @include('admin.layout.styles')

    @include('admin.layout.scripts')
</head>

<body>
<div id="app">
    <div class="main-wrapper">
        <section class="section">
            <div class="container container-login">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary border-box reset-password-card">
                            <div class="card-header card-header-auth">
                                <div class="text-center">
                                    <img src="{{ asset('uploads/logo.png') }}" alt="" class="logo">
                                </div>
                                <h4 class="text-center mt-3">Admin Reset Password</h4>
                            </div>
                            <div class="card-body card-body-auth">
                        <form method="POST" action="{{ route('admin_reset_password_submit') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <input type="hidden" name="email" value="{{ $email }}">
                                    @if(session()->get('error'))
                                        <div class="alert alert-danger">{{ session()->get('error') }}</div>
                                    @endif
                                    <div class="form-group">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror password-input" name="password" placeholder="Password" autofocus>
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control @error('confirm_password') is-invalid @enderror password-input" name="confirm_password" placeholder="Confirm Password">
                                        @error('confirm_password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@include('admin.layout.scripts_footer')

</body>
</html>