@extends('admin.layout.app')

@section('heading', 'Customer Bookings')

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
                                        <th>Booking No</th>
                                        <th>Payment Method</th>
                                        <th>Booking Date</th>
                                        <th>Paid Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->order_no }}</td>
                                        <td>{{ $row->payment_method }}</td>
                                        <td>{{ \Carbon\Carbon::createFromFormat('d/m/Y', $row->booking_date)->format('F d, Y') }}</td>
                                        <td>₱{{ number_format($row->paid_amount, 2) }}</td>
                                        <td class="pt_10 pb_10">
                                            <a href="{{ route('admin_invoice',$row->id) }}" class="btn btn-primary mb-1" data-toggle="tooltip" data-placement="top" title="Detail">
                                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                            </a>
                                            <a href="{{ route('admin_order_delete',$row->id) }}" class="btn btn-danger mb-md-0 mb-1" onClick="return confirm('Are you sure you want to delete order?');" data-toggle="tooltip" data-placement="top" title="Delete">
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
