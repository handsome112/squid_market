<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')

<title>Category - Squid Market</title>
@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')

<section class="section mt-3 mb-0">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5 class="fw-bold">{{ $category->name }}</h5>
        </div>
    </div>
</section>

@php
#Get all root categories
$categories = \App\Models\Category::roots();
$rates = \App\Tools\Converter::currencyLatestPrice();
$currency_type = auth()->user()->currency;
@endphp

<section class="section shop-part">
    <div class="container">
        <div class="row content-reverse">
            <div class="col-lg-3">
                <div class="shop-widget">
                    <h5 class="shop-widget-title"><img src="{{ asset('img/icons/card-list-black.png') }}" width="17px"
                            style="margin-top:-3px"> Categories</h5>
                    <ul class="shop-category-list">
                        @foreach($categories as $key => $category)
                        <li class="d-flex flex-column">
                            <input type="radio" name="category" id="category{{ $key }}" />
                            <div class="d-flex w-100">
                                <label for="category{{ $key }}" class="rotatelabel"><img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                    public_path('img/icons/right.png')
                                ); ?> width="18" height="18" alt="star"></label>
                                <a href="{{ route('category', ['slug' => $category->slug]) }}">
                                    {{ $category->name }}<span>{{ $category->totalProducts() }}</span></a>
                            </div>
                            <ul class="subcategory">
                                @forelse($category->subcategories as $subcategory)
                                <li>
                                    <a
                                        href="{{ route('category', ['slug' => $subcategory->slug]) }}">{{ $subcategory->name }}<span>{{ $subcategory->totalProducts() }}</span></a>
                                </li>
                                @empty
                                @endforelse
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <form action="{{ route('result') }}" method="get">
                    <input type="hidden" id="terms" name="terms" value="{{ isset($terms) ? $terms : ''}}">
                    <div class="shop-widget">
                        <h5 class="shop-widget-title"><img src="{{ asset('img/icons/search.png') }}" width="17px"
                                style="margin-top:-3px"> Search Options</h5>
                        <div class="form-group">
                            <label class="fw-bold">Search (min 2, max 50 characters):</label>
                            <input class="form-control" type="search" id="terms" name="terms"
                                value="{{ isset($terms) ? $terms : '' }}"
                                placeholder="e.g. drugs, data, malware, hacking">
                        </div>
                        <div class="form-group">
                            <label class="fw-bold">Local Display Currency</label>
                            <select class="form-select">
                                @foreach(config('currencies') as $currency)
                                <option value="{{ $currency }}" @if($currency==auth()->user()->currency) selected
                                    @endif>{{ $currency }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="fw-bold">Origin Country</label>
                            <select class="form-select" id="ships_from" name="ships_from">
                                @foreach(config('countries') as $index => $country)
                                <option value="{{ $index }}" @if(isset($ships_from) && $ships_from==$index) selected
                                    @endif>{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="fw-bold">Ships to</label>
                            <select class="form-select" id="ships_to" name="ships_to">
                                @foreach(config('countries') as $index => $country)
                                <option value="{{ $index }}" @if(isset($ships_to) && $ships_to==$index) selected @endif>
                                    {{ $country }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="fw-bold">Order By</label>
                            <select class="form-select" id="order_by" name="order_by">
                                @foreach(config('general.order_by') as $index => $order_by)
                                <option value="{{ $index }}" @if(isset($orderBy) && $orderBy==$index) selected @endif>
                                    {{ $order_by }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="fw-bold">Category</label>
                            <select class="form-select" id="category" name="category">
                                @foreach(\App\Models\Category::get() as $category_filter)
                                <option value="{{ $category_filter->slug }}" @if(isset($category) &&
                                    $category==$category_filter) selected @endif)>{{ $category_filter->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="fw-bold">Payment Type</label>
                            <select class="form-select">
                                <option value="1" selected>All(default)</option>
                                <option value="2">Escrow</option>
                                <option value="2">Finalize Early</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="fw-bold">Payment Currency</label>
                            <select class="form-select">
                                <option value="1" selected>Monero(XMR)</option>
                            </select>
                        </div>
                        <button class="btn btn-primary btn-sm w-100">Search Listings</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-9">
                <div class="row row-cols-3 row-cols-md-3 row-cols-lg-4 row-cols-xl-4">
                    @forelse($products as $product)
                    <div class="col">
                        <div class="product-card">
                            <div class="product-media">
                                <div class="product-label-lg">
                                    <label class="label-text label-marquee" style="height:44px;">
                                        <a href="{{ route('detailview', ['product' => $product->id]) }}"
                                            class="onlytworow">{{ $product->name }}</a>
                                    </label>
                                </div>
                                <a class="product-image" href="{{ route('detailview', ['product' => $product->id]) }}">
                                    <img src="{{ $product->image }}" alt="product">
                                </a>
                            </div>
                            <div class="product-content">
                                <div class="product-label-lg">
                                    <a href="{{ route('seller', ['seller' => $product->seller->username]) }}"
                                        class="label-text text">{{ $product->seller->username }}({{ \App\Models\Product::totalfeaturedproductsofseller($product->seller->id) }})
                                    </a>
                                </div>
                                <div class="product-label-lg">
                                    <label class="label-text gray"><i class="bi-coin"></i>
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
                                    </label>
                                </div>
                                <div class="product-rating">
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
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('img/XMR2.png') }}" width="20" height="20" alt="xmr">
                                    <h6 class="product-price">
                                        {{ number_format($product->price * $rates[$currency_type] / $rates[$product->currency], 2) }}
                                        {{ $currency_type }}</h6>
                                </div>
                                @php
                                $from = strtolower($product->ships_from);
                                $to = strtolower($product->ships_to);
                                @endphp
                                @if($product->type == 'Physical')

                                <div class="d-flex align-items-center justify-content-center p-2">
                                    <img src=<?php echo Converter::convert_into_base64(
                                        public_path(
                                            'img/flags/' . $from . '.png'
                                        )
                                    ); ?> width="28px" height="18px" alt="Flag"
                                        title="{{ $product->shipsFrom() }}"><img class="mx-1" src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/arrow-right-black.png'
                                            )
                                        ); ?> width="17px" style="margin-top:-3px"><img src=<?php echo Converter::convert_into_base64(
     public_path('img/flags/' . $to . '.png')
 ); ?> width="28px" height="18px" alt="Flag" title="{{ $product->shipsTo() }}">
                                </div>
                                @else
                                <div style="padding:17px"></div>
                                @endif
                                <!-- <button class="product-add mb-2"><span>Add to Whishlist</span><i class="bi-heart"></i></button>
                        <button class="product-add bg-success text-white"><span>Add to Cart</span><i
                                class="bi-cart"></i></button> -->
                                <form method="post" action="{{ route('post.favorites', ['product' => $product->id]) }}">
                                    @csrf
                                    <button class="product-add mb-2">
                                        @if(auth()->user()->isFavorite($product))
                                        <img src="{{ asset('img/icons/heart-fill.png') }}" width="16px"
                                            style="margin-right:2px"> Remove Favorites
                                        @else
                                        <img src="{{ asset('img/icons/heart.png') }}" width="16px"
                                            style="margin-right:2px">
                                        Add
                                        to Favorites
                                        @endif
                                    </button>
                                </form>
                                <form method="post" action="{{ route('post.addtocart', ['product' => $product->id]) }}">
                                    @csrf
                                    <button class="product-add bg-success text-white">
                                        <img src="{{ asset('img/icons/cart.png') }}" width="16px"
                                            style="margin-right:2px">
                                        Add
                                        to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>
                <?php $link_limit = 7;
// maximum number of links (a little bit inaccurate, but will be ok for now)
?>

                @if ($products->lastPage() > 1)
                <ul class="pagination">
                    <a href="{{ $products->url(1) }}" class="{{ ($products->currentPage() == 1) ? ' disabled' : '' }}">
                        <li>
                            First
                        </li>
                    </a>
                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                        <?php
                        $half_total_links = floor($link_limit / 2);
                        $from = $products->currentPage() - $half_total_links;
                        $to = $products->currentPage() + $half_total_links;
                        if ($products->currentPage() < $half_total_links) {
                            $to += $half_total_links - $products->currentPage();
                        }
                        if (
                            $products->lastPage() - $products->currentPage() <
                            $half_total_links
                        ) {
                            $from -=
                                $half_total_links -
                                ($products->lastPage() -
                                    $products->currentPage()) -
                                1;
                        }
                        ?>
                        @if ($from < $i && $i < $to) <a href="{{ $products->url($i) }}">
                            <li class="{{ ($products->currentPage() == $i) ? ' active' : '' }}">
                                {{ $i }}
                            </li></a>
                            @endif
                            @endfor
                            <a href="{{ $products->url($products->lastPage()) }}"
                                class="{{ ($products->currentPage() == $products->lastPage()) ? ' disabled' : '' }}">
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