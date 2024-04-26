<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
        <meta name="description" content="">
        <title>Labason Safe Haven Reset Password</title>        
		
        <link rel="icon" type="image/png" href="{{ asset('uploads/'.$global_setting_data->favicon) }}">

        @include('front.layout.styles')
        @include('front.layout.scripts')

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        {{-- Oswald Google Font Link CDN --}}
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">

        {{-- Montserrat Font --}}
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    </head>
    <body class="login-body-container px-2 d-flex align-items-center justify-content-center">

        
        <div class="page-content container-fluid">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-4 py-4 px-4 login-container">
                        <div class="text-center">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('uploads/logo.png') }}" alt="" class="logo">
                            </a>
                        </div>
                        <h2 class="text-center mb-4 mt-3">Reset Password</h2>     
                        <form action="{{ route('customer_reset_password_submit') }}" method="post">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">
                            <div class="login-form">
                                <div class="mb-3">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" class="form-control form-input @if($errors->has('password')) is-invalid @endif" name="password">
                                    @if($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Retype Password</label>
                                    <input type="password" class="form-control form-input @if($errors->has('retype_password')) is-invalid @endif" name="retype_password">
                                    @if($errors->has('retype_password'))
                                        <span class="text-danger">{{ $errors->first('retype_password') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3 text-center">
                                    <button type="submit" class="btn btn-primary bg-website">Update</button>
                                </div>
                            </div>
                        </form>
        
        
                    </div>
                </div>
            </div>
        </div>
		
        @if(session()->get('error'))
        <script>
        iziToast.error({
            title: '',
            position: 'topRight',
            message: '{{ session()->get('error') }}',
        });
        </script>
        @endif
        @if(session()->get('success'))
        <script>
        iziToast.success({
            title: '',
            position: 'topRight',
            message: '{{ session()->get('success') }}',
        });
        </script>
        @endif
   </body>
</html>