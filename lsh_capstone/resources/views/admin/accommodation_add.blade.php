@extends('admin.layout.app')

@section('heading', 'Add '.$accommodation_type->name)

@section('right_top_button')
<a href="{{ route('admin_accommodation_view', $accommodation_type->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i> View All</a>
@endsection

@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_accommodation_store', $accommodation_type->id)  }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label class="form-label">Photo *</label>
                                    <div>
                                        <input type="file" name="photo">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Name *</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Address *</label>
                                    <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" name="contact_number" value="{{ old('contact_number') }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Contact Email</label>
                                    <input type="text" class="form-control" name="contact_email" value="{{ old('contact_email') }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Map Iframe Code</label>
                                    <textarea name="map" class="form-control h_100" id="" cols="30" rows="10"></textarea>
                                </div>
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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