@extends('admin.layouts.master')
@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">Update Configuration</h4>
            </div>
        </div>
        @include('admin.includes.validation_error')
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body m-t-10">
                    <form action="{{ route('admin.configurations.update') }}" method="post">
                        @csrf
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="min_order_amount" class="col-lg-3 col-sm-12 col-form-label">Minimum Order Amount</label>
                                <div class="col-lg-8 col-sm-12">
                                    <input type="number" id="min_order_amount" value="{{ $configuration->min_order_amount ?? old('min_order_amount') }}" class="form-control" name="min_order_amount" placeholder="Minimum Order Amount" autofocus required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="avoid_shipping_charge_for" class="col-lg-3 col-sm-12 col-form-label">Shipping Charge</label>
                                <div class="col-lg-8 col-sm-12">
                                    <input type="number" id="shipping_charge" value="{{ $configuration->shipping_charge ?? old('shipping_charge') }}" class="form-control" name="shipping_charge" placeholder="Shipping Charge Amount" autofocus required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="avoid_shipping_charge_for" class="col-lg-3 col-sm-12 col-form-label">Avoid Shipping Charge For</label>
                                <div class="col-lg-8 col-sm-12">
                                    <input type="number" id="avoid_shipping_charge_for" value="{{ $configuration->avoid_shipping_charge_for ?? old('avoid_shipping_charge_for') }}" class="form-control" name="avoid_shipping_charge_for" placeholder="Avoid Shipping Charge Amount" autofocus required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                    <button class="btn btn-primary waves-effect waves-lightml-2" type="submit">
                                        <i class="fa fa-save"></i> Submit
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
