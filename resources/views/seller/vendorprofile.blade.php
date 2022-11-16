@extends('master.main')
@section('content')

<title>Profile - Squid Market</title>
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
                {{ $seller->username }}'s Profile</h5>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="account-card">
            <div class="row">
                <div class="col-sm-6 col-md-3 col-lg-3 mb-3">
                    <div style="margin-bottom: 50px; height: 345px">
                        <h5 class="account-title">{{ $seller->username }}</h5>
                        <div class="profile-image">
                            <a class="mt-2"><img src="{{ $seller->avatar }}" alt="user"></a>
                        </div>
                    </div>
                    <div class="button-group3">
                        <button class="btn-info_ w-100 mb-2">
                            Last Active: {{ $seller->lastLogin() }}
                            @if(Cache::has('user-is-online-' .
                            $seller->id))
                            <span class="badge bg-success">Online</span>
                            @else
                            <span class="badge bg-secondary">Offline</span>
                            @endif</span>
                        </button>
                        <button class="btn-black w-100 mb-2" style="padding-top:8px; padding-bottom: 8px">
                            @if($seller->totalRates() == 0)
                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                public_path('img/icons/star-grey.png')
                            ); ?> width="18" height="18" alt="star">
                            @elseif($seller->totalRates() >= 1 )
                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                public_path('img/icons/star-yellow-fill.png')
                            ); ?> width="18" height="18" alt="star">
                            @elseif($seller->totalRates() > 0.5)
                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                public_path('img/icons/star-halfup.png')
                            ); ?> width="18" height="18" alt="star">
                            @elseif($seller->totalRates()
                            < 0.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                public_path('img/icons/star-halfdown.png')
                            ); ?> width="18" height="18" alt="star" />
                            @elseif($seller->totalRates() == 0.5)
                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                public_path('img/icons/star-half.png')
                            ); ?> width="18" height="18" alt="star">
                            @endif
                            @if($seller->totalRates() <= 1 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                public_path('img/icons/star-grey.png')
                            ); ?> width="18" height="18" alt="star">
                                @elseif($seller->totalRates() >= 2 )
                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                    public_path(
                                        'img/icons/star-yellow-fill.png'
                                    )
                                ); ?> width="18" height="18" alt="star">
                                @elseif($seller->totalRates() > 1.5)
                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                    public_path('img/icons/star-halfup.png')
                                ); ?> width="18" height="18" alt="star">
                                @elseif($seller->totalRates()
                                < 1.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                    public_path('img/icons/star-halfdown.png')
                                ); ?> width="18" height="18" alt="star" />
                                @elseif($seller->totalRates() == 1.5)
                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                    public_path('img/icons/star-half.png')
                                ); ?> width="18" height="18" alt="star">
                                @endif
                                @if($seller->totalRates() <= 2 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                    public_path('img/icons/star-grey.png')
                                ); ?> width="18" height="18" alt="star">
                                    @elseif($seller->totalRates() >= 3 )
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/star-yellow-fill.png'
                                        )
                                    ); ?> width="18" height="18" alt="star">
                                    @elseif($seller->totalRates() > 2.5)
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path('img/icons/star-halfup.png')
                                    ); ?> width="18" height="18" alt="star">
                                    @elseif($seller->totalRates()
                                    < 2.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/star-halfdown.png'
                                        )
                                    ); ?> width="18" height="18" alt="star" />
                                    @elseif($seller->totalRates() == 2.5)
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path('img/icons/star-half.png')
                                    ); ?> width="18" height="18" alt="star">
                                    @endif
                                    @if($seller->totalRates() <= 3 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path('img/icons/star-grey.png')
                                    ); ?> width="18" height="18" alt="star">
                                        @elseif($seller->totalRates() >= 4)
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-yellow-fill.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($seller->totalRates() > 3.5)
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-halfup.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($seller->totalRates()
                                        < 3.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-halfdown.png'
                                            )
                                        ); ?> width="18" height="18" alt="star" />
                                        @elseif($seller->totalRates() == 3.5)
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-half.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @endif
                                        @if($seller->totalRates() <= 4 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-grey.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                            @elseif($seller->totalRates() == 5)
                                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-yellow-fill.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @elseif($seller->totalRates() > 4.5)
                                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-halfup.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @elseif($seller->totalRates()
                                            < 4.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-halfdown.png'
                                                )
                                            ); ?> width="18" height="18" alt="star" />
                                            @elseif($seller->totalRates() == 4.5)
                                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-half.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @endif
                                            <a
                                                href="{{ route('detailfeedback', ['vendor' => $seller->id]) }}">({{ $seller->totalFeedbacks() }})</a>
                        </button>
                        <button class="btn-danger_ w-100 mb-2">
                            <img src="{{ asset('img/icons/x-circle-red.png') }}" width="13px"
                                style="margin-top:-3px">&nbsp;&nbsp;Disputes Won/Lost:
                            {{$seller->wonDisputes()}}/{{$seller->totalDisputes()-$seller->wonDisputes()}}
                        </button>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 mb-3">
                    <div style="margin-bottom: 50px">
                        <h5 class="account-title">Profile Description</h5>
                        <textarea class="form-control" style="height: 300px;" @if($seller->id != auth()->user()->id) readonly 
                            @endif>{{ $seller->seller_description }}</textarea>
                    </div>
                    <div class="button-group3">
                        <button class="mb-2 w-100 btn-black">Squid Points: 1SP</button>
                        <button class="mb-2 w-100 btn-info_">Joined Squid:
                            {{ date('M Y', strtotime($seller->created_at)) }}</button>
                        <button class="mb-2 btn-yel w-100">
                            @if($seller->finalizeEarly())
                            <span class="text-success">Vendor is FE Approved</span>
                            @else
                            <span class="text-danger">Vendor is not FE Approved</span>
                            @endif
                        </button>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 mb-3">
                    <div style="margin-bottom: 50px">
                        <h5 class="account-title">Vendor Public PGP:</h5>
                        <textarea class="form-control" style="height: 300px;" readonly>{{ $seller->pgp_key }}</textarea>
                    </div>
                    <div class="button-group3">
                        <button class="btn-black w-100 mb-2">Completed Order:
                            {{$seller->totalOrdersCompleted()}}</button>
                        <button class="btn-info_ w-100 mb-2">Registered as Vendor:
                            {{ date('M Y', strtotime($seller->seller_since)) }}</button>
                        <button class="btn-danger_ w-100 mb-2">
                            <img src="{{ asset('img/icons/x-circle-red.png') }}" width="13px"
                                style="margin-top:-3px">&nbsp;&nbsp;Warning: 0/3
                        </button>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 mb-3">
                    <div class="button-group4">
                        <a href="{{ route('detailfeedback', ['vendor' => $seller->id]) }}"
                            class="btn btn-sm btn-dark w-100 mb-2">
                            <img src="{{ asset('img/icons/detailfeedback.png') }}" width="14px" style="margin-top:-3px">
                            Detailed
                            Feedback
                        </a>
                        @if(auth()->user()->id != $seller->id)
                        <a href="{{ route('newconversation', ['vendor' => $seller->id]) }}"
                            class="btn btn-sm btn-dark w-100 mb-2">
                            <img src="{{ asset('img/icons/chat.png') }}" width="14px" style="margin-top:-3px">
                            Contact Vendor
                        </a>
                        @endif
                        @if(auth()->user()->id != $seller->id)
                        <a href="{{ route('vendorproducts', ['vendor' => $seller->id]) }}"
                            class="btn btn-sm btn-dark w-100 mb-2">
                            <img src="{{ asset('img/icons/UPGRADE TO VENDOR icon.png') }}" width="14px"
                                style="margin-top:-3px">
                            Vendor Products
                        </a>
                        @else
                        <a href="{{ route('vendorproducts', ['vendor' => $seller->id]) }}"
                            class="btn btn-sm btn-dark w-100 mb-2">
                            <img src="{{ asset('img/icons/UPGRADE TO VENDOR icon.png') }}" width="14px"
                                style="margin-top:-3px">
                            My Products
                        </a>
                        @endif
                        @if(auth()->user()->id != $seller->id)
                        <label for="toggle-report" class="w-100">
                            <a class="btn btn-sm btn-dark w-100 mb-2">
                                <img src="{{ asset('img/icons/report-fill.png') }}" width="14px"
                                    style="margin-top:-3px">
                                Report Vendor
                            </a>
                        </label>
                        @endif
                    </div>
                    <div class="h-100">
                        <h5 class="account-title" style="text-decoration:underline">Other Markets</h5>
                        <ul class="list-group">
                            @forelse($markets as $market)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <img src="{{ $market->logo }}" alt="1">
                                <span class="badge bg-primary rounded-pill">2</span>
                            </li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('includes.components.reportvendor')
