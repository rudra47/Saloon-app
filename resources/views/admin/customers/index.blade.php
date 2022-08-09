@extends('admin.layouts.master')
@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">Customer List</h4>
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
                                <th>Email</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Status</th>
                                <th width="10%" class="text-center">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @if($customers)
                                @foreach($customers as $key => $customer)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{$customer->latitude}}</td>
                                        <td>{{$customer->longitude}}</td>
                                        <td>
                                            <span class="text-success">Active</span>
                                        </td>
{{--                                        <td class="text-center">--}}
{{--                                            <button type="button" class="btn-primary-1 formModalBtn"--}}
{{--                                                    modal-title="Booking Confirmation"--}}
{{--                                                    data-action="{{ route('app.saloon.bookings.confirmation', $customer->id) }}"--}}
{{--                                                    data-toggle="modal" data-target="#formModal"> Manage </button>--}}
{{--                                        </td>--}}
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
