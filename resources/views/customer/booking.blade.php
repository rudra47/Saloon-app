@extends('customer.layouts.app1')

@section('content')
<!-- Header-->
@include('admin.layouts.partials.preloader')
<!-- Section-->
<div class="container">
    <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6">
            @include('flash::message')
        </div>
    </div>
</div>
<section class="py-5" style="min-height: 780px;">
    <div class="container px-4 px-lg-5 mt-2">
        <h3>My Bookings</h3>
        <hr/>
            <table class="table table-hovered">
                <thead>
                    <tr>
                        <th>SL#</th>
                        <th>Service</th>
                        <th>Booking Status</th>
                        <th>Booking Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @if(count($bookings)>0)
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $booking->name }}</td>
                        <td>@if($booking->status==2) <span style="color:red">Pending</span> @elseif($booking->status==1) <span style="color:green">Accepted</span> @else <span style="color:rgb(107, 5, 5)">Rejected</span> @endif</td>
                        <td>{{ $booking->created_at }}</td>
                        <td></td>
                    </tr>
                @endforeach
                @else
                    <tr class="text-center"><td colspan="5">No services found!</td></tr>
                @endif
                </tbody>
            </table>
        
    </div>
</section>
@endsection