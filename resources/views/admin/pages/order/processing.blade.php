@extends('admin.layouts.app')

@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="d-flex justify-content-between align-items-center px-4 py-3">
            <div>Orders in Progress</div>
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 2%;">Order ID.</th>
                                    <th class="text-center">Customer Name</th>
                                    <th class="text-center">Total Amount</th>
                                    <th class="text-center">Shipping Courier</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center" style="width: 18%;" data-orderable="false">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td class="text-center">{{ $order->id }}</td>
                                    <td>{{ $order->customer->name }}</td>
                                    <td class="text-right">{{ number_format($order->total_amount, 0, 0, '.') }}</td>
                                    <td>{{ $order->courier }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.order.view', ['id' => $order->uuid]) }}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Detail Order"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('admin.order.tracking', ['id' => $order->uuid]) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Tracking Number"><i class="fa fa-truck"></i></a>
                                    </td>
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
