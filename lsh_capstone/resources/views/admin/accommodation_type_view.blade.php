@extends('admin.layout.app')

@section('heading', 'View Accommodation Types')

@section('right_top_button')
<a href="{{ route('admin_accommodation_type_add') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
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
                                        <th>Name</th>
                                        <th>Photo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($accommodation_types as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td><img src="{{ asset('uploads/'.$row->photo) }}" alt="accommodation_type_image" class="w_200"></td>
                                        <td class="pt_10 pb_10">
                                            <a href="{{ route('admin_accommodation_type_edit',$row->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <a href="{{ route('admin_accommodation_view',$row->id) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Accommodations">
                                                <i class="fa fa-building-o" aria-hidden="true"></i>
                                            </a>
                                            <a href="{{ route('admin_accommodation_type_delete',$row->id) }}" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete {{ $row->name }}?');" data-toggle="tooltip" data-placement="top" title="Delete">
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
