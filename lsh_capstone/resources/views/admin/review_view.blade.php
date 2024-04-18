@extends('admin.layout.app')

@section('heading', 'Accommodation Reviews')

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
                                        <th>Accommodation</th>
                                        <th>Rate</th>
                                        <th>Customer</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=0; @endphp
                                    @foreach($reviews as $row)
                                    @php 
                                    $accommodation = \App\Models\Accommodation::where('id', $row->accommodation_id)->first();
                                    $customer = \App\Models\Customer::where('id', $row->customer_id)->first();
                                    $i++;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $accommodation->name }}</td>
                                        <td>
                                            @switch($row->rate)
                                                @case(1)
                                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                                    @break

                                                @case(2)
                                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                                    @break

                                                @case(3)
                                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                                    @break

                                                @case(4)
                                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                                    @break

                                                @case(5)
                                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                    @break

                                                @default
                                                    <span class="text-muted">Unknown</span>
                                            @endswitch
                                        </td>
                                        <td>{{ $customer->name }}</td>
                                        <td class="pt_10 pb_10">
                                            <button class="btn btn-info mb-1" data-toggle="modal" data-target="#exampleModal{{ $i }}" data-toggle="tooltip" data-placement="top" title="Detail">
                                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                            </button>
                                            <a href="{{ route('admin_review_delete', $row->id) }}" class="btn btn-danger mb-md-0 mb-1" onClick="return confirm('Are you sure you want to delete this review?');" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>

                                        <div class="modal fade" id="exampleModal{{ $i }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4">
                                                                <label class="form-label">Accommodation</label>
                                                            </div>
                                                            <div class="col-md-8">{{ $accommodation->name }}</div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4">
                                                                <label class="form-label">Rate</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                @switch($row->rate)
                                                                    @case(1)
                                                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                                        <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                                                        <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                                                        <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                                                        <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                                                        @break

                                                                    @case(2)
                                                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                                        <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                                                        <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                                                        <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                                                        @break

                                                                    @case(3)
                                                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                                        <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                                                        <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                                                        @break

                                                                    @case(4)
                                                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                                        <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
                                                                        @break

                                                                    @case(5)
                                                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                                        @break

                                                                    @default
                                                                        <span class="text-muted">Unknown</span>
                                                                @endswitch
                                                            </div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4">
                                                                <label class="form-label">Customer</label>
                                                            </div>
                                                            <div class="col-md-8">{{ $customer->name }}</div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4">
                                                                <label class="form-label">Review Heading</label>
                                                            </div>
                                                            <div class="col-md-8">{{ $row->review_heading }}</div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4">
                                                                <label class="form-label">Review Description</label>
                                                            </div>
                                                            <div class="col-md-8">{{ $row->review_description }}</div>
                                                        </div>
                                                    </div>                                    

                                                </div>
                                            </div>
                                        </div>
                                        
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
