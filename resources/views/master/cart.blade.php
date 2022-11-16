<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')

<title>Cart - Squid Market</title>

@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/cart.png')
            ); ?> width="15px" style="margin-top:-3px"> Cart</h5>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="alert alert-success text-center" role="alert" style="display: none">
            You have successfully added or changed your shopping cart content
        </div>
        <div class="account-card">
            <!-- <div class="row"> -->
            <form action="{{ route('post.savecart') }}" method="post" class="row d-flex justify-content-between">
                @csrf
                @forelse($products as $product)
                <div class="col-sm-12 col-md-12 col-lg-5 mb-3">
                    <p class="fw-bold">Order Details</p>
                    <div class="h-100">
                        <div class="feature-card border mb-0">
                            <div class="feature-media">
                                <a class="feature-image"
                                    href="{{ route('detailview', ['product' => $product['product_id']]) }}">
                                    <img src="{{ $product['image'] }}" alt="product" style="border-radius: 5px">
                                </a>
                            </div>
                            <div class="feature-content">
                                <p class="mb-1 fw-bolder"><a
                                        href="{{ route('detailview', ['product' => $product['product_id']]) }}">
                                        {{ $product['product_name'] }} </a></p>
                                <p class="mb-1">
                                    <a href="{{ route('seller', ['seller' => $product['seller']]) }}"
                                        class="text-dark">{{ $product['seller'] }}<a class="text-dark"
                                            href="{{ route('vendorproducts', ['vendor' => $product['seller_id']]) }}">({{ \App\Models\Product::totalfeaturedproductsofseller($product['seller_id']) }})</a>
                                        -
                                        @if($product['a']->totalRates() == 0)
                                        <img src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-grey.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($product['a']->totalRates() >= 1 )
                                        <img src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-yellow-fill.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($product['a']->totalRates() > 0.5)
                                        <img src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-halfup.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($product['a']->totalRates()
                                        < 0.5) <img src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-halfdown.png'
                                            )
                                        ); ?> width="18" height="18" alt="star" />
                                        @elseif($product['a']->totalRates() == 0.5)
                                        <img src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-half.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @endif
                                        @if($product['a']->totalRates() <= 1 ) <img src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-grey.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                            @elseif($product['a']->totalRates() >= 2 )
                                            <img src=<?php echo Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-yellow-fill.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @elseif($product['a']->totalRates() > 1.5)
                                            <img src=<?php echo Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-halfup.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @elseif($product['a']->totalRates()
                                            < 1.5) <img src=<?php echo Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-halfdown.png'
                                                )
                                            ); ?> width="18" height="18" alt="star" />
                                            @elseif($product['a']->totalRates() == 1.5)
                                            <img src=<?php echo Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-half.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @endif
                                            @if($product['a']->totalRates() <= 2 ) <img src=<?php echo Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-grey.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                                @elseif($product['a']->totalRates() >= 3 )
                                                <img src=<?php echo Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-yellow-fill.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @elseif($product['a']->totalRates() > 2.5)
                                                <img src=<?php echo Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-halfup.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @elseif($product['a']->totalRates()
                                                < 2.5) <img src=<?php echo Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-halfdown.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star" />
                                                @elseif($product['a']->totalRates() == 2.5)
                                                <img src=<?php echo Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-half.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @endif
                                                @if($product['a']->totalRates() <= 3 ) <img src=<?php echo Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-grey.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                    @elseif($product['a']->totalRates() >= 4 )
                                                    <img src=<?php echo Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-yellow-fill.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star">
                                                    @elseif($product['a']->totalRates() > 3.5)
                                                    <img src=<?php echo Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-halfup.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star">
                                                    @elseif($product['a']->seller->totalRates()
                                                    < 3.5) <img src=<?php echo Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-halfdown.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star" />
                                                    @elseif($product['a']->totalRates() == 3.5)
                                                    <img src=<?php echo Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-half.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star">
                                                    @endif
                                                    @if($product['a']->totalRates() <= 4 ) <img src=<?php echo Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-grey.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star">
                                                        @elseif($product['a']->totalRates() == 5)
                                                        <img src=<?php echo Converter::convert_into_base64(
                                                            public_path(
                                                                'img/icons/star-yellow-fill.png'
                                                            )
                                                        ); ?> width="18" height="18" alt="star">
                                                        @elseif($product['a']->totalRates() > 4.5)
                                                        <img src=<?php echo Converter::convert_into_base64(
                                                            public_path(
                                                                'img/icons/star-halfup.png'
                                                            )
                                                        ); ?> width="18" height="18" alt="star">
                                                        @elseif($product['a']->totalRates()
                                                        < 4.5) <img src=<?php echo Converter::convert_into_base64(
                                                            public_path(
                                                                'img/icons/star-halfdown.png'
                                                            )
                                                        ); ?> width="18" height="18" alt="star" />
                                                        @elseif($product['a']->totalRates() == 4.5)
                                                        <img src=<?php echo Converter::convert_into_base64(
                                                            public_path(
                                                                'img/icons/star-half.png'
                                                            )
                                                        ); ?> width="18" height="18" alt="star">
                                                        @endif
                                </p>
                                <!-- <div class="input-group mb-3">
                                    <span class="input-group-text">$</span>
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-text">.00</span>
                                </div> -->
                                <div class="form-group mb-1" style="position: relative">
                                    <img src="{{asset('img/XMR2.png')}}" width="40" height="40" alt="xmr"
                                        style="position: absolute; right: 3px; top: 2px">
                                    <input type="text" class="form-control" value="XMR" width="100%" readonly>
                                </div>
                                <?php if ($product['type'] == 'physical') {
                                    $value = 'Physical';
                                } else {
                                    if ($product['autofilled'] == '0') {
                                        $value = 'Digital';
                                    } else {
                                        $value = 'Digital | Autodispatch';
                                    }
                                } ?>
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{ $value }}" readonly>
                                </div>
                                @php
                                $user = auth()->user();
                                if($product['type'] == 'Physical') {
                                if ($product['ships_with'][3] != null) {
                                $delivery_method = [
                                $product['ships_with'][1] .
                                ' - Price ' .
                                number_format(
                                ($product['ships_price'][1] * $rates[$user->currency]) /
                                $rates[$product['a']->currency],
                                2
                                ) . ' ' .
                                $user->currency .
                                ' - ' .
                                $product['ships_time'][1] .
                                ' Days Average',
                                $product['ships_with'][2] .
                                ' - Price ' .
                                number_format(
                                ($product['ships_price'][2] * $rates[$user->currency]) /
                                $rates[$product['a']->currency],
                                2
                                ) . ' ' .
                                $user->currency .
                                ' - ' .
                                $product['ships_time'][2] .
                                ' Days Average',
                                $product['ships_with'][3] .
                                ' - Price ' .
                                number_format(
                                ($product['ships_price'][3] * $rates[$user->currency]) /
                                $rates[$product['a']->currency],
                                2
                                ) . ' ' .
                                $user->currency .
                                ' - ' .
                                $product['ships_time'][3] .
                                ' Days Average',
                                ];
                                } elseif ($product['ships_with'][2] != null) {
                                $delivery_method = [
                                $product['ships_with'][1] .
                                ' - Price ' .
                                number_format(
                                ($product['ships_price'][1] * $rates[$user->currency]) /
                                $rates[$product['a']->currency],
                                2
                                ) . ' ' .
                                $user->currency .
                                ' - ' .
                                $product['ships_time'][1] .
                                ' Days Average',
                                $product['ships_with'][2] .
                                ' - Price ' .
                                number_format(
                                ($product['ships_price'][2] * $rates[$user->currency]) /
                                $rates[$product['a']->currency],
                                2
                                ) . ' ' .
                                $user->currency .
                                ' - ' .
                                $product['ships_time'][2] .
                                ' Days Average',
                                ];
                                } elseif ($product['ships_with'][1] != null) {
                                $delivery_method = [
                                $product['ships_with'][1] .
                                ' - Price ' .
                                number_format(
                                ($product['ships_price'][1] * $rates[$user->currency]) /
                                $rates[$product['a']->currency],
                                2
                                ) . ' ' .
                                $user->currency .
                                ' - ' .
                                $product['ships_time'][1] .
                                ' Days Average',
                                ];
                                }
                                }
                                @endphp
                                @if($product['type'] == 'Physical')
                                <div class="form-group">
                                    <select class="form-select" aria-label="select"
                                        name="delivery_method_num{{$product['product_id']}}" readonly>
                                        @if(count($delivery_method) == 3)
                                        <option value="0" @if($product['delivery_method_num']==0) selected @endif>
                                            {{ $delivery_method[0] }}</option>
                                        <option value="1" @if($product['delivery_method_num']==1) selected @endif>
                                            {{ $delivery_method[1] }}</option>
                                        <option value="2" @if($product['delivery_method_num']==2) selected @endif>
                                            {{ $delivery_method[2] }}</option>
                                        @elseif(count($delivery_method) == 2)
                                        <option value="0" @if($product['delivery_method_num']==0) selected @endif>
                                            {{ $delivery_method[0] }}</option>
                                        <option value="1" @if($product['delivery_method_num']==1) selected @endif>
                                            {{ $delivery_method[1] }}</option>
                                        @elseif(count($delivery_method) == 1)
                                        <option value="0" @if($product['delivery_method_num']==0) selected @endif>
                                            {{ $delivery_method[0] }}</option>
                                        @endif
                                    </select>
                                </div>
                                @endif
                                <div class="form-group">
                                    <label class="fw-bold">Order Quantity(Total: {{ $product['a']->quantity }}):</label>
                                    <div class="d-flex align-items-center justify-content-around"> <input type="number"
                                            class="form-control" placeholder="1"
                                            name="quantity{{ $product['product_id'] }}"
                                            value="{{ $product['quantity'] }}">
                                        &nbsp;&nbsp;&nbsp;&nbsp;<span
                                            style="font-size:16px">{{ucfirst($product['mesure'])}}</span>&nbsp;&nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-3 mb-3">
                    <p class="fw-bold">NOTE / DELIVERY INFO</p>
                    <div class="h-100">
                        <textarea class="form-control" style="height: 310px;"
                            name="deliveryinfo{{ $product['product_id'] }}"
                            placeholder="Enter your delivery instructions and details here and click Save Changes. Squid Market will encrypt it with the vendor's Public PGP Key.">{{ $product['deliveryinfo'] }}</textarea>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-3 mb-3">
                    <p class="fw-bold">Order Action:</p>
                    <div class="product-card border rounded mb-0" style="padding:15px">
                        <p class="fw-bold mb-0">Order Type:</p>
                        @if($product['a']->paymethod == 'fe')
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="paymethod{{ $product['product_id'] }}" type="radio"
                                value="escrow" @if($product['paymethod']=='escrow' ) checked @endif)>
                            <label class="form-check-label" for="fe">ESCROW</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="paymethod{{ $product['product_id'] }}" type="radio"
                                value="fe" @if($product['paymethod']=='fe' ) checked @endif>
                            <label class="form-check-label" for="escrow">FINALIZE EARLY (FE)</label>
                        </div>
                        @else
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="paymethod{{ $product['product_id'] }}" type="radio"
                                value="escrow" checked>
                            <label class="form-check-label" for="fe">ESCROW</label>
                        </div>
                        @endif

                        <button type="submit" value="{{ $product['product_id'] }}" name="cartbtn"
                            class="btn btn-success btn-sm w-100 mt-3"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/edit.png')
                            ); ?> width="15px" style="margin-top:-3px">
                            Save Changes
                        </button>

                        <a href="{{ route('post.removetocart', ['product' => $product['product_id']]) }}"
                            class="btn btn-primary btn-sm w-100 mt-2"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/cart.png')
                            ); ?> width="15px" style="margin-top:-3px"> Remove Products</a>
                        <span class="cartwarning">To See Updated Price, Click Save Changes!</sapn>
                    </div>
                </div>
                <!-- </div> -->
                @empty
                <div>No Orders</div>
                @endforelse

                <div class="checkout-charge ms-auto me-0 border">
                    <ul>
                        <li>
                            <span>Total</span>
                            <span>{{ number_format($totalPrice, 2) }}
                                {{ auth()->user()->currency }}</span>
                        </li>
                    </ul>
                </div>
                <div class="checkout-proced mt-3 mb-3">
                    <a href="{{ route('home') }}" class="btn btn-danger"><img src=<?php echo Converter::convert_into_base64(
                        public_path('img/icons/home.png')
                    ); ?> width="15px" style="margin-top:-3px"> Continue Shopping</a>
                </div>
                @if(empty($products))
                <div class="checkout-proced mt-3 mb-3">
                    <a class=" btn btn-success inactive"><img src=<?php echo Converter::convert_into_base64(
                        public_path('img/icons/cart-check.png')
                    ); ?> width="15px" style="margin-top:-3px">
                        Continue to Checkout</a>
                </div>
                @else
                <div class="checkout-proced mt-3 mb-3">
                    <button type="submit" value="checkout" name="cartbtn" class="btn btn-success "><img src=<?php echo Converter::convert_into_base64(
                        public_path('img/icons/cart-check.png')
                    ); ?> width="15px" style="margin-top:-3px">
                        Continue to Checkout</button>
                </div>
                @endif
            </form>
        </div>
    </div>
</section>

@stop