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
                            <li class="active">Edit Product</li>
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
                        <form action="{{ route('admin.product.store-edit') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="slug" value="{{ $product->slug }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="control-label mb-1">Product Name</label>
                                        <input type="text" id="name" name="name" class="form-control" value="{{ $product->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="price" class="control-label mb-1">Price</label>
                                        <input type="text" id="price" name="price" class="form-control" value="{{ $product->price }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fragrances" class="control-label mb-1">Fragrances (sparate with ", ")</label>
                                        <input type="text" id="fragrances" name="fragrances" class="form-control" value="{{ implode(', ', json_decode($product->fragrances)) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="file" class="control-label mb-1">Images</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile" name="image">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="size" class="control-label mb-1">Size (ml)</label>
                                                <input type="text" id="size" name="size" class="form-control" value="{{ $product->size }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="weight" class="control-label mb-1">Weight (kg)</label>
                                                <input type="text" id="weight" name="weight" class="form-control" value="{{ $product->weight }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="box" class="control-label mb-1">Box</label>
                                        <input type="text" id="box" name="box" class="form-control" value="{{ $product->box }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="control-label mb-1">Description</label>
                                        <textarea name="description" id="description" rows="9" class="form-control">{!! $product->description !!}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-lg btn-primary btn-block">
                                        <i class="fa fa-save"></i>&nbsp;
                                        <span>Save Category</span>
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

@section('js')
<script>    
    ClassicEditor
    .create(document.querySelector('#description'))
    .catch(error => {
        console.log(error)
    })
</script>
@endsection