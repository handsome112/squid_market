<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')

<title>Checkout -Squid Market</title>

@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')

<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/cart-check.png')
            ); ?> width="15px" style="margin-top:-3px"> Checkout</h5>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="account-card">
            <h5 class="account-title">Checkout Details</h5>
            @forelse($products as $product)
            <div class="row mb-2">
                <div class="col-sm-12 col-md-5 col-lg-5 mb-3">
                    <div class="h-100">
                        <div class="feature-card border mb-0">
                            <div class="feature-media">
                                <a class="feature-image" href="#">
                                    <img src="{{ $product['image'] }}" alt="product" style="border-radius: 5px">
                                </a>
                            </div>
                            <div class="feature-content">
                                <span class="mb-0 fw-bold">Products:</span>
                                <span class="mb-0"> {{ $product['product_name'] }} </span><br>
                                <span class="mb-0 fw-bold">Order Amount:</span><span>
                                    {{$product['quantity']}} {{ ucfirst($product['mesure']) }}</span><br>
                                <span class="mb-0 fw-bold">Payment Currency : </span>
                                <span>XMR</span><br>
                                <span class="mb-0 fw-bold">Payment Method : </span>
                                <span>{{ ucfirst($product['paymethod']) }}</span><br>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                $user = auth()->user();
                if($product['type'] == 'Physical') {
                $delivery_method =
                $product['ships_with'][$product['delivery_method_num'] + 1] .
                ' - Price ' .
                number_format(
                ($product['ships_price'][$product['delivery_method_num'] + 1] * $rates[$user->currency]) /
                $rates[$product['a']->currency],
                2
                ) . ' ' .
                $user->currency .
                ' - ' .
                $product['ships_time'][$product['delivery_method_num'] + 1] .
                ' Days Average';
                }
                @endphp
                <div class="col-sm-12 col-md-3 col-lg-3 mb-3">
                    <div class="h-100">
                        <div class="product-card border rounded mb-0 h-100" style="padding:15px">
                            <span class="mb-0 fw-bold">Product Price :</span><span> {{ number_format($product['price'] * $rates[
                                    $user->currency] / $rates[$product['currency']], 2); }}
                                {{ $user->currency }}</span>
                            @if($product['type'] == 'Physical')
                            <p class="mb-0 fw-bold">Delivery Method :</p>
                            <p class="mb-0">{{ $delivery_method }}</p>
                            <div class="d-flex align-items-center ">
                                <span class="mb-0 fw-bold">Shipping Route : </span>&nbsp;
                                @php
                                $from = strtolower($product['ships_from']);
                                $to = strtolower($product['ships_to']);
                                @endphp
                                <span class="float-start">
                                    <img src=<?php echo Converter::convert_into_base64(
                                        public_path(
                                            'img/flags/' . $from . '.png'
                                        )
                                    ); ?> width="24px" height="14px" alt="Flag"
                                        title="{{ $product['a']->shipsFrom() }}"><img class="mx-1" src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/arrow-right-black.png'
                                            )
                                        ); ?> width="17px" style="margin-top:-3px"><img src=<?php echo Converter::convert_into_base64(
     public_path('img/flags/' . $to . '.png')
 ); ?> width="24px" height="14px" alt="Flag" title="{{ $product['a']->shipsTo() }}">
                                </span>
                            </div>
                            @endif
                            <p class="mb-0 fw-bold">Price Total:</span><span>
                                    {{ number_format($product['total'] * $rates[auth()->user()->currency] / $rates[$product['currency']], 2) }}
                                    {{ $user->currency }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                    <div class="h-100">
                        @if($product['deliveryinfo'] == "")
                        <div
                            class="product-card border rounded d-flex justify-content-center align-items-center h-100 mb-0 pt-5 pb-5">
                            <a href="{{ route('cart') }}" class="badge bg-danger">No delivery instuctions go back to
                                cart!</a>
                        </div>
                        @else
                        <div class="d-flex flex-column" style="margin-top:-26px">
                            <span style="font-weight:bold;font-size:16px">Address:</span>
                            <textarea class="form-control" name="address" style="min-height:150px"
                                readonly>{{ $product['deliveryinfo'] }}</textarea>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div>No Checkouts</div>
            @endforelse

            <div class="checkout-charge ms-auto me-0 border">
                <ul>
                    <li>
                        <span>Total</span>
                        <span>{{ number_format($totalPrice, 2) }} {{ $user->currency }}</span>
                    </li>
                </ul>
            </div>

            <form method="post" action="{{ route('post.checkout') }}">
                @csrf
                <div class="d-flex align-items-center justify-content-center mt-2">
                    <span>Your Pin : </span>
                    <input type="password" name="pin" placeholder="123456" class="form-control" style="width:300px" />
                </div>
                <div class="checkout-proced mt-3 mb-3">
                    <a href="{{ route('cart') }}" class="btn btn-danger"><img src=<?php echo Converter::convert_into_base64(
                        public_path('img/icons/cart-check.png')
                    ); ?> width="15px" style="margin-top:-3px"> Return to cart</a>
                </div>
                <div class="checkout-proced mt-3 mb-3">
                    <button class="btn btn-success" type="submit" value="balance" name="paybutton"><img src=<?php echo Converter::convert_into_base64(
                        public_path('img/icons/dolar-circle.png')
                    ); ?> width="15px" style="margin-top:-3px"> Pay with
                        Balance</button>
                </div>
                <div class="checkout-proced mt-3 mb-3">
                    <button class="btn btn-success" type="submit" value="direct" name="paybutton"><img src=<?php echo Converter::convert_into_base64(
                        public_path('img/icons/dolar-circle.png')
                    ); ?> width="15px" style="margin-top:-3px"> Direct Payment</button>
                </div>
            </form>
        </div>
    </div>
</section>

@stop