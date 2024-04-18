@extends('front.layout.app')

@section('main_content')
<div class="page-top">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $terms_data->terms_heading }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-10 col-12">
                {!! $terms_data->terms_content !!}
            </div>
        </div>
    </div>
</div>
@endsection