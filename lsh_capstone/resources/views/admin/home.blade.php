@extends('admin.layout.app')

@section('heading', 'Dashboard')

@section('main_content')
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <a href="{{ route('admin_order_view') }}">
            <div class="card card-statistic-1">
                <div class="card-icon bg-website">
                    <i class="fa fa-cart-plus"></i>
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
        <a href="{{ route('admin_order_view') }}">
            <div class="card card-statistic-1">
                <div class="card-icon bg-website">
                    <i class="fa fa-shopping-cart"></i>
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
        </a>  
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <a href="{{ route('admin_customer') }}">
            <div class="card card-statistic-1">
                <div class="card-icon bg-website">
                    <i class="fa fa-user-plus"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Active Customers</h4>
                    </div>
                    <div class="card-body">
                        {{ $total_active_customers }}
                    </div>
                </div>
            </div>
        </a>     
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <a href="{{ route('admin_customer') }}">
            <div class="card card-statistic-1">
                <div class="card-icon bg-website">
                    <i class="fa fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pending Customers</h4>
                    </div>
                    <div class="card-body">
                        {{ $total_pending_customers }}
                    </div>
                </div>
            </div>
        </a>   
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <a href="{{ route('admin_accommodation_all') }}">
            <div class="card card-statistic-1">
                <div class="card-icon bg-website">
                    <i class="fa fa-home"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Accommodations</h4>
                    </div>
                    <div class="card-body">
                        {{ $total_accommodations }}
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <a href="{{ route('admin_subscriber_show') }}">
            <div class="card card-statistic-1">
                <div class="card-icon bg-website">
                    <i class="fa fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Subscribers</h4>
                    </div>
                    <div class="card-body">
                        {{ $total_subscribers }}
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <a href="{{ route('admin_subscriber_show') }}">
            <div class="card card-statistic-1">
                <div class="card-icon bg-website">
                    <i class="fa fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Apartments</h4>
                    </div>
                    <div class="card-body">
                        3
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <a href="{{ route('admin_subscriber_show') }}">
            <div class="card card-statistic-1">
                <div class="card-icon bg-website">
                    <i class="fa fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Hotels</h4>
                    </div>
                    <div class="card-body">
                        2
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <a href="{{ route('admin_subscriber_show') }}">
            <div class="card card-statistic-1">
                <div class="card-icon bg-website">
                    <i class="fa fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Boarding Houses</h4>
                    </div>
                    <div class="card-body">
                        2
                    </div>
                </div>
            </div>
        </a>
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
                                                <a href="{{ route('admin_invoice',$row->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                <a href="{{ route('admin_order_delete',$row->id) }}" class="btn btn-danger" onClick="return confirm('Are you sure?');" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
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