<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')
<title>Chat Message - Squid Market</title>
@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')

<section class="section mt-3 mb-0">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5 class="fw-bold"><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/messenger.png')
            ); ?> width="17px" style="margin-top:-3px">
                Message Inbox</h5>
        </div>
    </div>
</section>

<div class="mb-5">
    <input type="checkbox" id="toogle-uChat">
    <section class="main-grid container" style="padding-left:0px; padding-right: 0px;">
        <aside class="main-side">
            <header class="common-header">
                <div class="common-header-start">
                    <button class="u-flex js-user-nav align-items-center">
                        <label for="toggle-info-me">
                            <img class="profile-image" src="{{ auth()->user()->avatar }}" alt="User"
                                style="cursor:pointer">
                        </label>
                        <span style="font-size:16px">&nbsp;{{ auth()->user()->username }}(Me)</span>
                    </button>
                </div>
                <nav class="common-nav">
                    <ul class="common-nav-list">
                        <li class="common-nav-item">
                            <button class="common-button">
                                <label for="toggle-new-message">
                                    <img src="{{ asset('img/icons/chat-grey.png') }}" width="18px"
                                        style="cursor:pointer" />
                                </label>
                            </button>
                        </li>
                        <!-- <li class="common-nav-item">
                            <button class="common-button">
                                <span class="icon icon-menu" aria-label="menu"></span>
                            </button>
                        </li> -->
                    </ul>
                </nav>
            </header>

            <section class="common-alerts">

            </section>
            <section class="common-search">
                <button><img src=<?php echo Converter::convert_into_base64(
                    public_path('img/icons/search.png')
                ); ?> width="15px" style="margin-top:-3px"></button>
                <input type="search" class="text-input" placeholder="Search">
            </section>
            <section class="chats">
                <ul class="chats-list">
                    @forelse($conversations as $conv)
                    <a href="{{ route('selectconv', ['conversation' => $conv->id]) }}">
                        <li class="chats-item">
                            <label for="" class="toogle-uChat">
                                <div class="chats-item-button js-chat-button" role="button" tabindex="0">
                                    <img class="profile-image" @if($conv->otherUser()->username=='STAFF MESSAGE')
                                    src=<?php echo Converter::convert_into_base64(
                                        public_path('img/user.png')
                                    ); ?> @else src="{{ $conv->otherUser()->avatar }}"
                                    @endif alt="User">
                                    @if(\Illuminate\Support\Facades\Cache::has('user-is-online-' .
                                    $conv->otherUser()->id))
                                    <span class="user-online"></span>
                                    @else
                                    <span class="user-offline"></span>
                                    @endif
                                    <header class="chats-item-header">
                                        <h3 class="chats-item-title">{{ $conv->otherUser()->username }}</h3>
                                        <time
                                            class="chats-item-time">@if($conv->conversationMessages()->latest()->first()
                                            !=
                                            null){{ $conv->conversationMessages()->latest()->first()->creationDate() }}
                                            @endif</time>
                                    </header>
                                    <div class="chats-item-content">
                                        <p class="chats-item-last">
                                            @if($conv->conversationMessages()->latest()->first() != null)
                                            @if($conv->conversationMessages()->latest()->first()->issuer_id ==
                                            auth()->user()->id)
                                            {{ $conv->conversationMessages()->latest()->first()->decryptMessage() }}
                                            @else
                                            <?php echo $conv
                                                ->conversationMessages()
                                                ->latest()
                                                ->first()
                                                ->violateMessage(); ?>
                                            @endif
                                            @endif
                                        </p>
                                        <ul class="chats-item-info">
                                            <li class="chats-item-info-item u-hide"><span class="icon-silent"></span>
                                            </li>
                                            @if($conv->unreadMessages() != 0)
                                            <li class="chats-item-info-item"><span
                                                    class="unread-messsages">{{ $conv->unreadMessages() }}</span>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </label>
                        </li>
                    </a>
                    @empty
                    @endforelse
                </ul>
            </section>
        </aside>
        <main class="main-content" style="height: 700px;">

            <header class="common-header">
                <div class="common-header-start">

                </div>
                <nav class="common-nav">

                </nav>
            </header>
            <div class="messanger" style="background-image:url({{ asset('img/message_back.png') }});">
                <p class="d-flex justify-content-center mt-4 fw-bold text-success" style="font-size:18px">Select
                    Conversation!</p>
            </div>
        </main>

        <input type="radio" name="convinfo" id="toggle-info-me" style="display:none" />
        <aside class="main-info-me">
            <header class="common-header d-flex align-items-center justify-content-between">
                <!-- <button class="common-button js-close-main-info"><span class="icon"><i
                            class="bi-x-lg"></i></span></button> -->
                <div class="common-header-content">
                    <h3 class="common-header-title">Info</h3>
                </div>
                <label for="toggle-close" style="cursor:pointer">
                    <img src=<?php echo Converter::convert_into_base64(
                        public_path('img/icons/close-black.png')
                    ); ?> width="20px" />
                </label>
            </header>
            <div class="main-info-content">
                <section class="common-box">
                    <img class="main-info-image" src="{{ auth()->user()->avatar }}" alt="User">
                    <h4 class="big-title text-center">{{ auth()->user()->username }}</h4>
                    <h6 class="big-title text-center">
                        @if(auth()->user()->seller == 1)
                        Seller Since {{ date('M Y', strtotime(auth()->user()->seller_since)) }}
                        <div class="product-rating">
                            @if(auth()->user()->totalRates() == 0)
                            <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/star-grey.png')
                            ); ?> width="18" height="18" alt="star">
                            @elseif(auth()->user()->totalRates() > 1 )
                            <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/star-yellow-fill.png')
                            ); ?> width="18" height="18" alt="star">
                            @elseif(auth()->user()->totalRates() > 0.5)
                            <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/star-halfup.png')
                            ); ?> width="18" height="18" alt="star">
                            @elseif(auth()->user()->totalRates()
                            < 0.5) <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/star-halfdown.png')
                            ); ?> width="18" height="18" alt="star" />
                            @elseif(auth()->user()->totalRates() == 0.5)
                            <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/star-half.png')
                            ); ?> width="18" height="18" alt="star">
                            @endif
                            @if(auth()->user()->totalRates() < 1 ) <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/star-grey.png')
                            ); ?> width="18" height="18" alt="star">
                                @elseif(auth()->user()->totalRates() > 2 )
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path(
                                        'img/icons/star-yellow-fill.png'
                                    )
                                ); ?> width="18" height="18" alt="star">
                                @elseif(auth()->user()->totalRates() > 1.5)
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/star-halfup.png')
                                ); ?> width="18" height="18" alt="star">
                                @elseif(auth()->user()->totalRates()
                                < 1.5) <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/star-halfdown.png')
                                ); ?> width="18" height="18" alt="star" />
                                @elseif(auth()->user()->totalRates() == 1.5)
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/star-half.png')
                                ); ?> width="18" height="18" alt="star">
                                @endif
                                @if(auth()->user()->totalRates() < 2 ) <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/star-grey.png')
                                ); ?> width="18" height="18" alt="star">
                                    @elseif(auth()->user()->totalRates() > 3 )
                                    <img src=<?php echo Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/star-yellow-fill.png'
                                        )
                                    ); ?> width="18" height="18" alt="star">
                                    @elseif(auth()->user()->totalRates() > 2.5)
                                    <img src=<?php echo Converter::convert_into_base64(
                                        public_path('img/icons/star-halfup.png')
                                    ); ?> width="18" height="18" alt="star">
                                    @elseif(auth()->user()->totalRates()
                                    < 2.5) <img src=<?php echo Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/star-halfdown.png'
                                        )
                                    ); ?> width="18" height="18" alt="star" />
                                    @elseif(auth()->user()->totalRates() == 2.5)
                                    <img src=<?php echo Converter::convert_into_base64(
                                        public_path('img/icons/star-half.png')
                                    ); ?> width="18" height="18" alt="star">
                                    @endif
                                    @if(auth()->user()->totalRates() < 3 ) <img src=<?php echo Converter::convert_into_base64(
                                        public_path('img/icons/star-grey.png')
                                    ); ?> width="18" height="18" alt="star">
                                        @elseif(auth()->user()->totalRates() > 4 )
                                        <img src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-yellow-fill.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif(auth()->user()->totalRates() > 3.5)
                                        <img src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-halfup.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif(auth()->user()->totalRates()
                                        < 3.5) <img src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-halfdown.png'
                                            )
                                        ); ?> width="18" height="18" alt="star" />
                                        @elseif(auth()->user()->totalRates() == 3.5)
                                        <img src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-half.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @endif
                                        @if(auth()->user()->totalRates() < 4 ) <img src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-grey.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                            @elseif(auth()->user()->totalRates() > 4.5)
                                            <img src=<?php echo Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-halfup.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @elseif(auth()->user()->totalRates()
                                            < 4.5) <img src=<?php echo Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-halfdown.png'
                                                )
                                            ); ?> width="18" height="18" alt="star" />
                                            @elseif(auth()->user()->totalRates() == 4.5)
                                            <img src=<?php echo Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-half.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @elseif(auth()->user()->totalRates() == 5)
                                            <img src=<?php echo Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-yellow-fill.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @endif
                                            <a href="#">({{ auth()->user()->totalFeedbacks() }})</a>
                        </div>
                        @else
                        Joined Squid : {{ date('M Y', strtotime(auth()->user()->created_at)) }}
                        <div class="product-rating">
                            @if(auth()->user()->totalRates() == 0)
                            <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/star-grey.png')
                            ); ?> width="18" height="18" alt="star">
                            @elseif(auth()->user()->totalRates() > 1 )
                            <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/star-yellow-fill.png')
                            ); ?> width="18" height="18" alt="star">
                            @elseif(auth()->user()->totalRates() > 0.5)
                            <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/star-halfup.png')
                            ); ?> width="18" height="18" alt="star">
                            @elseif(auth()->user()->totalRates()
                            < 0.5) <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/star-halfdown.png')
                            ); ?> width="18" height="18" alt="star" />
                            @elseif(auth()->user()->totalRates() == 0.5)
                            <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/star-half.png')
                            ); ?> width="18" height="18" alt="star">
                            @endif
                            @if(auth()->user()->totalRates() < 1 ) <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/star-grey.png')
                            ); ?> width="18" height="18" alt="star">
                                @elseif(auth()->user()->totalRates() > 2 )
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path(
                                        'img/icons/star-yellow-fill.png'
                                    )
                                ); ?> width="18" height="18" alt="star">
                                @elseif(auth()->user()->totalRates() > 1.5)
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/star-halfup.png')
                                ); ?> width="18" height="18" alt="star">
                                @elseif(auth()->user()->totalRates()
                                < 1.5) <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/star-halfdown.png')
                                ); ?> width="18" height="18" alt="star" />
                                @elseif(auth()->user()->totalRates() == 1.5)
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/star-half.png')
                                ); ?> width="18" height="18" alt="star">
                                @endif
                                @if(auth()->user()->totalRates() < 2 ) <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/star-grey.png')
                                ); ?> width="18" height="18" alt="star">
                                    @elseif(auth()->user()->totalRates() > 3 )
                                    <img src=<?php echo Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/star-yellow-fill.png'
                                        )
                                    ); ?> width="18" height="18" alt="star">
                                    @elseif(auth()->user()->totalRates() > 2.5)
                                    <img src=<?php echo Converter::convert_into_base64(
                                        public_path('img/icons/star-halfup.png')
                                    ); ?> width="18" height="18" alt="star">
                                    @elseif(auth()->user()->totalRates()
                                    < 2.5) <img src=<?php echo Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/star-halfdown.png'
                                        )
                                    ); ?> width="18" height="18" alt="star" />
                                    @elseif(auth()->user()->totalRates() == 2.5)
                                    <img src=<?php echo Converter::convert_into_base64(
                                        public_path('img/icons/star-half.png')
                                    ); ?> width="18" height="18" alt="star">
                                    @endif
                                    @if(auth()->user()->totalRates() < 3 ) <img src=<?php echo Converter::convert_into_base64(
                                        public_path('img/icons/star-grey.png')
                                    ); ?> width="18" height="18" alt="star">
                                        @elseif(auth()->user()->totalRates() > 4 )
                                        <img src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-yellow-fill.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif(auth()->user()->totalRates() > 3.5)
                                        <img src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-halfup.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif(auth()->user()->totalRates()
                                        < 3.5) <img src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-halfdown.png'
                                            )
                                        ); ?> width="18" height="18" alt="star" />
                                        @elseif(auth()->user()->totalRates() == 3.5)
                                        <img src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-half.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @endif
                                        @if(auth()->user()->totalRates() < 4 ) <img src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-grey.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                            @elseif(auth()->user()->totalRates() > 4.5)
                                            <img src=<?php echo Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-halfup.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @elseif(auth()->user()->totalRates()
                                            < 4.5) <img src=<?php echo Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-halfdown.png'
                                                )
                                            ); ?> width="18" height="18" alt="star" />
                                            @elseif(auth()->user()->totalRates() == 4.5)
                                            <img src=<?php echo Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-half.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @elseif(auth()->user()->totalRates() == 5)
                                            <img src=<?php echo Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-yellow-fill.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @endif
                                            <a href="#">({{ auth()->user()->totalFeedbacks() }})</a>
                        </div>
                        @endif
                    </h6>
                </section>
                <section class="common-box">
                    <h5 class="section-title">About</h5>
                    @if(auth()->user()->seller == 1)
                    <p>Total Sales : {{ auth()->user()->totalSales('delivered') }}</p>
                    <p>Total Products : {{ \App\Models\Product::totalfeaturedproductsofseller(auth()->user()->id) }}</p>
                    <p>{{ auth()->user()->seller_description }}</p>
                    @else
                    <p>Total Purchaes : {{ auth()->user()->totalOrdersCompleted() }}</p>
                    <p>{{ auth()->user()->description }}</p>
                    @endif
                </section>
            </div>
        </aside>
        <input type="radio" name="convinfo" id="toggle-new-message" style="display:none" />
        <input type="radio" name="convinfo" id="toggle-close" style="display:none" />
        <aside class="send-new-message">
            <header class="common-header d-flex align-items-center justify-content-between">
                <!-- <button class="common-button js-close-main-info"><span class="icon"><i
                            class="bi-x-lg"></i></span></button> -->
                <div class="common-header-content d-flex align-items-center">
                    <img src="{{ asset('img/icons/chat-grey.png') }}" width="16px" />
                    <h3 class="common-header-title">&nbsp;Send New Message</h3>
                </div>
                <label for="toggle-close" style="cursor:pointer">
                    <img src=<?php echo Converter::convert_into_base64(
                        public_path('img/icons/close-black.png')
                    ); ?> width="20px" />
                </label>
            </header>
            <div class="main-info-content">
                <section class="common-box">
                    <form method="post" action="{{ route('post.conversations') }}">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label text-start">To:</label>
                            <div class="col-sm-8 d-flex align-items-center justify-content-between">
                                <input type="text" class="form-control" id="username" name="username" value=""
                                    placeholder="To">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label text-start">Message:</label>
                            <div class="col-sm-8 d-flex align-items-center justify-content-between">
                                <textarea class="form-control" id="message" name="message"
                                    placeholder="message..."></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <button class="btn btn-success btn-sm" type="submit" style="float:right">Submit</button>
                        </div>
                    </form>
                </section>
                <section class="common-box">

                </section>
            </div>
        </aside>
    </section>
</div>

@stop