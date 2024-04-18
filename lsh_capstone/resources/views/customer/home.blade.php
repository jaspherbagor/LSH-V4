@extends('customer.layout.app')

@section('heading', 'Dashboard')

@section('main_content')
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <a href="{{ route('customer_order_view') }}">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fa fa-list-alt"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Completed Bookings</h4>
                    </div>
                    <div class="card-body">
                        {{ $total_completed_orders }}
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="fa fa-list-alt"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Pending Bookings</h4>
                </div>
                <div class="card-body">
                    {{ $total_pending_orders }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <section class="section">
            <div class="section-header">
                <h1>Recent Bookings</h1>
            </div>
        </section>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Order No</th>
                                            <th>Payment Method</th>
                                            <th>Booking Date</th>
                                            <th>Paid Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recent_orders as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->order_no }}</td>
                                            <td>{{ $row->payment_method }}</td>
                                            <td>{{ \Carbon\Carbon::createFromFormat('d/m/Y', $row->booking_date)->format('F d, Y') }}</td>
                                            <td>₱{{ number_format($row->paid_amount, 2) }}</td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('customer_invoice',$row->id) }}" class="btn btn-primary">Detail</a>
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
    </div>
</div>
@endsection