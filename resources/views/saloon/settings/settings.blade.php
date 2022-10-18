@extends('admin.layouts.master')
@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">Settings</h4>
            </div>
        </div>
        @include('admin.includes.validation_error')
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body m-t-10">
                    <div class="col-lg-12">
                        <form action="{{ route('app.saloon.settingsStore', $saloon->id) }}"
                            class="form-horizontal" method="post">
                            @csrf
                                <div class="form-group row">
                                    <label class="col-form-label">start time</label>
                                    <div class="col-lg-6 col-sm-12">
                                        <input type="time" class="form-control" value="{{$saloon->start_time}}" name="start_time" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label">end time</label>
                                    <div class="col-lg-6 col-sm-12">
                                        <input type="time" class="form-control" value="{{$saloon->end_time}}" name="end_time" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 offset-lg-3 col-sm-12">
                                    <input type="submit" class="btn btn-primary btn-sm">
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

