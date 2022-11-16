<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')

<title>Detail Feedback - Squid Market</title>
@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')

@php
$rates = \App\Tools\Converter::currencyLatestPrice();
@endphp
<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5> Detailed Feedback </h5>
        </div>
    </div>
</section>

<section class="section mt-0">
    <div class="container">
        <div class="account-card">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th class="text-start">Feedback</th>
                        <th class="text-start">By</th>
                        <th class="text-start">Rating</th>
                        <th class="text-start">Time Ago</th>
                    </thead>
                    <tbody>
                        @forelse($feedbacks as $feedback)
                        <tr>
                            <td class="text-start">
                                <strong>{{ $feedback->message }}</strong><br>
                                {{ $feedback->product->name }}
                            </td>
                            <td class="text-start">
                                <strong>Buyer: {{ $feedback->hiddenUser() }}</strong><br>
                                @if(!is_null($feedback->order)){{ number_format(($feedback->order->quantity * $feedback->order->product->price + $feedback->order->ships_price) * $rates[auth()->user()->currency] / $rates[$feedback->order->product->currency], 2) }}
                                {{ auth()->user()->currency }} ({{ $feedback->order->quantity }}
                                *
                                {{ number_format($feedback->order->product->price * $rates[auth()->user()->currency] / $rates[$feedback->order->product->currency], 2) }}
                                +
                                {{ number_format($feedback->order->ships_price * $rates[auth()->user()->currency] / $rates[$feedback->order->product->currency], 2) }})
                                @endif
                            </td>
                            <td class="text-start">
                                @if($feedback->rating == 0)
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/star-grey.png')
                                ); ?> width="18" height="18" alt="star">
                                @elseif($feedback->rating >= 1 )
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path(
                                        'img/icons/star-yellow-fill.png'
                                    )
                                ); ?> width="18" height="18" alt="star">
                                @elseif($feedback->rating > 0.5)
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/star-halfup.png')
                                ); ?> width="18" height="18" alt="star">
                                @elseif($feedback->rating
                                < 0.5) <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/star-halfdown.png')
                                ); ?> width="18" height="18" alt="star" />
                                @elseif($feedback->rating == 0.5)
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/star-half.png')
                                ); ?> width="18" height="18" alt="star">
                                @endif
                                @if($feedback->rating <= 1 ) <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/star-grey.png')
                                ); ?> width="18" height="18" alt="star">
                                    @elseif($feedback->rating >= 2 )
                                    <img src=<?php echo Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/star-yellow-fill.png'
                                        )
                                    ); ?> width="18" height="18" alt="star">
                                    @elseif($feedback->rating > 1.5)
                                    <img src=<?php echo Converter::convert_into_base64(
                                        public_path('img/icons/star-halfup.png')
                                    ); ?> width="18" height="18" alt="star">
                                    @elseif($feedback->rating
                                    < 1.5) <img src=<?php echo Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/star-halfdown.png'
                                        )
                                    ); ?> width="18" height="18" alt="star" />
                                    @elseif($feedback->rating == 1.5)
                                    <img src=<?php echo Converter::convert_into_base64(
                                        public_path('img/icons/star-half.png')
                                    ); ?> width="18" height="18" alt="star">
                                    @endif
                                    @if($feedback->rating <= 2 ) <img src=<?php echo Converter::convert_into_base64(
                                        public_path('img/icons/star-grey.png')
                                    ); ?> width="18" height="18" alt="star">
                                        @elseif($feedback->rating >= 3 )
                                        <img src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-yellow-fill.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($feedback->rating > 2.5)
                                        <img src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-halfup.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @elseif($feedback->rating
                                        < 2.5) <img src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-halfdown.png'
                                            )
                                        ); ?> width="18" height="18" alt="star" />
                                        @elseif($feedback->rating == 2.5)
                                        <img src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-half.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                        @endif
                                        @if($feedback->rating <= 3 ) <img src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-grey.png'
                                            )
                                        ); ?> width="18" height="18" alt="star">
                                            @elseif($feedback->rating >= 4 )
                                            <img src=<?php echo Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-yellow-fill.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @elseif($feedback->rating > 3.5)
                                            <img src=<?php echo Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-halfup.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @elseif($feedback->rating
                                            < 3.5) <img src=<?php echo Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-halfdown.png'
                                                )
                                            ); ?> width="18" height="18" alt="star" />
                                            @elseif($feedback->rating == 3.5)
                                            <img src=<?php echo Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-half.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                            @endif
                                            @if($feedback->rating <= 4 ) <img src=<?php echo Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-grey.png'
                                                )
                                            ); ?> width="18" height="18" alt="star">
                                                @elseif($feedback->rating == 5)
                                                <img src=<?php echo Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-yellow-fill.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @elseif($feedback->rating > 4.5)
                                                <img src=<?php echo Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-halfup.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @elseif($feedback->rating
                                                < 4.5) <img src=<?php echo Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-halfdown.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star" />
                                                @elseif($feedback->rating == 4.5)
                                                <img src=<?php echo Converter::convert_into_base64(
                                                    public_path(
                                                        'img/icons/star-half.png'
                                                    )
                                                ); ?> width="18" height="18" alt="star">
                                                @endif
                            </td>
                            <td class="text-start">
                                <strong>{{ $feedback->freshness() }}</strong>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align:center">Looks empty</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@stop