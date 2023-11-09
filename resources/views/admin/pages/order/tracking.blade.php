@extends('admin.layouts.app')

@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left d-flex align-items-center">
                    <div class="page-title">
                        <a href="{{ route('admin.order') }}"><i class="fa fa-arrow-circle-o-left fa-lg"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('admin.order') }}">Orders</a></li>
                            <li class="active">{{ $order->id }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">
        <div class="col-md-12">
            <div class="row">
    
                <div class="card col-md-12">
                    <div class="card-body">
                        <form action="{{ route('admin.order.store-tracking') }}" method="post">
                            @csrf
                            <input type="hidden" name="uuid" value="{{ $order->uuid }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <label for="tracking" class="control-label mb-1">Tracking Number</label>
                                        <input type="text" id="tracking" name="tracking" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-lg btn-primary btn-block">
                                        <i class="fa fa-save"></i>&nbsp;
                                        <span>Save</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
</div>
@endsection
