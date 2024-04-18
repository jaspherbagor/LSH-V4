@extends('admin.layout.app')

@section('heading', 'View Photo')

@section('right_top_button')
<a href="{{ route('admin_photo_add') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
@endsection
@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example1">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Photo</th>
                                        <th>Caption</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($photos as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ asset('uploads/'.$row->photo) }}" alt="slide_image" class="w_200"></td>
                                        <td>{{ $row->caption }}</td>
                                        <td class="pt_10 pb_10">
                                            <a href="{{ route('admin_photo_edit',$row->id) }}" class="btn btn-primary mb-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <a href="{{ route('admin_photo_delete',$row->id) }}" class="btn btn-danger mb-1" onClick="return confirm('Are you sure you want to delete this photo?');" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
