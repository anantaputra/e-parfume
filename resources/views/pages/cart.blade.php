@extends('layouts.app')

@section('content')
    <section class="ftco-cart my-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-between align-items-center my-2">
                    <div>
                        <h4 class="font-weight-bold">Shopping Cart</h4>
                    </div>
                    <div class="mx-1">
                        {{ count($carts) }} items
                    </div>
                </div>
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list" style="overflow: hidden;">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @if (count($carts) > 0)
                                @foreach ($carts as $cart)
                                @php
                                    $total += $cart->product->price*$cart->quantity;
                                @endphp
                                <tr class="text-center">
                                    <td class="product-remove"><a href="{{ route('cart.delete', ['id' => $cart->uuid]) }}"><span class="ion-ios-close"></span></a></td>
                        
                                    <td class="image-prod"><div class="img" style="background-image:url('{{ str_contains(json_decode($product->images)[0], "http") ? json_decode($product->images)[0] : asset('storage/'.json_decode($product->images)[0]) }}');"></div></td>
                        
                                    <td class="product-name">
                                        <h3>{{ ucwords($cart->product->name) }}</h3>
                                    </td>
                        
                                    <td class="price">Rp {{ number_format($cart->product->price, 0, 0, '.') }}</td>
                        
                                    <td class="quantity">
                                        <div class="input-group mb-3">
                                            <input type="text" name="quantity" class="quantity form-control input-number" value="{{ $cart->quantity }}" min="1" max="100">
                                        </div>
                                    </td>
                        
                                    <td class="total">Rp {{ number_format($cart->product->price*$cart->quantity, 0, 0, '.') }}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr class="text-center">
                                    <td colspan="6">Your cart is empty</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <div class="d-flex justify-content-between total-price">
                            <div class="font-weight-bold">Total</div>
                            <div class="font-weight-bold">
                                Rp {{ number_format($total, 0, 0, '.') }}
                            </div>
                        </div>
                    </div>
                    <p class="text-center"><a href="{{ route('checkout') }}" class="btn btn-primary py-3 px-4" style="border-radius: 0;">Proceed to Checkout</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection