@extends('customer.layout.app')

@section('heading', 'Edit Review')

@section('right_top_button')
<a href="{{ route('customer_review_view') }}" class="btn btn-primary"><i class="fa fa-eye"></i> View All</a>
@endsection

@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('customer_review_update', $review_data->accommodation_id) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label class="form-label">Heading</label>
                                    <input type="text" class="form-control" name="review_heading" value="{{ $review_data->review_heading }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Rate</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rate" value="1" {{ $review_data->rate == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="star1">
                                            <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                            <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                            <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                            <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                            <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rate" value="2" {{ $review_data->rate == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="star2">
                                            <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                            <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                            <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                            <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                            <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rate" value="3" {{ $review_data->rate == 3 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="star3">
                                            <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                            <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                            <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                            <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                            <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rate" value="4" {{ $review_data->rate == 4 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="star4">
                                            <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                            <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                            <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                            <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                            <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rate" value="5" {{ $review_data->rate == 5 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="star5">
                                            <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                            <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                            <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                            <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                            <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Description</label>
                                    <textarea name="review_description" class="form-control h_100"  cols="30" rows="10">{{ $review_data->review_description }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label"></label>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection