<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')

<title>Dispute Messages - Squid Market</title>
@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5><i class="bi-cart-plus"></i> Your Dispute Message</h5>
        </div>
    </div>
</section>

<section class="section mt-0">
    <div class="container">
        <div class="account-card">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="p-2 h6 fw-bold bg-primary text-white rounded">Ordered ID: {{ $order->id }}</div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-5 mb-3">
                            <div class="h-100">
                                <div class="feature-card border mb-0 h-100">
                                    <div class="feature-media">
                                        <a class="feature-image" href="#">
                                            <img src="{{ $order->product->image }}" alt="product"
                                                style="border-radius: 5px">
                                        </a>
                                    </div>
                                    <div class="feature-content">
                                        <p class="mb-0 fw-bold"> {{ $order->product->name }} </p>
                                        <span class="mb-0 fw-bold">Order Amount:</span><span>
                                            {{ $order->quantity }} {{ ucfirst($order->mesure) }}</span><br>
                                        <span class="mb-0 fw-bold">Payment Currency:</span><span>
                                            @if($order->paytype == 'bic') Bitcoin @elseif($order->product->paytype ==
                                            'xmr') XMR @else Bitcoin and XMR @endif</span><br>
                                        <span class="mb-0 fw-bold">Product Type:</span><span>
                                            {{ $order->product->type }} | @if($order->paymethod == 'fe') <span
                                                class="text-danger">FE</span> @else Escrow @endif</span><br>
                                        <div class="d-flex align-items-center ">
                                            <span class="mb-0 fw-bold">Shipping Route : </span>&nbsp;
                                            @php
                                            $from = strtolower($order->product->ships_from);
                                            $to = strtolower($order->product->ships_to);
                                            @endphp
                                            <span class="float-start">
                                                <img src=<?php echo Converter::convert_into_base64(
                                                    public_path(
                                                        'img/flags/' .
                                                            $from .
                                                            '.png'
                                                    )
                                                ); ?> width="24px" height="14px" alt="Flag"
                                                    title="{{ $order->product->shipsFrom() }}"><img class="mx-1" src=<?php echo Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/arrow-right-black.png'
                                                        )
                                                    ); ?> width="17px" style="margin-top:-3px"><img src=<?php echo Converter::convert_into_base64(
     public_path('img/flags/' . $to . '.png')
 ); ?> width="24px" height="14px" alt="Flag" title="{{ $order->product->shipsTo() }}">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3 mb-3">
                            <div class="h-100">
                                <div class="product-card border rounded mb-0 h-100 text-center">
                                    <p class="mb-4 fw-bold">Payment QR-Code:</p>
                                    <img src=<?php echo \App\Tools\Converter::generateQRCode(
                                        $order->escrow_monero_wallet
                                    ); ?> width="100" height="100" />
                                    <div class="qr-text mt-3">{{ $order->escrow_monero_wallet }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-2 mb-3">
                            <div class="h-100">
                                <div class="product-card border rounded mb-0 h-100 text-center">
                                    @if ($order->paidOrder())
                                    <p class="mb-4 fw-bold">Payment Status: <span
                                            class="fw-normal text-success">Confirmed</span></p>
                                    <img src=<?php echo Converter::convert_into_base64(
                                        public_path('img/paid.png')
                                    ); ?> alt="payment required" width="100">
                                    @else
                                    <p class="mb-4 fw-bold">Payment Status: <span class="fw-normal text-danger">Requires
                                            10 Confirmations</span></p>
                                    <img src=<?php echo Converter::convert_into_base64(
                                        public_path('img/payment-required.jpg')
                                    ); ?> alt="payment required" width="100">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-2 mb-3">
                            <p class="fw-bold">Order Status:</p>
                            <label
                                class="@if($order->status=='waiting') order-status-active @else order-status @endif w-100 mb-1">Waiting</label>
                            <label
                                class="@if($order->status=='purchased') order-status-active @else order-status @endif w-100 mb-1">Purchased</label>
                            <label
                                class="@if($order->status=='accepted') order-status-active @else order-status @endif w-100 mb-1">Accepted</label>
                            <label
                                class="@if($order->status=='shipped') order-status-active @else order-status @endif w-100 mb-1">Shipped</label>
                            <label
                                class="@if($order->status=='delivered') order-status-active @else order-status @endif w-100 mb-1">Delivered</label>
                            <label
                                class="@if($order->status=='disputed') order-status-active @else order-status @endif w-100 mb-1">Disputed</label>
                            <label
                                class="@if($order->status=='canceled') order-status-active @else order-status @endif w-100 mb-1">Canceled</label>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-3 mb-3">
                            <p class="fw-bold">Order Actions:</p>
                            @if(auth()->user()->id == $order->seller->id)
                            <a href="{{ route('newconversation', ['vendor' => $order->buyer->id]) }}"
                                class="btn btn-xs btn-outline-primary w-100 mb-2"><i class="bi-envelope"></i>
                                Contact Buyer</a>
                            @endif
                            @if(auth()->user()->id == $order->seller->id and $order->dispute->status == 'unresolved')
                            <label for="refund" class="btn btn-xs btn-outline-primary w-100 mb-2">Refund</laebl>
                                <input type="radio" id="refund" name="refund" class="toggle-refund" hidden>
                                <input type="radio" id="toggle-close-refund" name="refund" hidden>
                                <div class="refund-panel text-center">
                                    <form method="get"
                                        action="{{ route('refund', ['dispute' => $order->dispute->id]) }}">
                                        @csrf
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/question-square_dark.png'
                                            )
                                        ); ?> width="50" alt="?" class="mb-4">
                                        <h5 class="mb-3 ">ARE YOU SURE YOU WANT TO REFUND DISPUTE FUNDS?</h5>
                                        <div>
                                            <button class="btn btn-success btn-sm" type="submit">Yes I want</button>
                                            <label for="toggle-close-refund" class="btn btn-primary btn-sm">No I
                                                don't</label>
                                        </div>
                                    </form>
                                </div>
                                @elseif(auth()->user()->id == $order->seller->id and $order->dispute->status ==
                                'resolved')
                                <label class="btn btn-xs btn-outline-primary w-100 mb-2">Resolved</laebl>
                                    @else(auth()->user->id == $order->buyer->id)
                                    <a href="{{ route('newconversation', ['vendor' => $order->seller->id]) }}"
                                        class="btn btn-xs btn-outline-primary w-100 mb-2"><i class="bi-envelope"></i>
                                        Contact Vendor</a>
                                    @endif
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3 mb-3">
                            <p class="fw-bold">Payment Address:</p>
                            <div class="qr-text">
                                {{ $order->escrow_monero_wallet }}
                            </div>
                            <p class="mb-0 fw-bold">Amount to Pay:</p>
                            <p class="">{{ $toPay }} <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/XMR2.png')
                            ); ?> width="18" height="18" alt="xmr" style="margin-top:-4px"></p>
                            <p class="mb-0 fw-bold">Amount Received:</p>
                            <p class=""> {{ $totalSent }} <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/XMR2.png')
                            ); ?> width="18" height="18" alt="xmr" style="margin-top:-4px"></p>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3 mb-3">
                            <p class="fw-bold">Encrypted Delivery Details:</p>
                            <textarea class="form-control" style="height: 170px;"
                                readonly>{{ $order->address }}</textarea>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3 mb-3">
                            @if(auth()->user()->id == $order->buyer->id)
                            <p class="fw-bold">Seller's PGP Key:</p>
                            <textarea class="form-control" style="height: 170px;"
                                readonly>{{ $order->seller->pgp_key }}</textarea>
                            @else
                            <p class="fw-bold">Buyer's PGP Key:</p>
                            <textarea class="form-control" style="height: 170px;"
                                readonly>{{ $order->buyer->pgp_key }}</textarea>
                            @endif
                        </div>
                    </div>
                    <hr>
                    @if(auth()->user()->isAdmin() && auth()->user()->id != $order->buyer->id && auth()->user()->id !=
                    $order->seller->id)
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-3 mb-2">
                            <label for="100" class="btn btn-xs btn-outline-danger w-100 mb-0">Award Buyer 100%
                                </laebl>
                                <input type="radio" id="100" name="funds100" class="toggle-funds100" hidden>
                                <input type="radio" id="toggle-close-funds100" name="funds100" hidden>
                                <div class="funds100-panel text-center">
                                    <form method="get"
                                        action="{{ route('sharefunds100', ['dispute' => $order->dispute->id]) }}">
                                        @csrf
                                        <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/question-square_dark.png'
                                            )
                                        ); ?> width="50" alt="?" class="mb-4">
                                        <h5 class="mb-3 ">ARE YOU SURE YOU WANT TO REFUND DISPUTE FUNDS?</h5>
                                        <div>
                                            <button class="btn btn-success btn-sm" type="submit">Yes I want</button>
                                            <label for="toggle-close-funds100" class="btn btn-primary btn-sm">No I
                                                don't</label>
                                        </div>
                                    </form>
                                </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-2 mb-2">
                            <label for="75" class="btn btn-xs btn-outline-danger w-100 mb-0">Award 75% to Buyer</label>
                            <input type="radio" id="75" name="funds75" class="toggle-funds75" hidden>
                            <input type="radio" id="toggle-close-funds75" name="funds75" hidden>
                            <div class="funds75-panel text-center">
                                <form method="get"
                                    action="{{ route('sharefunds75', ['dispute' => $order->dispute->id]) }}">
                                    @csrf
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/question-square_dark.png'
                                        )
                                    ); ?> width="50" alt="?" class="mb-4">
                                    <h5 class="mb-3 ">ARE YOU SURE YOU WANT TO AWARD 75% TO BUYER?</h5>
                                    <div>
                                        <button class="btn btn-success btn-sm" type="submit">Yes I want</button>
                                        <label for="toggle-close-funds75" class="btn btn-primary btn-sm">No I
                                            don't</label>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-2 mb-2">
                            <label for="50" class="btn btn-xs btn-outline-danger w-100 mb-0">Share Funds 50/50</label>
                            <input type="radio" id="50" name="funds50" class="toggle-funds50" hidden>
                            <input type="radio" id="toggle-close-funds50" name="funds50" hidden>
                            <div class="funds50-panel text-center">
                                <form method="get"
                                    action="{{ route('sharefunds50', ['dispute' => $order->dispute->id]) }}">
                                    @csrf
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/question-square_dark.png'
                                        )
                                    ); ?> width="50" alt="?" class="mb-4">
                                    <h5 class="mb-3 ">ARE YOU SURE YOU WANT TO SHARE FUNDS 50/50?</h5>
                                    <div>
                                        <button class="btn btn-success btn-sm" type="submit">Yes I want</button>
                                        <label for="toggle-close-funds50" class="btn btn-primary btn-sm">No I
                                            don't</label>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-2 mb-2">
                            <label for="25" class="btn btn-xs btn-outline-danger w-100 mb-0">Award 25% to Buyer</label>
                            <input type="radio" id="25" name="funds25" class="toggle-funds25" hidden>
                            <input type="radio" id="toggle-close-funds25" name="funds25" hidden>
                            <div class="funds25-panel text-center">
                                <form method="get"
                                    action="{{ route('sharefunds25', ['dispute' => $order->dispute->id]) }}">
                                    @csrf
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/question-square_dark.png'
                                        )
                                    ); ?> width="50" alt="?" class="mb-4">
                                    <h5 class="mb-3 ">ARE YOU SURE YOU WANT TO AWARD 25% TO BUYER?</h5>
                                    <div>
                                        <button class="btn btn-success btn-sm" type="submit">Yes I want</button>
                                        <label for="toggle-close-funds25" class="btn btn-primary btn-sm">No I
                                            don't</label>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3 mb-2">
                            <label for="0" class="btn btn-xs btn-outline-danger w-100 mb-0">Award 100% to Seller</label>
                            <input type="radio" id="0" name="funds0" class="toggle-funds0" hidden>
                            <input type="radio" id="toggle-close-funds0" name="funds0" hidden>
                            <div class="funds0-panel text-center">
                                <form method="get"
                                    action="{{ route('sharefunds0', ['dispute' => $order->dispute->id]) }}">
                                    @csrf
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/question-square_dark.png'
                                        )
                                    ); ?> width="50" alt="?" class="mb-4">
                                    <h5 class="mb-3 ">ARE YOU SURE YOU WANT TO AWARD 100% TO SELLER?</h5>
                                    <div>
                                        <button class="btn btn-success btn-sm" type="submit">Yes I want</button>
                                        <label for="toggle-close-funds0" class="btn btn-primary btn-sm">No I
                                            don't</label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section mt-3 mb-3 d-none">
    <div class="container">
        <div class="card">
            <div class="card-header"><i class="bi-reply"></i> Add New Reply</div>
            <div class="card-body">
                <form class="user-form">
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">New Message</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" placeholder="Type new dispute message"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label">Captcha</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label><img src="img/captcha3.png" alt="captcha"></label>
                                    <input type="text" class="form-control" placeholder="Enter Captcha">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-0">
                        <label class="col-sm-4 col-form-label"></label>
                        <div class="col-sm-8">
                            <a href="#" class="btn btn-sm btn-primary"><i class="bi-envelope"></i> Send Message</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>

<div class="container">
    <section class="msger">
        <header class="msger-header">
            <div class="msger-header-title">
                <i class="bi-chat-dots"></i> Dispute Message
            </div>
            <div class="msger-header-options">
            </div>
        </header>

        <main class="msger-chat">
            @forelse($order->dispute->messages() as $message)
            @if(auth()->user()->id == $order->dispute->admin_id)
            @if($message->user->id == $order->dispute->admin_id)
            <div class="msg full-msg text-center">
                <div class="msg-bubble">
                    <div class="msg-text">
                        <strong><span class="badge bg-success">{{$message->user->username}}
                                (Admin)</span><br>{{$message->decryptMessage()}}</strong>
                    </div>
                </div>
            </div>
            @else
            <div class="msg @if($message->user->id == $order->seller->id)left-msg @else right-msg @endif">
                <div class="msg-img" style="background-image: url({{ $message->user->avatar }});"></div>
                <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">{{ $message->user->username }}@if($message->user_id ==
                            $order->dispute->seller_id)(Seller)@else(Buyer)@endif</div>
                        <div class="msg-info-time">{{ $message->creationDate() }}</div>
                    </div>
                    <div class="msg-text">
                        {{ $message->decryptMessage() }}
                    </div>
                </div>
            </div>
            @endif
            @else
            @if($message->user->id == $order->dispute->admin_id)
            <div class="msg full-msg text-center">
                <div class="msg-bubble">
                    <div class="msg-text">
                        <strong><span class="badge bg-success">{{$message->user->username}}
                                (Admin)</span><br>{{$message->decryptMessage()}}</strong>
                    </div>
                </div>
            </div>
            @else
            <div class="msg @if($message->user->id == auth()->user()->id)right-msg @else left-msg @endif">
                <div class="msg-img" style="background-image: url({{ $message->user->avatar }});"></div>
                <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">{{ $message->user->username }}@if($message->user->id ==
                            $order->dispute->seller_id)(Seller)@else(Buyer)@endif</div>
                        <div class="msg-info-time">{{ $message->creationDate() }}</div>
                    </div>
                    <div class="msg-text">
                        {{ $message->decryptMessage() }}
                    </div>
                </div>
            </div>
            @endif
            @endif
            @empty
            @endforelse
        </main>
        @if($order->disputed())
        <form class="msger-inputarea" method="post"
            action="{{ route('post.createdisputemessage', ['dispute' => $order->dispute->id]) }}">
            @csrf
            <input type="text" class="msger-input" name="message" placeholder="Enter your message...">
            <button type="submit" class="msger-send-btn">Message</button>
        </form>
        @endif
    </section>
</div>
@stop