<section class="section">
    <div class="container">
        <div class="account-card">
            <h5 class="account-title">{{ $seller->username }} Feedback</h5>
            <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th class="text-start">Recent Feedback Score:</th>
                                    <th>1 Month</th>
                                    <th>6 Months</th>
                                    <th>All</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-start"><img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/plus-circle-green.png'
                                        )
                                    ); ?> width="15px" style="margin-top:-3px"> Positive
                                    </td>
                                    <td>{{ $seller->totalFeedbacks('positive', 1) }}</td>
                                    <td>{{ $seller->totalFeedbacks('positive', 6) }}</td>
                                    <td>{{ $seller->totalFeedbacks('positive') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-start"><img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/plus-circle-grey.png'
                                        )
                                    ); ?> width="15px" style="margin-top:-3px"> Neutral
                                    </td>
                                    <td>{{ $seller->totalFeedbacks('neutral', 1) }}</td>
                                    <td>{{ $seller->totalFeedbacks('neutral', 6) }}</td>
                                    <td>{{ $seller->totalFeedbacks('neutral') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-start"><img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/plus-circle-red.png'
                                        )
                                    ); ?> width="15px" style="margin-top:-3px"> Negative</td>
                                    <td>{{ $seller->totalFeedbacks('negative', 1) }}</td>
                                    <td>{{ $seller->totalFeedbacks('negative', 6) }}</td>
                                    <td>{{ $seller->totalFeedbacks('negative') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th class="text-start">Detailed Rating:</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-start"><img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/star-fill-black.png'
                                        )
                                    ); ?> width="15px" style="margin-top:-3px"> Quality</td>
                                    <td>
                                        @if($seller->productsRates() == 0)
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-grey.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($seller->productsRates() >= 1 )
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-yellow-fill.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($seller->productsRates() > 0.5)
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-halfup.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($seller->productsRates()
                                        < 0.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-halfdown.png'
                                            )
                                        ); ?> width="18" height="18" alt="star" />
                                        @elseif($seller->productsRates() == 0.5)
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-half.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @endif
                                        @if($seller->productsRates() <= 1 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-grey.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                            @elseif($seller->productsRates() >= 2 )
                                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-yellow-fill.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @elseif($seller->productsRates() > 1.5)
                                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-halfup.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @elseif($seller->productsRates()
                                            < 1.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-halfdown.png'
                                                )
                                            ); ?> width="18" height="18" alt="star" />
                                            @elseif($seller->productsRates() == 1.5)
                                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-half.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @endif
                                            @if($seller->productsRates() <= 2 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-grey.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                                @elseif($seller->productsRates() >= 3 )
                                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-yellow-fill.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @elseif($seller->productsRates() > 2.5)
                                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-halfup.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @elseif($seller->productsRates()
                                                < 2.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-halfdown.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star" />
                                                @elseif($seller->productsRates() == 2.5)
                                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-half.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @endif
                                                @if($seller->productsRates() <= 3 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-grey.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                    @elseif($seller->productsRates() >= 4 )
                                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-yellow-fill.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star">
                                                    @elseif($seller->productsRates() > 3.5)
                                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-halfup.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star">
                                                    @elseif($seller->productsRates()
                                                    < 3.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-halfdown.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star" />
                                                    @elseif($seller->productsRates() == 3.5)
                                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-half.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star">
                                                    @endif
                                                    @if($seller->productsRates() <= 4 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-grey.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star">
                                                        @elseif($seller->productsRates() == 5)
                                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                            public_path(
                                                                'img/icons/star-yellow-fill.png'
                                                            )
                                                        ); ?> width="18" height="18" alt="star">
                                                        @elseif($seller->productsRates() > 4.5)
                                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                            public_path(
                                                                'img/icons/star-halfup.png'
                                                            )
                                                        ); ?> width="18" height="18" alt="star">
                                                        @elseif($seller->productsRates()
                                                        < 4.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                            public_path(
                                                                'img/icons/star-halfdown.png'
                                                            )
                                                        ); ?> width="18" height="18" alt="star" />
                                                        @elseif($seller->productsRates() == 4.5)
                                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                            public_path(
                                                                'img/icons/star-half.png'
                                                            )
                                                        ); ?> width="18" height="18" alt="star">
                                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-start"><img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path('img/icons/chat-black.png')
                                    ); ?> width="15px" style="margin-top:-3px"> Communication</td>
                                    <td>
                                        @if($seller->communityRates() == 0)
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-grey.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($seller->communityRates() >= 1 )
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-yellow-fill.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($seller->communityRates() > 0.5)
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-halfup.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($seller->communityRates()
                                        < 0.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-halfdown.png'
                                            )
                                        ); ?> width="18" height="18" alt="star" />
                                        @elseif($seller->communityRates() == 0.5)
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-half.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @endif
                                        @if($seller->communityRates() <= 1 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-grey.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                            @elseif($seller->communityRates() >= 2 )
                                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-yellow-fill.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @elseif($seller->communityRates() > 1.5)
                                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-halfup.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @elseif($seller->communityRates()
                                            < 1.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-halfdown.png'
                                                )
                                            ); ?> width="18" height="18" alt="star" />
                                            @elseif($seller->communityRates() == 1.5)
                                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-half.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @endif
                                            @if($seller->communityRates() <= 2 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-grey.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                                @elseif($seller->communityRates() >= 3 )
                                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-yellow-fill.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @elseif($seller->communityRates() > 2.5)
                                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-halfup.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @elseif($seller->communityRates()
                                                < 2.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-halfdown.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star" />
                                                @elseif($seller->communityRates() == 2.5)
                                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-half.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @endif
                                                @if($seller->communityRates() <= 3 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-grey.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                    @elseif($seller->communityRates() >= 4 )
                                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-yellow-fill.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star">
                                                    @elseif($seller->communityRates() > 3.5)
                                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-halfup.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star">
                                                    @elseif($seller->communityRates()
                                                    < 3.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-halfdown.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star" />
                                                    @elseif($seller->communityRates() == 3.5)
                                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-half.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star">
                                                    @endif
                                                    @if($seller->communityRates() <= 4 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-grey.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star">
                                                        @elseif($seller->communityRates() == 5)
                                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                            public_path(
                                                                'img/icons/star-yellow-fill.png'
                                                            )
                                                        ); ?> width="18" height="18" alt="star">
                                                        @elseif($seller->communityRates() > 4.5)
                                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                            public_path(
                                                                'img/icons/star-halfup.png'
                                                            )
                                                        ); ?> width="18" height="18" alt="star">
                                                        @elseif($seller->communityRates()
                                                        < 4.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                            public_path(
                                                                'img/icons/star-halfdown.png'
                                                            )
                                                        ); ?> width="18" height="18" alt="star" />
                                                        @elseif($seller->communityRates() == 4.5)
                                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                            public_path(
                                                                'img/icons/star-half.png'
                                                            )
                                                        ); ?> width="18" height="18" alt="star">
                                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-start"><img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/shipped-black.png'
                                        )
                                    ); ?> width="15px" style="margin-top:-3px"> Shipping</td>
                                    <td>
                                        @if($seller->shippingRates() == 0)
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-grey.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($seller->shippingRates() >= 1 )
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-yellow-fill.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($seller->shippingRates() > 0.5)
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-halfup.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($seller->shippingRates()
                                        < 0.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-halfdown.png'
                                            )
                                        ); ?> width="18" height="18" alt="star" />
                                        @elseif($seller->shippingRates() == 0.5)
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-half.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @endif
                                        @if($seller->shippingRates() <= 1 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-grey.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                            @elseif($seller->shippingRates() >= 2 )
                                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-yellow-fill.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @elseif($seller->shippingRates() > 1.5)
                                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-halfup.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @elseif($seller->shippingRates()
                                            < 1.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-halfdown.png'
                                                )
                                            ); ?> width="18" height="18" alt="star" />
                                            @elseif($seller->shippingRates() == 1.5)
                                            <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-half.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @endif
                                            @if($seller->shippingRates() <= 2 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-grey.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                                @elseif($seller->shippingRates() >= 3 )
                                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-yellow-fill.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @elseif($seller->shippingRates() > 2.5)
                                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-halfup.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @elseif($seller->shippingRates()
                                                < 2.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-halfdown.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star" />
                                                @elseif($seller->shippingRates() == 2.5)
                                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-half.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @endif
                                                @if($seller->shippingRates() <= 3 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-grey.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                    @elseif($seller->shippingRates() >= 4 )
                                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-yellow-fill.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star">
                                                    @elseif($seller->shippingRates() > 3.5)
                                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-halfup.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star">
                                                    @elseif($seller->shippingRates()
                                                    < 3.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-halfdown.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star" />
                                                    @elseif($seller->shippingRates() == 3.5)
                                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-half.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star">
                                                    @endif
                                                    @if($seller->shippingRates() <= 4 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/star-grey.png'
                                                        )
                                                    ); ?> width="18" height="18" alt="star">
                                                        @elseif($seller->shippingRates() == 5)
                                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                            public_path(
                                                                'img/icons/star-yellow-fill.png'
                                                            )
                                                        ); ?> width="18" height="18" alt="star">
                                                        @elseif($seller->shippingRates() > 4.5)
                                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                            public_path(
                                                                'img/icons/star-halfup.png'
                                                            )
                                                        ); ?> width="18" height="18" alt="star">
                                                        @elseif($seller->shippingRates()
                                                        < 4.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                            public_path(
                                                                'img/icons/star-halfdown.png'
                                                            )
                                                        ); ?> width="18" height="18" alt="star" />
                                                        @elseif($seller->shippingRates() == 4.5)
                                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                            public_path(
                                                                'img/icons/star-half.png'
                                                            )
                                                        ); ?> width="18" height="18" alt="star">
                                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="account-card">
            <h5 class="account-title">{{ $seller->username }}'s Products</h5>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6">
                @php
                $products = $seller->sellerproducts()->paginate(12);
                @endphp
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
                                <a href="{{ route('seller', ['seller' => $seller->username]) }}"
                                    class="label-text text">{{ $seller->username }}({{ \App\Models\Product::totalfeaturedproductsofseller($seller->id) }})
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
                                    public_path('img/icons/star-halfdown.png')
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
                                        public_path('img/icons/star-halfup.png')
                                    ); ?> width="18" height="18" alt="star">
                                    @elseif($product->totalRates()
                                    < 1.5) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/star-halfdown.png'
                                        )
                                    ); ?> width="18" height="18" alt="star" />
                                    @elseif($product->totalRates() == 1.5)
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path('img/icons/star-half.png')
                                    ); ?> width="18" height="18" alt="star">
                                    @endif
                                    @if($product->totalRates() <= 2 ) <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path('img/icons/star-grey.png')
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
                                @if($product->paytype=='bic')
                                <img src="{{ asset('img/bitcoin.png') }}" width="20" height="20" alt="bitcoin">
                                @elseif($product->paytype=='xmr')
                                <img src="{{ asset('img/XMR2.png') }}" width="20" height="20" alt="xmr">
                                @elseif($product->paytype=='both')
                                <img src="{{ asset('img/XMR2.png') }}" width="20" height="20" alt="xmr">
                                <img src="{{ asset('img/bitcoin.png') }}" width="20" height="20" alt="bitcoin">
                                @endif
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
                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                    public_path('img/flags/' . $from . '.png')
                                ); ?> width="28px" height="18px" alt="Flag" title="{{ $product->shipsFrom() }}"><img
                                    class="mx-1" src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/arrow-right-black.png'
                                        )
                                    ); ?> width="17px" style="margin-top:-3px"><img src=<?php echo \App\Tools\Converter::convert_into_base64(
     public_path('img/flags/' . $to . '.png')
 ); ?> width="28px" height="18px" alt="Flag" title="{{ $product->shipsTo() }}">
                            </div>
                            @else
                            <div style="padding:14.5px"></div>
                            @endif
                            <!-- <button class="product-add mb-2"><span>Add to Whishlist</span><i class="bi-heart"></i></button>
                        <button class="product-add bg-success text-white"><span>Add to Cart</span><i
                                class="bi-cart"></i></button> -->
                            <form method="post" action="{{ route('post.favorites', ['product' => $product->id]) }}">
                                @csrf
                                <button class="product-add mb-2">
                                    @if(auth()->user()->isFavorite($product))
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path('img/icons/heart-fill.png')
                                    ); ?> width="16px" style="margin-right:2px"> Remove Favorites
                                    @else
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path('img/icons/heart.png')
                                    ); ?> width="16px" style="margin-right:2px">
                                    Add
                                    to Favorites
                                    @endif
                                </button>
                            </form>
                            <form method="post" action="{{ route('post.addtocart', ['product' => $product->id]) }}">
                                @csrf
                                <button class="product-add bg-success text-white">
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path('img/icons/cart.png')
                                    ); ?> width="16px" style="margin-right:2px">
                                    Add
                                    to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div>Looks empty :(</div>
                @endforelse
            </div>
            <?php $link_limit = 7;
// maximum number of links (a little bit inaccurate, but will be ok for now)
?>

            @if ($products->lastPage() > 1)
            <ul class="pagination">
                <a href="{{ $products->url(1) }}">
                    <li class="{{ ($products->currentPage() == 1) ? ' disabled' : '' }}">
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
                            ($products->lastPage() - $products->currentPage()) -
                            1;
                    }
                    ?>
                    @if ($from < $i && $i < $to) <a href="{{ $products->url($i) }}">
                        <li class="{{ ($products->currentPage() == $i) ? ' active' : '' }}">
                            {{ $i }}
                        </li></a>
                        @endif
                        @endfor
                        <a href="{{ $products->url($products->lastPage()) }}">
                            <li class="{{ ($products->currentPage() == $products->lastPage()) ? ' disabled' : '' }}">
                                Last
                            </li>
                        </a>
            </ul>
            @endif
        </div>
    </div>
</section>

@stop