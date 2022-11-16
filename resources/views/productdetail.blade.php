@extends('master.main')
@section('content')

<title>{{$product->name}} - Squid Market</title>

@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5> {{ $product->category->name }} | {{ $product->name }} </h5>
        </div>
    </div>
</section>
@php
$rates = \App\Tools\Converter::currencyLatestPrice();
$currency_type = auth()->user()->currency;
@endphp
<section class="section">
    <div class="container">
        <div class="account-card">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-4 mb-3">
                    <div class="h-100">
                        <h5 class="account-title">Product Description</h5>
                        <textarea class="form-control" style="height: 250px;"
                            readonly>{{ $product->description }}</textarea>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4 mb-3">
                    <div class="h-100 detailimage">
                        <h5 class="account-title d-lg-block d-md-block d-none">&nbsp;</h5>
                        <div class="product-image">
                            <a href="#"><img src="{{ $product->image }}" alt="product"></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4 mb-3">
                    <div class="h-100">
                        <h5 class="account-title">Vendor Details</h5>
                        <div class="feature-card bg-dark text-white">
                            <div class="feature-media">
                                <a class="profile-image-2"
                                    href="{{ route('seller', ['seller' => $product->seller->username]) }}">
                                    <img src="{{ $product->seller->avatar }}" alt="user">
                                </a>
                            </div>
                            <div class="feature-content">
                                <p class="mb-0">Vendor:
                                    <a
                                        href="{{ route('seller', ['seller' => $product->seller->username]) }}">{{ $product->seller->username }}({{ \App\Models\Product::totalfeaturedproductsofseller($product->seller->id) }})</a>
                                </p>
                                <p class="mb-0">Squid Points: 1SP</p>
                                <div class="feature-rating">
                                    Rating:&nbsp;
                                    <div class="rating d-flex align-items-center">
                                        @if($product->seller->totalRates() == 0)
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-grey.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($product->seller->totalRates() >= 1 )
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-yellow-fill.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($product->seller->totalRates() > 0.5)
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-halfup.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($product->seller->totalRates()
                                        < 0.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-halfdown.png'
                                            )
                                        ); ?> width="18" height="18" alt="star" />
                                        @elseif($product->seller->totalRates() == 0.5)
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-half.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @endif
                                        @if($product->seller->totalRates() <= 1 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-grey.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                            @elseif($product->seller->totalRates() >= 2 )
                                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-yellow-fill.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @elseif($product->seller->totalRates() > 1.5)
                                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-halfup.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @elseif($product->seller->totalRates()
                                            < 1.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-halfdown.png'
                                                )
                                            ); ?> width="18" height="18" alt="star" />
                                            @elseif($product->seller->totalRates() == 1.5)
                                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-half.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @endif
                                            @if($product->seller->totalRates() <= 2 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-grey.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                                @elseif($product->seller->totalRates() >= 3 )
                                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-yellow-fill.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @elseif($product->seller->totalRates() > 2.5)
                                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-halfup.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @elseif($product->seller->totalRates()
                                                < 2.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-halfdown.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star" />
                                                @elseif($product->seller->totalRates() == 2.5)
                                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-half.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @endif
                                                @if($product->seller->totalRates() <= 3 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-grey.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                    @elseif($product->seller->totalRates() >= 4)
                                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-yellow-fill.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star">
                                                    @elseif($product->seller->totalRates() > 3.5)
                                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-halfup.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star">
                                                    @elseif($product->seller->totalRates()
                                                    < 3.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-halfdown.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star" />
                                                    @elseif($product->seller->totalRates() == 3.5)
                                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-half.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star">
                                                    @endif
                                                    @if($product->seller->totalRates() <= 4 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-grey.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star">
                                                        @elseif($product->seller->totalRates() == 5)
                                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                            public_path(
                                                                'img/icons/star-yellow-fill.png'
                                                            )
                                                        ); ?> width="18" height="18" alt="star">
                                                        @elseif($product->seller->totalRates() > 4.5)
                                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                            public_path(
                                                                'img/icons/star-halfup.png'
                                                            )
                                                        ); ?> width="18" height="18" alt="star">
                                                        @elseif($product->seller->totalRates()
                                                        < 4.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                            public_path(
                                                                'img/icons/star-halfdown.png'
                                                            )
                                                        ); ?> width="18" height="18" alt="star" />
                                                        @elseif($product->seller->totalRates() == 4.5)
                                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                            public_path(
                                                                'img/icons/star-half.png'
                                                            )
                                                        ); ?> width="18" height="18" alt="star">
                                                        @endif
                                                        <a
                                                            href="{{ route('detailfeedback', ['vendor' => $product->seller->id]) }}">({{ $product->seller->totalFeedbacks() }})</a>
                                    </div>
                                </div>
                                <p class="mb-0">Registered: {{ date('M Y', strtotime($product->seller->seller_since)) }}
                                </p>
                                <p>Total sales:
                                    {{ \App\Models\Product::totalfeaturedproductsofseller($product->seller->id) }}</p>
                                <a href="{{ route('newconversation', ['vendor' => $product->seller->id]) }}"
                                    class="product-add mb-2 mb-2">
                                    <img src="{{ asset('img/icons/messenger-black.png') }}" width="14px"
                                        style="margin-top:-3px;margin-right:2px">
                                    <span>Chat With Vendor</span>
                                </a>
                                <a href="{{ route('seller', ['seller' => $product->seller->username]) }}"
                                    class="product-add bg-danger text-white">
                                    <img src="{{ asset('img/icons/helpdesk.png') }}" width="14px"
                                        style="margin-top:-3px;margin-right:2px">
                                    <span>Vist Vendor Profile</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-4 mb-3">
                    <div class="h-100">
                        <h5 class="account-title">Terms & Conditions</h5>
                        <textarea class="form-control h-100" readonly>{{ $product->conditions }}</textarea>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4 mb-3">
                    <div class="h-100">
                        <div class="d-flex justify-content-between">
                            <h5 class="account-title">Product Details</h5>
                            <label for="toggle-report" class="text-danger">Report</label>
                            @include('includes.components.reportproduct')
                        </div>
                        <div class="user-form border rounded p-2">
                            <div class="form-group d-flex justify-content-between">
                                <label>Product Price:</label>
                                <div class="d-flex align-items-center">
                                    @php
                                    $ships_with = json_decode($product->ships_with, true);
                                    $ships_price = json_decode($product->ships_price, true);
                                    $ships_time = json_decode($product->ships_time, true);
                                    @endphp
                                    <span class="text-danger fw-bold"
                                        style="font-size:16px;margin-left:3px;margin-top:1px">
                                        {{ number_format($product->price * $rates[auth()->user()->currency] / $rates[$product->currency], 2) }}
                                        {{ auth()->user()->currency }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Total Amount:</label>
                                <input type="text" class="form-control"
                                    value="{{ $product->quantity }} {{ $product->mesure }}" readonly>
                            </div>
                            @if($product->type == 'Physical')
                            <div class="form-group">
                                <label>Select Shipping</label>
                                <select class="form-select" aria-label="Shipping select">
                                    @if($ships_with[3]) != null)
                                    <option value="1">{{$ships_with[1]}} - Price
                                        {{ number_format($rates[auth()->user()->currency] * $ships_price[1] / $rates[$product->currency], 2) }}
                                        {{ auth()->user()->currency }}
                                        -
                                        {{$ships_time[1]}}
                                        Days Average
                                    </option>
                                    <option value="2">{{$ships_with[2]}} - Price
                                        {{ number_format($rates[auth()->user()->currency] * $ships_price[2] / $rates[$product->currency], 2) }}
                                        {{ auth()->user()->currency }} -
                                        {{$ships_time[2]}}
                                        Days Average
                                    </option>
                                    <option value="3">{{$ships_with[3]}} - Price
                                        {{ number_format($rates[auth()->user()->currency] * $ships_price[3] / $rates[$product->currency], 2) }}
                                        {{ auth()->user()->currency }} -
                                        {{$ships_time[3]}}
                                        Days Average
                                    </option>
                                    @elseif($ships_with[2] != null)
                                    <option value="1">{{$ships_with[1]}} - Price
                                        {{ number_format($rates[auth()->user()->currency] * $ships_price[1] / $rates[$product->currency], 2) }}
                                        {{ auth()->user()->currency }} -
                                        {{$ships_time[1]}}
                                        Days Average
                                    </option>
                                    <option value="2">{{$ships_with[2]}} - Price
                                        {{ number_format($rates[auth()->user()->currency] * $ships_price[2] / $rates[$product->currency], 2) }}
                                        {{ auth()->user()->currency }} -
                                        {{$ships_time[2]}}
                                        Days Average
                                    </option>
                                    @else
                                    <option value="1">{{$ships_with[1]}} - Price
                                        {{ number_format($rates[auth()->user()->currency] * $ships_price[1] / $rates[$product->currency], 2) }}
                                        {{ auth()->user()->currency }} -
                                        {{$ships_time[1]}}
                                        Days Average
                                    </option>
                                    @endif
                                </select>
                            </div>
                            @endif
                            @if($product->type == 'Physical')
                            <div class="form-group d-flex justify-content-between">
                                <label>Shipping Route:</label>
                                @php
                                $from = strtolower($product->ships_from);
                                $to = strtolower($product->ships_to);
                                @endphp
                                @if($product->type == 'Physical')
                                <div class="d-flex align-items-center justify-content-center p-2">
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/flags/' . $from . '.png'
                                        )
                                    ); ?> width="28px" height="18px" alt="Flag"
                                        title="{{ $product->shipsFrom() }}"><img class="mx-1" src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/arrow-right-black.png'
                                            )
                                        ); ?> width="17px" style="margin-top:-3px"><img src=<?php echo \App\Tools\Converter::convert_into_base64(
     public_path('img/flags/' . $to . '.png')
 ); ?> width="28px" height="18px" alt="Flag" title="{{ $product->shipsTo() }}">
                                </div>
                                @endif
                            </div>
                            @endif
                            <div class="form-group d-flex justify-content-between">
                                <label>Payment System:</label>
                                @if($product->type=='Physical' and $product->paymethod=='escrow')
                                <span>Physical | Escrow</span>
                                @elseif($product->type=='Physical' and $product->paymethod=='fe')
                                <span>Physical | <span style="color:red">FE</span></span>
                                @elseif($product->autofilled=='1')
                                <span>Digital | Auto-Dispatch</span>
                                @elseif($product->type=='Digital' and $product->paymethod=='escrow')
                                <span>Digital | Escrow</span>
                                @elseif($product->type=='Digital' and $product->paymethod=='fe')
                                <span>Digital | <span style="color:red">FE</span></span>
                                @endif
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <label>Crypto Accepted:</label>
                                <img src="{{ asset('img/XMR2.png') }}" width="20" height="20" alt="xmr">

                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <label>Product Rating:</label>
                                <div class="rating">
                                    @if($product->totalRates() == 0)
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path('img/icons/star-grey.png')
                                    ); ?> width="18" height="18" alt="star">
                                    @elseif($product->totalRates() >= 1 )
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/star-yellow-fill.png'
                                        )
                                    ); ?> width="18" height="18" alt="star">
                                    @elseif($product->totalRates() > 0.5)
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path('img/icons/star-halfup.png')
                                    ); ?> width="18" height="18" alt="star">
                                    @elseif($product->totalRates()
                                    < 0.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/star-halfdown.png'
                                        )
                                    ); ?> width="18" height="18" alt="star" />
                                    @elseif($product->totalRates() == 0.5)
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path('img/icons/star-half.png')
                                    ); ?> width="18" height="18" alt="star">
                                    @endif
                                    @if($product->totalRates() <= 1 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path('img/icons/star-grey.png')
                                    ); ?> width="18" height="18" alt="star">
                                        @elseif($product->totalRates() >= 2 )
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-yellow-fill.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($product->totalRates() > 1.5)
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-halfup.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($product->totalRates()
                                        < 1.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-halfdown.png'
                                            )
                                        ); ?> width="18" height="18" alt="star" />
                                        @elseif($product->totalRates() == 1.5)
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-half.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @endif
                                        @if($product->totalRates() <= 2 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-grey.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                            @elseif($product->totalRates() >= 3 )
                                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-yellow-fill.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @elseif($product->totalRates() > 2.5)
                                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-halfup.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @elseif($product->totalRates()
                                            < 2.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-halfdown.png'
                                                )
                                            ); ?> width="18" height="18" alt="star" />
                                            @elseif($product->totalRates() == 2.5)
                                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-half.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @endif
                                            @if($product->totalRates() <= 3 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-grey.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                                @elseif($product->totalRates() >= 4 )
                                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-yellow-fill.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @elseif($product->totalRates() > 3.5)
                                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-halfup.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @elseif($product->totalRates()
                                                < 3.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-halfdown.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star" />
                                                @elseif($product->totalRates() == 3.5)
                                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-half.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @endif
                                                @if($product->totalRates() <= 4 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-grey.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                    @elseif($product->totalRates() == 5)
                                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-yellow-fill.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star">
                                                    @elseif($product->totalRates() > 4.5)
                                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-halfup.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star">
                                                    @elseif($product->totalRates()
                                                    < 4.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-halfdown.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star" />
                                                    @elseif($product->totalRates() == 4.5)
                                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-half.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star">
                                                    @endif
                                                    <a
                                                        href="{{ route('detailfeedback_p', ['product' => $product->id]) }}">({{ $product->totalFeedbacks() }})</a>
                                </div>
                            </div>
                            <form method="post" action="{{ route('post.favorites', ['product' => $product->id]) }}">
                                @csrf
                                <button class="product-add mb-2">
                                    @if(auth()->user()->isFavorite($product))
                                    <img src="{{ asset('img/icons/heart-fill.png') }}" width="16px"
                                        style="margin-right:2px"> Remove Favorites
                                    @else
                                    <img src="{{ asset('img/icons/heart.png') }}" width="16px" style="margin-right:2px">
                                    Add
                                    to Favorites
                                    @endif
                                </button>
                            </form>
                            <form method="post" action="{{ route('post.addtocart', ['product' => $product->id]) }}">
                                @csrf
                                <button class="product-add bg-success text-white">
                                    <img src="{{ asset('img/icons/cart.png') }}" width="16px" style="margin-right:2px">
                                    Add
                                    to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4 mb-3">
                    <div class="h-100">
                        <h5 class="account-title">Vendor Public PGP Key</h5>
                        <textarea class="form-control h-100" readonly>{{ $product->seller->pgp_key }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop