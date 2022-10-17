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
        <div class="row">
            <div class="col-sm-6">
                <h3>My Bookings</h3>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-success float-right" href="{{ route('bookings') }}" style="float: right;">View Pending Bookings <i class="bi-arrow-right"></i></a>
            </div>
        </div>
        <hr/>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>SL#</th>
                        <th>Service</th>
                        <th>Booking Price</th>
                        <th class="text-center">Booking Status</th>
                        <th>Booking Date</th>
                        <th>Saloon Schedule</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                @if(count($bookings)>0)
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $booking->name }}</td>
                        <td>BDT {{ $booking->price }}</td>
                        <td class="text-center">
                            @if($booking->status==0) 
                                <span style="color:red; border:1px solid red; font-size: 14px; padding: 5px; border-radius: 5px;">Pending</span> 
                            @elseif($booking->status==1) 
                                <span style="color:green; border:1px solid green; font-size: 14px; padding: 5px; border-radius: 5px;">Paid</span> 
                            @elseif($booking->status==2)
                                <span style="color:rgb(107, 5, 5); border:1px solid rgb(107, 5, 5); font-size: 14px; padding: 5px; border-radius: 5px;">Canceled</span>
                            @elseif($booking->status==3) 
                                <span style="color:green; border:1px solid green; font-size: 14px; padding: 5px; border-radius: 5px;">Active</span>
                            @elseif($booking->status==4)
                            <span style="color:green; border:1px solid green; font-size: 14px; padding: 5px; border-radius: 5px;">Completed</span> 
                            @endif</td>
                        <td>{{ $booking->booking_apply_time != NULL ? date('d-m-Y g:ia', strtotime($booking->booking_apply_time)) : '' }}</td>
                        <td>
                            @if(!is_null($booking->booking_confirm_time))
                            {{ date('d-m-Y g:ia', strtotime($booking->booking_confirm_time)) }}
                            @endif
                        </td>
                        <td class="text-center">
                            @if($booking->status==0)
                                @if($booking->booking_confirm_time != NULL && $booking->booking_confirm_time != '')
                                    <button type="button" class="btn btn-primary formModalBtn"
                                        modal-title="30% Payment Transaction Proof"
                                        data-action="{{ route('bookings.confirmation', $booking->id) }}"
                                        data-toggle="modal" data-target="#formModal"> Ok, Confirm </button>
                                @endif
                                <a class="btn btn-danger" href="{{ route('bookings.cancel', $booking->id) }}"><i class="bi-x-lg me-1"> Cancel</a>
                            @elseif($booking->status==1)
                                <span class="text-success">Paid</span>
                            @else
                             - 
                            @endif
                        </td>
                    </tr>
                @endforeach
                @else
                    <tr class="text-center"><td colspan="5">No bookings found!</td></tr>
                @endif
                </tbody>
            </table>

    </div>
</section>
@endsection
@push('scripts')
<script>
    $('.formModalBtn').on('click', function (e) {
        e.preventDefault();
        $(".loader").show();
        let url = $(this).attr('data-action');
        let modalTitle = $(this).attr('modal-title');

        $("#formModalBody").html("");
        $("#formModalLabel").html("");
        $.ajax({
            url: url,
            method: 'get',
            dataType: 'html',
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                $('#formModalLabel').html(modalTitle);
                $('#formModalBody').html(response);
                $("#formModal").modal('show');
                $(".loader").hide();
            },
            error: function (response) {
            }
        });
    })

    $('.modal').on('mousedown mouseup click', '.multiselect-container', function(e) {
        e.preventDefault();
    });

</script>
@endpush
