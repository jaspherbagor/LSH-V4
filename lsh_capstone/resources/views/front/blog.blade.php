@extends('front.layout.app')

@section('main_content')
<div class="page-top">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $global_page_data->blog_heading }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="blog-item">
    <div class="container">
        <div class="row">
            @foreach($post_all as $item)
            <div class="col-md-4">
                <div class="inner">
                    <div class="card blog-card mb-4">
                        <div class="photo card-photo">
                            <img src="{{ asset('uploads/'.$item->photo) }}" alt="" class="img-fluid">
                        </div>
                        <div class="text card-body">
                            <h2><a href="{{ route('single_post', $item->id) }}">{{ $item->heading }}</a></h2>
                            <div class="short-des">
                                <p>
                                    {!! $item->short_content !!}
                                </p>
                            </div>
                            <div class="button">
                                <a href="{{ route('single_post', $item->id) }}" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                {{ $post_all->links() }}
            </div>
        </div>
    </div>
</div>
@endsection