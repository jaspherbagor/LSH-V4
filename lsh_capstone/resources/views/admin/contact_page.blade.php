@extends('admin.layout.app')

@section('heading', 'Edit Contact Page')

@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_contact_page_update')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label class="form-label">Heading</label>
                                    <input type="text" class="form-control" name="contact_heading" value="{{ $contact_data->contact_heading }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Map Iframe Code</label>
                                    <textarea name="contact_map" class="form-control h_100" id="" cols="30" rows="10">{{$contact_data->contact_map }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Status</label>
                                    <select name="contact_status" class="form-control">
                                        <option value="1" @if($contact_data->contact_status === 1) selected @endif>Show</option>
                                        <option value="0" @if($contact_data->contact_status === 0) selected @endif>Hide</option>
                                    </select>
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