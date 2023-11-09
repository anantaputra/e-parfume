@extends('admin.layouts.app')

@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="d-flex justify-content-between align-items-center px-4 py-3">
            <div>Manage Products</div>
            <div>
                <a href="{{ route('admin.product.add') }}" class="btn btn-primary">Add New Product [+]</a>
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
                                    <th class="text-center">Price</th>
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
                                    <td class="text-right">{{ number_format($product->price, 0, 0, '.') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('shop.single', ['slug' => $product->slug]) }}" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="View Product"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('admin.product.edit', ['slug' => $product->slug]) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit Product"><i class="fa fa-pencil-square-o"></i></a>
                                        <button onclick="del(`{{ route('admin.product.delete', ['slug' => $product->slug]) }}`)" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete Product">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
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