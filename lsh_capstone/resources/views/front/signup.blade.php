<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
        <meta name="description" content="">
        <title>Labason Safe Haven Login</title>        
		
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
    <body class="register-body-container px-2">
        <div class="page-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-4 py-4 px-4 register-container">
                        <div class="text-center">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('uploads/logo.png') }}" alt="" class="logo">
                            </a>
                            <h2 class="text-center mb-4 mt-3">Register Account</h2>  
                        </div>
                        <form action="{{ route('customer_signup_submit') }}" method="post">
                            @csrf
                            <div class="login-form">
                                <div class="mb-3">
                                    <label for="" class="form-label">Full Name</label>
                                    <input type="text" class="form-control form-input" name="name">
                                    @if($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Email Address</label>
                                    <input type="text" class="form-control form-input" name="email">
                                    @if($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" class="form-control form-input" name="password">
                                    @if($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control form-input" name="confirm_password">
                                    @if($errors->has('confirm_password'))
                                        <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3 text-center">
                                    <button type="submit" class="btn btn-primary bg-website">Submit</button>
                                </div>
                                <div class="mb-3">
                                    Already have an account?
                                    <a href="{{ route('customer_login') }}" class="primary-color"> Login instead.</a>
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