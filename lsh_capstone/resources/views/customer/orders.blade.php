@extends('customer.layout.app')

@section('heading', 'My Bookings')

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

                                    @php
                                    $order_detail = \App\Models\OrderDetail::where('order_no', $row->order_no)->first();
                                    $room = \App\Models\Room::where('id', $order_detail->room_id)->first();
                                    $accommodation = \App\Models\Accommodation::where('id', $room->accommodation_id)->first(); 
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->order_no }}</td>
                                        <td>{{ $row->payment_method }}</td>
                                        <td>{{ $row->booking_date }}</td>
                                        <td>{{ $row->paid_amount }}</td>
                                        <td class="pt_10 pb_10">
                                            <a href="{{ route('customer_invoice',$row->id) }}" class="btn btn-info mb-md-0 mb-1" data-toggle="tooltip" data-placement="top" title="Invoice"><i class="fa fa-sticky-note-o" aria-hidden="true"></i></a>
                                            <a href="{{ route('customer_review_add', $accommodation->id) }}" class="btn btn-success mb-md-0 mb-1" data-toggle="tooltip" data-placement="top" title="Rate Now"><i class="fa fa-star" aria-hidden="true"></i></a>
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
