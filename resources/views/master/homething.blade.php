<?php

namespace App\Tools; ?>
<section class="section brand-part mt-0 ">
    <div class="container">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-7 row-cols-xl-6">
            @if(auth() -> user() -> isSeller())
            <div class="brand-wrap">
                <a href="{{ route('about') }}">
                    <div class="brand-media">
                        <!-- <i class="bi-question"></i> -->
                        <img src=<?php echo Converter::convert_into_base64(
                            public_path('img/icons/question.png')
                        ); ?>>
                    </div>
                    <div class="brand-meta">
                        <h4>FAQ</h4>
                    </div>
                </a>
            </div>
            @else
            <div class="brand-wrap">
                <a href="">
                    <div class="brand-media">
                        <!-- <i class="bi-cart-check"></i> -->
                        <img src=<?php echo Converter::convert_into_base64(
                            public_path('img/icons/cart-check.png')
                        ); ?>>
                    </div>
                    <div class="brand-meta">
                        <h4>Start Buying</h4>
                    </div>
                </a>
            </div>
            @endif
            @if(auth() -> user() -> isSeller())
            <div class="brand-wrap">
                <a href="">
                    <div class="brand-media">
                        <img src=<?php echo Converter::convert_into_base64(
                            public_path('img/icons/money.png')
                        ); ?>>
                    </div>
                    <div class="brand-meta">
                        <h4>Start Selling</h4>
                    </div>
                </a>
            </div>
            @else
            <div class="brand-wrap">
                <a href="{{ route('becomeseller') }}">
                    <div class="brand-media">
                        <!-- <i class="bi-box"></i> -->
                        <img src=<?php echo Converter::convert_into_base64(
                            public_path('img/icons/UPGRADE TO VENDOR icon.png')
                        ); ?>>
                    </div>
                    <div class="brand-meta">
                        <h4>Join as Squid Vendor</h4>
                    </div>
                </a>
            </div>
            @endif
            @if(auth() -> user() -> isSeller())
            <div class="brand-wrap">
                <a href="{{ route('sales', ['status' => 'all']) }}">
                    <div class="brand-media">
                        <img src=<?php echo Converter::convert_into_base64(
                            public_path('img/icons/bag.png')
                        ); ?>>
                    </div>
                    <div class="brand-meta">
                        <h4>Sales</h4>
                    </div>
                </a>
            </div>
            @else
            <div class="brand-wrap">
                <a href="{{ route('favorites') }}">
                    <div class="brand-media">
                        <!-- <i class="bi-file-play"></i> -->
                        <img src=<?php echo Converter::convert_into_base64(
                            public_path('img/icons/wishlist icon.png')
                        ); ?>>
                    </div>
                    <div class="brand-meta">
                        <h4>My Wishlist</h4>
                    </div>
                </a>
            </div>
            @endif
            <div class="brand-wrap">
                <a href="http://dreadytofatroptsdj6io7l3xptbet6onoyno2yv7jicoxknyazubrad.onion/d/squid" target="_blank">
                    <div class="brand-media">
                        <!-- <i class="bi-chat-left-text"></i> -->
                        <img src=<?php echo Converter::convert_into_base64(
                            public_path('img/icons/dread.png')
                        ); ?>>
                    </div>
                    <div class="brand-meta">
                        <h4>Dread</h4>
                    </div>
                </a>
            </div>
            <div class="brand-wrap">
                <a href="{{ route('ticket') }}">
                    <div class="brand-media">
                        <!-- <i class="bi-person"></i> -->
                        <img src=<?php echo Converter::convert_into_base64(
                            public_path('img/icons/helpdesk.png')
                        ); ?>>
                    </div>
                    <div class="brand-meta">
                        <h4>Helpdesk</h4>
                    </div>
                </a>
            </div>
            @if(auth() -> user() -> isSeller())
            <div class="brand-wrap">
                <a href="{{ route('rules') }}">
                    <div class="brand-media">
                        <!-- <i class="bi-bag-plus"></i> -->
                        <img src=<?php echo Converter::convert_into_base64(
                            public_path('img/icons/list.png')
                        ); ?>>
                    </div>
                    <div class="brand-meta">
                        <h4>Rules</h4>
                    </div>
                </a>
            </div>
            @else
            <div class="brand-wrap">
                <a href="{{ route('orders', ['status' => 'all']) }}">
                    <div class="brand-media">
                        <!-- <i class="bi-bag-plus"></i> -->
                        <img src=<?php echo Converter::convert_into_base64(
                            public_path('img/icons/bag_plus.png')
                        ); ?>>
                    </div>
                    <div class="brand-meta">
                        <h4>Orders</h4>
                    </div>
                </a>
            </div>
            @endif
        </div>

    </div>
    <section class="section bg-dark text-center text-white mt-0 pt-3 pb-3">
        <p class="mb-0">Welcome <strong>{{auth()->user()->username}}</strong></p>
        <p class="mb-0">Your Login Phrase: <strong>{{auth()->user()->phrase}}</strong></p>
    </section>
</section>