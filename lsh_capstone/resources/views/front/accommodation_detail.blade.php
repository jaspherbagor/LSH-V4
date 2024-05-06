@extends('front.layout.app')

@section('main_content')
<div class="page-top">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $accommodation_type->name }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="home-rooms">
    <div class="container">
        <div class="row">
            @foreach($accommodation_all as $item)
            <div class="col-md-3">
                <div class="inner">
                    <div class="card accommodation-card mb-4">
                        <div class="photo card-img-top">
                            <img src="{{ asset('uploads/'.$item->photo) }}" alt="" class="img-fluid">
                        </div>
                        <div class="text card-body">
                            <h2><a href="{{ route('room',$item->id) }}">{{ $item->name }}</a></h2>
                            <div class="button">
                                <a href="{{ route('room',$item->id) }}" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> View Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection