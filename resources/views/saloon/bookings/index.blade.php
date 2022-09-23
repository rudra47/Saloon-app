@extends('admin.layouts.master')
@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">Booking List</h4>
            </div>
        </div>
        @include('admin.includes.validation_error')
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <table id="basic-btn" class="table table-striped table-bordered nowrap">
                            <thead>
                            <tr>
                                <th width="10%">#SL</th>
                                <th>Customer Name</th>
                                <th>Service Name</th>
                                <th>Price</th>
                                <th>Expected Time</th>
                                <th>Give Time</th>
                                <th>Transaction No</th>
                                <th>Status</th>
                                <th width="10%" class="text-center">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @if($bookings)
                                @foreach($bookings as $key => $booking)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $booking->customer->name }}</td>
                                        <td>{{ $booking->saloon_service->name }}</td>
                                        <td>{{ $booking->price }}</td>
                                        <td>{{ $booking->booking_apply_time }}</td>
                                        <td>{{$booking->booking_confirm_time}}</td>
                                        <td>{{$booking->transaction_no}}</td>
                                        <td>
                                            @if($booking->status == 0)
                                                <span class="text-warning">Pending</span> <br>
                                            @elseif($booking->status == 1)
                                                <span class="text-primary">Paid</span>
                                            @elseif($booking->status == 2)
                                                <span class="text-danger">Cancel</span>
                                            @elseif($booking->status == 3)
                                                <span class="text-success">Active</span>
                                            @elseif($booking->status == 4)
                                                <span class="text-success">Complete</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($booking->status != 2)
                                            <button type="button" class="btn-primary-1 formModalBtn"
                                                    {{!is_null($booking->booking_confirm_time) && $booking->status == 0 ? "disabled" : ''}}
                                                    modal-title="Booking Confirmation"
                                                    data-action="{{ route('app.saloon.bookings.confirmation', $booking->id) }}"
                                                    data-toggle="modal" data-target="#formModal"> Manage </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

@endsection
@push('style')
    @include('admin.includes.styles.datatable')
@endpush

@push('script')
    @include('admin.includes.scripts.datatable')
@endpush
