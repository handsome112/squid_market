<?php

namespace App\Tools; ?>
@extends('master.main')
@section('content')

<title>Home - Squid Market</title>
@include('master.homething')
<div style="margin-top:-40px;padding:0px">
    @include('includes.flash.validation')
    @include('includes.flash.success')
    @include('includes.flash.error')
</div>
<section class="section recent-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="text-uppercase h3">Featured Products</h2>
                </div>
            </div>
        </div>
        @php
        $rates = \App\Tools\Converter::currencyLatestPrice();
        $currency_type = auth()->user()->currency;
        @endphp
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6">
            @for($i = 1; $i <= 24; $i++) @php $slot=\App\Models\Slot::where('slotnum', $i)->first();
                @endphp
                @if(is_null($slot) or is_null($slot->product_id))
                @if(auth()->user()->isSeller() or auth()->user()->isAdmin() or auth()->user()->isModerator())
                @php
                $highestPrice = \App\Models\Bid::highestPrice($i);
                $bidCount = \App\Models\Bid::bids($i)
                @endphp
                <div class="col">
                    <div class="slot-card">
                        <div class="slot-header">
                            SLOT {{ $i }}
                        </div>
                        <div class="slot-body">
                            <span>Highest Bidder : {{ \App\Models\Bid::highestBidder($i) }} </span><br>
                            <span>Bids : {{ $bidCount }}</span><br>
                            <span>Highest Price :
                                {{ number_format($highestPrice * $rates[$currency_type] / $rates['USD'], 0) }}
                                {{ $currency_type }}</span><br>
                            <span>Time Left : @if($bidCount == 0) 24:00:00 @else
                                {{ \Carbon\Carbon::now()->subDays(config('general.days_bid_rankingconfig'))->diff(\App\Models\Bid::firstBid($i)->created_at)->format('%H:%I:%S') }}
                                @endif</span>
                        </div>
                        <div class="slot-footer">
                            <label for="toggle-bidding{{$i}}" class="product-add bg-success text-white">BID NOW</label>
                            <span>(You must deposit at least
                                {{ number_format($highestPrice * $rates[$currency_type] / $rates['USD'] + 1, 0) }}
                                {{ $currency_type }} as bid price.)</span>
                            @include('includes.components.biddingpanel')
                        </div>
                    </div>
                </div>
                @endif
                @else
                <div class="col">
                    <div class="product-card">
                        <div class="product-media">
                            <div class="product-label-lg">
                                <label class="label-text label-marquee" style="height:44px;">
                                    <a href="{{ route('detailview', ['product' => $slot->product->id]) }}"
                                        class="onlytworow">{{ $slot->product->name }}</a>
                                </label>
                            </div>
                            <a class="product-image"
                                href="{{ route('detailview', ['product' => $slot->product->id]) }}">
                                <img src="{{ $slot->product->image }}" alt="product">
                            </a>
                        </div>
                        <div class="product-content">
                            <div class="product-label-lg">
                                <a href="{{ route('seller', ['seller' => $slot->product->seller->username]) }}"
                                    class="label-text text">{{ $slot->product->seller->username }}({{ \App\Models\Product::totalfeaturedproductsofseller($slot->product->seller->id) }})
                                </a>
                            </div>
                            <div class="product-label-lg">
                                <label class="label-text gray"><i class="bi-coin"></i>
                                    @if($slot->product->type=='Physical' and $slot->product->paymethod=='escrow')
                                    <span>Physical | Escrow</span>
                                    @elseif($slot->product->type=='Physical' and $slot->product->paymethod=='fe')
                                    <span>Physical | <span style="color:red">FE</span></span>
                                    @elseif($slot->product->type=='Digital' and $slot->product->autofilled=='1')
                                    <span>Digital | Auto-Dispatch</span>
                                    @elseif($slot->product->type=='Digital' and $slot->product->paymethod=='escrow')
                                    <span>Digital | Escrow</span>
                                    @elseif($slot->product->type=='Digital' and $slot->product->paymethod=='fe')
                                    <span>Digital | <span style="color:red">FE</span></span>
                                    @endif
                                </label>
                            </div>
                            <div class="product-rating">
                                @if($slot->product->totalRates() == 0)
                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                    public_path('img/icons/star-grey.png')
                                ); ?> width="18" height="18" alt="star">
                                @elseif($slot->product->totalRates() >= 1 )
                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                    public_path(
                                        'img/icons/star-yellow-fill.png'
                                    )
                                ); ?> width="18" height="18" alt="star">
                                @elseif($slot->product->totalRates() > 0.5)
                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                    public_path('img/icons/star-halfup.png')
                                ); ?> width="18" height="18" alt="star">
                                @elseif($slot->product->totalRates()
                                < 0.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                    public_path('img/icons/star-halfdown.png')
                                ); ?> width="18" height="18" alt="star" />
                                @elseif($slot->product->totalRates() == 0.5)
                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                    public_path('img/icons/star-half.png')
                                ); ?> width="18" height="18" alt="star">
                                @endif
                                @if($slot->product->totalRates() <= 1 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                    public_path('img/icons/star-grey.png')
                                ); ?> width="18" height="18" alt="star">
                                    @elseif($slot->product->totalRates() >= 2 )
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/star-yellow-fill.png'
                                        )
                                    ); ?> width="18" height="18" alt="star">
                                    @elseif($slot->product->totalRates() > 1.5)
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path('img/icons/star-halfup.png')
                                    ); ?> width="18" height="18" alt="star">
                                    @elseif($slot->product->totalRates()
                                    < 1.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/star-halfdown.png'
                                        )
                                    ); ?> width="18" height="18" alt="star" />
                                    @elseif($slot->product->totalRates() == 1.5)
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path('img/icons/star-half.png')
                                    ); ?> width="18" height="18" alt="star">
                                    @endif
                                    @if($slot->product->totalRates() <= 2 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path('img/icons/star-grey.png')
                                    ); ?> width="18" height="18" alt="star">
                                        @elseif($slot->product->totalRates() >= 3 )
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-yellow-fill.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($slot->product->totalRates() > 2.5)
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-halfup.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($slot->product->totalRates()
                                        < 2.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-halfdown.png'
                                            )
                                        ); ?> width="18" height="18" alt="star" />
                                        @elseif($slot->product->totalRates() == 2.5)
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-half.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @endif
                                        @if($slot->product->totalRates() <= 3 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-grey.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                            @elseif($slot->product->totalRates() >= 4 )
                                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-yellow-fill.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @elseif($slot->product->totalRates() > 3.5)
                                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-halfup.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @elseif($slot->product->totalRates()
                                            < 3.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-halfdown.png'
                                                )
                                            ); ?> width="18" height="18" alt="star" />
                                            @elseif($slot->product->totalRates() == 3.5)
                                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-half.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @endif
                                            @if($slot->product->totalRates() <= 4 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-grey.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                                @elseif($slot->product->totalRates() == 5)
                                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-yellow-fill.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @elseif($slot->product->totalRates() > 4.5)
                                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-halfup.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @elseif($slot->product->totalRates()
                                                < 4.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-halfdown.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star" />
                                                @elseif($slot->product->totalRates() == 4.5)
                                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-half.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @endif
                                                <a
                                                    href="{{ route('detailfeedback_p', ['product' => $slot->product->id]) }}">({{ $slot->product->totalFeedbacks() }})</a>
                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/XMR2.png')
                                ); ?> width="20" height="20" alt="xmr">

                                <h6 class="product-price">
                                    {{ number_format($slot->product->price * $rates[$currency_type] / $rates[$slot->product->currency], 2) }}
                                    {{ $currency_type }}
                                </h6>
                            </div>
                            @php
                            $from = strtolower($slot->product->ships_from);
                            $to = strtolower($slot->product->ships_to);
                            @endphp
                            @if($slot->product->type == 'Physical')

                            <div class="d-flex align-items-center justify-content-center p-2">
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/flags/' . $from . '.png')
                                ); ?> width="28px" height="18px" alt="Flag"
                                    title="{{ $slot->product->shipsFrom() }}"><img class="mx-1" src=<?php echo Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/arrow-right-black.png'
                                        )
                                    ); ?> width="17px" style="margin-top:-3px"><img src=<?php echo Converter::convert_into_base64(
     public_path('img/flags/' . $to . '.png')
 ); ?> width="28px" height="18px" alt="Flag" title="{{ $slot->product->shipsTo() }}">
                            </div>
                            @else
                            <div style="padding:17px"></div>
                            @endif
                            <!-- <button class="product-add mb-2"><span>Add to Whishlist</span><i class="bi-heart"></i></button>
                        <button class="product-add bg-success text-white"><span>Add to Cart</span><i
                                class="bi-cart"></i></button> -->
                            <form method="post"
                                action="{{ route('post.favorites', ['product' => $slot->product->id]) }}">
                                @csrf
                                <button class="product-add mb-2">
                                    @if(auth()->user()->isFavorite($slot->product))
                                    <img src=<?php echo Converter::convert_into_base64(
                                        public_path('img/icons/heart-fill.png')
                                    ); ?> width="16px" style="margin-right:2px"> Remove Favorites
                                    @else
                                    <img src=<?php echo Converter::convert_into_base64(
                                        public_path('img/icons/heart.png')
                                    ); ?> width="16px" style="margin-right:2px"> Add
                                    to Favorites
                                    @endif
                                </button>
                            </form>
                            <form method="post"
                                action="{{ route('post.addtocart', ['product' => $slot->product->id]) }}">
                                @csrf
                                <button class="product-add bg-success text-white">
                                    <img src=<?php echo Converter::convert_into_base64(
                                        public_path('img/icons/cart.png')
                                    ); ?> width="16px" style="margin-right:2px"> Add
                                    to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
                @endfor
        </div>
    </div>
</section>



@stop