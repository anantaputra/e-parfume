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
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-2">Order ID</div>
                                        <div class="mb-2">Customer</div>
                                        <div class="mb-2">Courier</div>
                                        <div class="mb-2">Status</div>
                                        <div class="mb-2">Tracking Number</div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="mb-2">: {{ $order->id }}</div>
                                        <div class="mb-2">: {{ $order->customer->name }}</div>
                                        <div class="mb-2">: {{ $order->courier }}</div>
                                        <div class="mb-2">: {{ $order->status }}</div>
                                        <div class="mb-2">: {{ $order->tracking_number }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-2">Receiver</div>
                                        <div class="mb-2">Phone</div>
                                        <div class="mb-2">Email</div>
                                        <div class="mb-2">Address</div>
                                        <div class="mb-2">Zip/Postal Code</div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="mb-2">: {{ json_decode($order->shipping_detail)->name }}</div>
                                        <div class="mb-2">: {{ json_decode($order->shipping_detail)->phone }}</div>
                                        <div class="mb-2">: {{ json_decode($order->shipping_detail)->email }}</div>
                                        <div class="mb-2">: {{ json_decode($order->shipping_detail)->address.', '.explode("|", json_decode($order->shipping_detail)->city)[1].', '.explode("|", json_decode($order->shipping_detail)->province)[1] }}</div>
                                        <div class="mb-2">: {{ json_decode($order->shipping_detail)->zip }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 2%;">No.</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($order->details as $order)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td>{{ $order->cart->product->name }}</td>
                                    <td class="text-center">{{ $order->cart->quantity }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
