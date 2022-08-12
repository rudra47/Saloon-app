@extends('admin.layouts.master')
@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">Saloon List</h4>
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
                                <th>Saloon Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th width="10%" class="text-center">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @if($saloons)
                                @foreach($saloons as $key => $saloon)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $saloon->name }}</td>
                                        <td>{{ $saloon->email }}</td>
                                        <td>{{ $saloon->phone }}</td>
                                        <td></td>
                                        <td>
                                            @if($saloon->status == 1)
                                                <span class="text-success">Active</span>
                                            @elseif($saloon->status == 2)
                                                <span class="text-warning">Pending</span>
                                            @else
                                                <span class="text-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn-primary-1 formModalBtn"
                                                    modal-title="Saloon Activation"
                                                    data-action="{{ route('app.admin.saloons.activation', $saloon->id) }}"
                                                    data-toggle="modal" data-target="#formModal"> Manage </button>
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
