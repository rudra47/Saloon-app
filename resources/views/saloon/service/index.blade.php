@extends('admin.layouts.master')
@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">Service List</h4>
            </div>
        </div>
        @include('admin.includes.validation_error')
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('app.saloon.service.create') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> Add New Service</a>

                    <br>
                    <br>
                    <div class="dt-responsive table-responsive">
                        <table id="basic-btn" class="table table-striped table-bordered nowrap">
                            <thead>
                            <tr>
                                <th width="10%">#SL</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Status</th>
                                <th width="10%" class="text-center">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @if($services)
                                @foreach($services as $key => $service)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $service->name }}</td>
                                        <td>{{ $service->price }}</td>
                                        <td>
                                            @if($service->discount_type == 'Percentage')
                                                {{$service->discount_price}}%
                                            @else
                                                {{$service->discount_price}}tk
                                            @endif
                                        </td>
                                        <td>
                                            @if($service->status == 1)
                                                <label class="label label-success">Active</label>
                                            @else
                                                <label class="label label-danger">Inactive</label>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="#" onclick="return false;" class="dropdown-toggle dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item btn btn-sm btn-info" href="{{route('app.saloon.service.edit', $service->id)}}"><i class="fa fa-edit"></i> Edit</a>

                                                <form action="{{ route('app.saloon.service.destroy', $service->id) }}" id="delete-form-{{ $service->id }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="dropdown-item btn btn-sm btn-danger" onclick="return makeDeleteRequest(event, {{ $service->id }})" type="submit" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
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
