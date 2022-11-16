<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')
<title>Wishlist - Squid Market</title>
@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')

@php
$rates = \App\Tools\Converter::currencyLatestPrice();
$currency_type = auth()->user()->currency;
@endphp
<section class="section mt-3 mb-0">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5 class="fw-bold"><img src="{{ asset('img/icons/helpdesk.png') }}" width="17px" style="margin-top:-3px">
                Wishlist and Favorites </h5>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="account-card">
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6">
                @forelse($favorites as $favorite)
                <div class="col">
                    <div class="product-card">
                        <div class="product-media">
                            <div class="product-label-lg">
                                <label class="label-text label-marquee" style="height:44px;">
                                    <a href="{{ route('detailview', ['product' => $favorite->product->id]) }}"
                                        class="onlytworow">{{ $favorite->product->name }}</a>
                                </label>
                            </div>
                            <a class="product-image"
                                href="{{ route('detailview', ['product' => $favorite->product->id]) }}">
                                <img src="{{ $favorite->product->image }}" alt="product">
                            </a>
                        </div>
                        <div class="product-content">
                            <div class="product-label-lg">
                                <a href="{{ route('seller', ['seller' => $favorite->product->seller->username]) }}"
                                    class="label-text text">{{ $favorite->product->seller->username }}({{ \App\Models\Product::totalfeaturedproductsofseller($favorite->product->seller->id) }})
                                </a>
                            </div>
                            <div class="product-label-lg">
                                <label class="label-text gray"><i class="bi-coin"></i>
                                    @if($favorite->product->type=='Physical' and
                                    $favorite->product->paymethod=='escrow')
                                    <span>Physical | Escrow</span>
                                    @elseif($favorite->product->type=='Physical' and
                                    $favorite->product->paymethod=='fe')
                                    <span>Physical | <span style="color:red">FE</span></span>
                                    @elseif($favorite->product->autofilled=='1')
                                    <span>Digital | Auto-Dispatch</span>
                                    @elseif($favorite->product->type=='Digital' and
                                    $favorite->product->paymethod=='escrow')
                                    <span>Digital | Escrow</span>
                                    @elseif($favorite->product->type=='Digital' and $favorite->product->paymethod=='fe')
                                    <span>Digital | <span style="color:red">FE</span></span>
                                    @endif
                                </label>
                            </div>
                            <div class="product-rating">
                                @if($favorite->product->totalRates() == 0)
                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                    public_path('img/icons/star-grey.png')
                                ); ?> width="18" height="18" alt="star">
                                @elseif($favorite->product->totalRates() >= 1 )
                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                    public_path(
                                        'img/icons/star-yellow-fill.png'
                                    )
                                ); ?> width="18" height="18" alt="star">
                                @elseif($favorite->product->totalRates() > 0.5)
                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                    public_path('img/icons/star-halfup.png')
                                ); ?> width="18" height="18" alt="star">
                                @elseif($favorite->product->totalRates()
                                < 0.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                    public_path('img/icons/star-halfdown.png')
                                ); ?> width="18" height="18" alt="star" />
                                @elseif($favorite->product->totalRates() == 0.5)
                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                    public_path('img/icons/star-half.png')
                                ); ?> width="18" height="18" alt="star">
                                @endif
                                @if($favorite->product->totalRates() <= 1 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                    public_path('img/icons/star-grey.png')
                                ); ?> width="18" height="18" alt="star">
                                    @elseif($favorite->product->totalRates() >= 2 )
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/star-yellow-fill.png'
                                        )
                                    ); ?> width="18" height="18" alt="star">
                                    @elseif($favorite->product->totalRates() > 1.5)
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path('img/icons/star-halfup.png')
                                    ); ?> width="18" height="18" alt="star">
                                    @elseif($favorite->product->totalRates()
                                    < 1.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/star-halfdown.png'
                                        )
                                    ); ?> width="18" height="18" alt="star" />
                                    @elseif($favorite->product->totalRates() == 1.5)
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path('img/icons/star-half.png')
                                    ); ?> width="18" height="18" alt="star">
                                    @endif
                                    @if($favorite->product->totalRates() <= 2 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path('img/icons/star-grey.png')
                                    ); ?> width="18" height="18" alt="star">
                                        @elseif($favorite->product->totalRates() >= 3 )
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-yellow-fill.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($favorite->product->totalRates() > 2.5)
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-halfup.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($favorite->product->totalRates()
                                        < 2.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-halfdown.png'
                                            )
                                        ); ?> width="18" height="18" alt="star" />
                                        @elseif($favorite->product->totalRates() == 2.5)
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-half.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @endif
                                        @if($favorite->product->totalRates() <= 3 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-grey.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                            @elseif($favorite->product->totalRates() >= 4 )
                                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-yellow-fill.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @elseif($favorite->product->totalRates() > 3.5)
                                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-halfup.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @elseif($favorite->product->totalRates()
                                            < 3.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-halfdown.png'
                                                )
                                            ); ?> width="18" height="18" alt="star" />
                                            @elseif($favorite->product->totalRates() == 3.5)
                                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-half.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @endif
                                            @if($favorite->product->totalRates() <= 4 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-grey.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                                @elseif($favorite->product->totalRates() == 5)
                                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-yellow-fill.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @elseif($favorite->product->totalRates() > 4.5)
                                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-halfup.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @elseif($favorite->product->totalRates()
                                                < 4.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-halfdown.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star" />
                                                @elseif($favorite->product->totalRates() == 4.5)
                                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-half.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @endif
                                                <a
                                                    href="{{ route('detailfeedback_p', ['product' => $favorite->product->id]) }}">({{ $favorite->product->totalFeedbacks() }})</a>
                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <img src="{{ asset('img/XMR2.png') }}" width="20" height="20" alt="xmr">
                                <h6 class="product-price">
                                    {{ number_format($favorite->product->price * $rates[$currency_type] / $rates[$favorite->product->currency], 2) }}
                                    {{ $currency_type }}</h6>
                            </div>
                            @php
                            $from = strtolower($favorite->product->ships_from);
                            $to = strtolower($favorite->product->ships_to);
                            @endphp
                            @if($favorite->product->type == 'Physical')

                            <div class="d-flex align-items-center justify-content-center p-2">
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/flags/' . $from . '.png')
                                ); ?> width="28px" height="18px" alt="Flag"
                                    title="{{ $favorite->product->shipsFrom() }}"><img class="mx-1" src=<?php echo Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/arrow-right-black.png'
                                        )
                                    ); ?> width="17px" style="margin-top:-3px"><img src=<?php echo Converter::convert_into_base64(
     public_path('img/flags/' . $to . '.png')
 ); ?> width="28px" height="18px" alt="Flag" title="{{ $favorite->product->shipsTo() }}">
                            </div>
                            @else
                            <div style="padding:17px"></div>
                            @endif
                            <!-- <button class="product-add mb-2"><span>Add to Whishlist</span><i class="bi-heart"></i></button>
                        <button class="product-add bg-success text-white"><span>Add to Cart</span><i
                                class="bi-cart"></i></button> -->
                            <form method="post"
                                action="{{ route('post.favorites', ['product' => $favorite->product->id]) }}">
                                @csrf
                                <button class="product-add mb-2">
                                    @if(auth()->user()->isFavorite($favorite->product))
                                    <img src="{{ asset('img/icons/heart-fill.png') }}" width="16px"
                                        style="margin-right:2px"> Remove Favorites
                                    @else
                                    <img src="{{ asset('img/icons/heart.png') }}" width="16px" style="margin-right:2px">
                                    Add
                                    to Favorites
                                    @endif
                                </button>
                            </form>
                            <form method="post"
                                action="{{ route('post.addtocart', ['product' => $favorite->product->id]) }}">
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
                @empty
                <div class="h3 mt-20" style="text-align: center">Looks Empty :( </div>
                @endforelse
            </div>
            <?php $link_limit = 7;
// maximum number of links (a little bit inaccurate, but will be ok for now)
?>

            @if ($favorites->lastPage() > 1)
            <ul class="pagination">
                <a href="{{ $favorites->url(1) }}" class="{{ ($favorites->currentPage() == 1) ? ' disabled' : '' }}">
                    <li>
                        First
                    </li>
                </a>
                @for ($i = 1; $i <= $favorites->lastPage(); $i++)
                    <?php
                    $half_total_links = floor($link_limit / 2);
                    $from = $favorites->currentPage() - $half_total_links;
                    $to = $favorites->currentPage() + $half_total_links;
                    if ($favorites->currentPage() < $half_total_links) {
                        $to += $half_total_links - $favorites->currentPage();
                    }
                    if (
                        $favorites->lastPage() - $favorites->currentPage() <
                        $half_total_links
                    ) {
                        $from -=
                            $half_total_links -
                            ($favorites->lastPage() -
                                $favorites->currentPage()) -
                            1;
                    }
                    ?>
                    @if ($from < $i && $i < $to) <a href="{{ $favorites->url($i) }}">
                        <li class="{{ ($favorites->currentPage() == $i) ? ' active' : '' }}">
                            {{ $i }}
                        </li></a>
                        @endif
                        @endfor
                        <a href="{{ $favorites->url($favorites->lastPage()) }}"
                            class="{{ ($favorites->currentPage() == $favorites->lastPage()) ? ' disabled' : '' }}">
                            <li>
                                Last
                            </li>
                        </a>
            </ul>
            @endif
        </div>
    </div>
    </div>
</section>

@stop