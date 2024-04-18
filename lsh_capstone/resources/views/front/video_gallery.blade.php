@extends('front.layout.app')

@section('main_content')
<div class="page-top">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $global_page_data->video_gallery_heading }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="photo-gallery">
            <div class="row">
                @foreach($video_all as $item)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card video-gallery-card">
                        <div class="photo-thumb card-img-top">
                            <img src="http://img.youtube.com/vi/{{ $item->video_id }}/0.jpg" alt="">
                            <div class="bg"></div>
                            <div class="icon">
                                <a href="http://www.youtube.com/watch?v={{ $item->video_id }}" class="video-button"><i class="fa fa-play"></i></a>
                            </div>
                        </div>
                        <div class="photo-caption card-body">
                            {{ $item->caption }}
                        </div>
                    </div>
                </div>
                @endforeach


                <div class="col-md-12">
                    {{ $video_all->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection