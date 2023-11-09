@extends('layouts.app')

@section('content')
    <section class="py-4">
    	<div class="container">
            <div class="d-flex justify-content-center my-3">
                <h3>Colection Products</h3>
            </div>
    		<div class="row">
    			<div class="col-md-12 order-md-last">
    				<div class="row">
						@foreach ($products as $product)
		    			<div class="col-sm-6 col-md-6 col-lg-4 ftco-animate">
		    				<div class="product">
		    					<a href="{{ route('shop.single', ['slug' => $product->slug]) }}" class="img-prod"><img class="img-fluid" src="{{ str_contains(json_decode($product->images)[0], "http") ? json_decode($product->images)[0] : asset('storage/'.json_decode($product->images)[0]) }}" alt="Colorlib Template">
		    						<div class="overlay"></div>
		    					</a>
		    					<div class="text py-3 px-3">
		    						<h3><a href="{{ route('shop.single', ['slug' => $product->slug]) }}">{{ $product->product_name }}</a></h3>
		    						<div class="d-flex">
		    							<div class="pricing">
				    						<p class="price"><span class="price-sale">{{ number_format($product->price, 0, 0, '.') }}</span></p>
				    					</div>
				    					<div class="rating">
			    							<p class="text-right">
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
			    						</div>
			    					</div>
			    					<p class="bottom-area d-flex px-3">
		    							<a href="#" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
		    							<a href="#" class="buy-now text-center py-2">Buy now<span><i class="ion-ios-cart ml-1"></i></span></a>
		    						</p>
		    					</div>
		    				</div>
		    			</div>
						@endforeach
		    		</div>
		    	</div>
    		</div>
    	</div>
    </section>
@endsection