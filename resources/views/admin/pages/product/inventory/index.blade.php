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
                            <li class="active">Inventory Product</li>
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
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 2%;">No.</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Stock</th>
                                    <th class="text-center" style="width: 18%;" data-orderable="false">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($products as $product)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td class="text-center">{{ $product->stock }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.product.inventory.add', ['id' => $product->uuid]) }}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Add Stock"><i class="fa fa-plus"></i></a>
                                        <a href="{{ route('admin.product.inventory.history', ['id' => $product->uuid]) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="History Inventory"><i class="fa fa-clock-o"></i></a>
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

@section('js')
<script>
    function del(url)
    {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location = url
            }
        })
    }
</script>
@endsection