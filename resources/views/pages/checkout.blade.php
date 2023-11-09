@extends('layouts.app')

@if (Session::has('token'))
@section('css')
<script type="text/javascript"
src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
@endsection
@endif

@section('content')
    <section class="my-3 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 ftco-animate">
                    <form action="{{ route('checkout.store') }}" method="POST" class="billing-form">
                        @csrf
                        <h3 class="mb-4 billing-heading">Checkout order</h3>
                        <div class="row align-items-end">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ ucwords(auth()->user()->name) }}" placeholder="" required>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}" placeholder="" required>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">Province</label>
                                    <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="province" id="province" class="form-control" required>
                                            <option selected disabled>- Select Province -</option>
                                            @foreach ($provinces as $province)
                                            <option value="{{ $province->province_id ."|". $province->province }}">{{ $province->province }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">City</label>
                                    <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="city" id="city" class="form-control" required>
                                            <option selected disabled>- Select City -</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="streetaddress">Street Address</label>
                                    <input type="text" name="address" id="streetaddress" class="form-control" placeholder="House number and street name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="postcodezip">Postcode / ZIP *</label>
                                    <input type="text" name="zip" id="postcodezip" class="form-control" placeholder="" required>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="courier">Courier</label>
                                    <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="courier" id="courier" class="form-control" required>
                                            <option selected disabled>- Select Courier -</option>
                                            <option value="jne">JNE</option>
                                            <option value="tiki">TIKI</option>
                                            <option value="pos">POS INDONESIA</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shipping">Shipping Cost</label>
                                    <input type="text" name="shipping_cost" id="shipping" class="form-control" value="0" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5 pt-3 d-flex">
                            <div class="col-md-12 d-flex">
                                <div class="cart-detail cart-total bg-light p-3 p-md-4">
                                    <h3 class="billing-heading mb-4">Total</h3>
                                    <div class="d-flex row mb-3">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4 d-flex justify-content-end">
                                            Subtotal
                                        </div>
                                        <div class="col-md-4 d-flex justify-content-end">
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($carts as $cart)
                                            @php
                                                $total += $cart->quantity * $cart->product->price;
                                            @endphp
                                            @endforeach
                                            Rp {{ number_format($total, 0, 0, '.') }}
                                        </div>
                                    </div>
                                    <div class="d-flex row mb-3">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4 d-flex justify-content-end">
                                            Shipping
                                        </div>
                                        <div class="col-md-4 d-flex justify-content-end" id="shipping-total">
                                            Rp 0
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="d-flex row mb-3">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4 d-flex font-weight-bold justify-content-end">
                                            Total
                                        </div>
                                        <div class="col-md-4 d-flex font-weight-bold justify-content-end" id="total">
                                            Rp {{ number_format($total, 0, 0, '.') }}
                                        </div>
                                    </div>
                                    <input type="hidden" name="total" id="total-amount">
                                    <button type="submit" class="btn btn-primary py-3 px-4">Place an order</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @if (Session::has('token'))
    <form action="{{ route('transaction.store') }}" method="POST" id="submit_form">
        @csrf
        <input type="hidden" name="id" value="{{ Session::get('order')->uuid }}">
        <input type="hidden" name="json" id="json_callback">
    </form>
    @endif
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('select[name=province]').change(function() {
                var province = $(this).val().split("|")[0];
                $.get('/checkout/province/'+province, function(response) {
                    var element = `<option selected disabled>- Select City -</option>`
                    $.each(response, function(key, value) {
                        element += `<option value="${value.city_id}|${value.city_name}">${value.city_name}</option>`
                    });
                    $('select[name=city]').html(``);
                    $('select[name=city]').html(element);
                });
            });
            $('select[name=courier]').change(function() {
                var city = $("select[name=city]").val().split("|")[0];
                var courier = $(this).val();
                $.get('/checkout/shipping/'+city+'/'+courier, function(response) {
                    $('input[name=shipping_cost]').val(response)
                    $('input[name=total]').val(parseInt("{{ $total }}")+parseInt(response))
                    $('#shipping-total').html("Rp "+formatRupiah(response))
                    $('#total').html("Rp "+formatRupiah(parseInt("{{ $total }}")+parseInt(response)))
                });
            });
        })

        function formatRupiah(agk)
        {
            var angka = agk

            var	number_string = angka.toString(),
                sisa 	= number_string.length % 3,
                rupiah 	= number_string.substr(0, sisa),
                ribuan 	= number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return rupiah;
        }
    </script>

    @if (Session::has('token'))
    <script type="text/javascript">
        window.snap.pay('{{ Session::get("token") }}', {
            onSuccess: function(result){
                send_response_to_form(result);
            },
            onPending: function(result){
                send_response_to_form(result);
            },
            onError: function(result){
                send_response_to_form(result);
            },
            onClose: function(){
                send_response_to_form(result);
            }
        })
        function send_response_to_form(result) {
            document.getElementById('json_callback').value = JSON.stringify(result);
            document.querySelector('#submit_form').submit();
        }
    </script>
    @endif
@endsection