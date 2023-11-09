@extends('admin.layouts.app')

@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left d-flex align-items-center">
                    <div class="page-title">
                        <a href="{{ route('admin.product') }}"><i class="fa fa-arrow-circle-o-left fa-lg"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('admin.product') }}">Products</a></li>
                            <li><a href="{{ route('admin.product.inventory') }}">Inventory Products</a></li>
                            <li class="active">Add Stock Product</li>
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
                        <form action="{{ route('admin.product.inventory.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->uuid }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <label for="value" class="control-label mb-1">Stock Product ({{ $product->product_name }})</label>
                                        <input type="number" id="value" name="value" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-lg btn-primary btn-block">
                                        <i class="fa fa-save"></i>&nbsp;
                                        <span>Add New Stock</span>
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
