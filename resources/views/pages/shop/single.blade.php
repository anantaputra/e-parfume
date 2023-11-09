@extends('layouts.app')

@section('content')
    <section class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 ftco-animate">
                    <a href="images/menu-2.jpg" class="image-popup"><img src="{{ str_contains(json_decode($product->images)[0], "http") ? json_decode($product->images)[0] : asset('storage/'.json_decode($product->images)[0]) }}" class="img-fluid" alt="Colorlib Template"></a>
                </div>
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3>{{ strtoupper($product->name) }}</h3>
                    <div class="rating d-flex">
                        <p class="text-left mr-4">
                            @php
                                $rating = $product->rating;
                                $no_star = 5 - $rating;
                            @endphp
                            @for ($i = 0; $i < $rating; $i++)
                            <a href="#"><span class="ion-ios-star"></span></a>
                            @endfor
                            @for ($i = 0; $i < $no_star; $i++)
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            @endfor
                        </p>
                        <p class="text-left">
                            <a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a>
                        </p>
                    </div>
                    <p class="price"><span>Rp {{ number_format($product->price, 0, 0, '.') }}</span></p>
                    <div class="d-flex mb-3">
                        <div class="font-weight-bold">Size :</div>
                        <div class="ml-2">{{ $product->size }} ml</div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="font-weight-bold">Fragrances :</div>
                        <div class="ml-2">{{ implode(', ', json_decode($product->fragrances)) }}</div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="font-weight-bold">Weight :</div>
                        <div class="ml-2">{{ $product->weight }} kg</div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="font-weight-bold">Box :</div>
                        <div class="ml-2">{{ $product->box }}</div>
                    </div>
                    {!! $product->description !!}
                    <form action="{{ route('cart.add') }}" method="post" id="cart-form">
                        @csrf
                        <input type="hidden" name="product" value="{{ $product->uuid }}">
                        <div class="row mt-4">
                            <div class="w-100"></div>
                            <div class="input-group col-md-6 d-flex mb-3">
                                <span class="input-group-btn mr-2">
                                    <button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
                                        <i class="ion-ios-remove"></i>
                                    </button>
                                </span>
                                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                                <span class="input-group-btn ml-2">
                                    <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                        <i class="ion-ios-add"></i>
                                    </button>
                                </span>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <p style="color: #000;">{{ $product->stock }} piece available</p>
                            </div>
                        </div>
                        <p><a role="button" onclick="event.preventDefault();
                            document.getElementById('cart-form').submit();" class="btn btn-black py-3 px-5 text-white">Add to Cart</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            var quantity = 0;
            $('.quantity-right-plus').click(function(e) {
                e.preventDefault();
                var quantity = parseInt($('#quantity').val());
                var stock = parseInt("{{ $product->stock }}");
                if(quantity < stock) {
                    $('#quantity').val(quantity + 1);
                }
            });

            $('.quantity-left-minus').click(function(e) {
                e.preventDefault();
                var quantity = parseInt($('#quantity').val());
                if(quantity > 0) {
                    $('#quantity').val(quantity - 1);
                }
            });
        });
    </script>
@endsection