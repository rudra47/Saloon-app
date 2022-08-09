@extends('admin.layouts.master')
@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">Add Service</h4>
            </div>
        </div>
        @include('admin.includes.validation_error')
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body m-t-10">
                    <form action="{{ route('app.saloon.service.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="saloon_id" value="{{$saloon_id}}">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="name" class="col-lg-2 col-sm-12 col-form-label">Name</label>
                                <div class="col-lg-6 col-sm-12">
                                    <input type="text" id="name" value="{{ old('name') }}" class="form-control" name="name" placeholder="Enter service name" autofocus required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-lg-2 col-sm-12 col-form-label">Price</label>
                                <div class="col-lg-6 col-sm-12">
                                    <input type="text" id="price" value="{{ old('price') }}" class="form-control" name="price" placeholder="Enter service price" autofocus required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-lg-2 col-sm-12 col-form-label">Discount Price</label>
                                <div class="col-lg-6 col-sm-12">
                                    <select class="form-control" name="discount_type" id="discount_type">
                                        <option value="">Select one</option>
                                        <option value="1">Flat</option>
                                        <option value="2">Percentage</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-lg-2 col-sm-12 col-form-label">Discount Price</label>
                                <div class="col-lg-6 col-sm-12">
                                    <input type="text" id="discount_price" value="{{ old('discount_price') }}" class="form-control" name="discount_price" placeholder="Enter Discount Price">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-lg-2 col-sm-12 col-form-label">Status</label>
                                <div class="col-lg-6 col-sm-12">
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                    <button class="btn btn-primary waves-effect waves-lightml-2" type="submit">
                                        <i class="fa fa-save"></i> Submit
                                    </button>
                                    <a class="btn btn-secondary waves-effect" href="{{ route('app.saloon.service.index') }}">
                                        <i class="fa fa-times"></i> Cancel
                                    </a>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
