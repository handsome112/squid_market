@extends('master.main')
@section('content')

<title>Order details - Squid Market</title>
@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')

<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5><img src=<?php echo \App\Tools\Converter::convert_into_base64(
                public_path('img/icons/cart-plus.png')
            ); ?> width="17px" style="margin-top:-3px"> Order Details</h5>
        </div>
    </div>
</section>

<section class="section mt-0">
    <div class="container">
        <div class="account-card">
            <div class="row">
                <div class="col-md-12 col-lg-2">
                    <ul class="nav nav-account">
                        <li class="nav-item">
                            <a href="{{ route('orders', ['status' => 'all']) }}"><img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                public_path('img/icons/list.png')
                            ); ?> width="16px" style="margin-right:3px"> All Your
                                Orders ({{ $user->orders->count() }})</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders', ['status' => 'waiting']) }}"><img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                public_path('img/icons/clock.png')
                            ); ?> width="16px" style="margin-right:3px"> Waiting
                                Orders
                                ({{ $user->totalOrders('waiting') }})</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders', ['status' => 'purchased']) }}"><img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                public_path('img/icons/money.png')
                            ); ?> width="16px" style="margin-right:3px"> Purchased
                                Orders
                                ({{ $user->totalOrders('purchased') }})</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders', ['status' => 'accepted']) }}"><img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                public_path('img/icons/check.png')
                            ); ?> width="16px" style="margin-right:3px"> Accepted
                                Orders
                                ({{ $user->totalOrders('accepted') }})</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders', ['status' => 'shipped']) }}"><img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                public_path('img/icons/shipped.png')
                            ); ?> width="16px" style="margin-right:3px"> Shipped
                                Orders
                                ({{ $user->totalOrders('shipped') }})</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders', ['status' => 'delivered']) }}"><img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                public_path('img/icons/gift.png')
                            ); ?> width="16px" style="margin-right:3px"> Delivered
                                Orders
                                ({{ $user->totalOrders('delivered') }})</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders', ['status' => 'disputed']) }}"><img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                public_path('img/icons/dispute.png')
                            ); ?> width="16px" style="margin-right:3px"> Disputed Orders
                                ({{ $user->totalOrders('disputed') }})</a>
                        </li>
                        <li class="nav-item" f>
                            <a href="{{ route('orders', ['status' => 'canceled']) }}"><img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                public_path('img/icons/cancel.png')
                            ); ?> width="16px" style="margin-right:3px">
                                Canceled Orders
                                ({{ $user->totalOrders('canceled') }})</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-12 col-lg-10">
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
                                        @if($order->product->type == "Physical")
                                        <div class="d-flex align-items-center ">
                                            <span class="mb-0 fw-bold">Shipping Route : </span>&nbsp;
                                            @php
                                            $from = strtolower($order->product->ships_from);
                                            $to = strtolower($order->product->ships_to);
                                            @endphp
                                            <span class="float-start">
                                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                    public_path(
                                                        'img/flags/' .
                                                            $from .
                                                            '.png'
                                                    )
                                                ); ?> width="24px" height="14px" alt="Flag"
                                                    title="{{ $order->product->shipsFrom() }}"><img class="mx-1" src=<?php echo \App\Tools\Converter::convert_into_base64(
                                                        public_path(
                                                            'img/icons/arrow-right-black.png'
                                                        )
                                                    ); ?> width="17px" style="margin-top:-3px"><img src=<?php echo \App\Tools\Converter::convert_into_base64(
     public_path('img/flags/' . $to . '.png')
 ); ?> width="24px" height="14px" alt="Flag" title="{{ $order->product->shipsTo() }}">
                                            </span>
                                        </div>
                                        @endif
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
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path('img/paid.png')
                                    ); ?> alt="paid" width="100">
                                    @else
                                    <p class="mb-4 fw-bold">Payment Status: <span class="fw-normal text-danger">Requires
                                            10 Confirmations</span></p>
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
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
                            <a href="{{ route('newconversation', ['vendor' => $order->seller->id]) }}"
                                class="btn btn-xs btn-outline-primary w-100 mb-2"><img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                    public_path('img/icons/messenger-blue.png')
                                ); ?> width="13px" style="margin-right:3px;margin-top:-3px">
                                Contact Vendor</a>
                            @if($order->waiting() or $order->canceled() or $order->delivered() or $order->purchased() or
                            $order->disputed() or
                            $order->paymethod == 'fe')

                            @else
                            <label for="dispute{{ $order->id }}" class="btn btn-xs btn-outline-danger w-100 mb-2"><img
                                    src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path('img/icons/dispute-red.png')
                                    ); ?> width="13px" style="margin-right:3px;margin-top:-3px">
                                Dispute Order</label>
                            @endif
                            <input type="radio" id="dispute{{ $order->id }}" name="disputeorder"
                                class="toggle-disputeorder" hidden>
                            <input type="radio" id="toggle-close-dispute" name="disputeorder" hidden>
                            <div class="disputeorder-panel text-center">
                                <form method="get"
                                    action="{{ route('post.changeorderstatus', ['order' => $order->id, 'status' => 'disputed']) }}">
                                    @csrf
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/question-square_dark.png'
                                        )
                                    ); ?> width="50" alt="?" class="mb-4">
                                    <h5 class="mb-3 ">ARE YOU SURE YOU WANT TO DISPUTE THIS ORDER?</h5>
                                    <div>
                                        <button class="btn btn-success btn-sm" type="submit">Yes I want</button>
                                        <label for="toggle-close-dispute" class="btn btn-primary btn-sm">No I
                                            don't</label>
                                    </div>
                                </form>
                            </div>
                            @if($order->disputed())
                            <a href="{{ route('dispute-message', [ 'order' => $order->id ]) }}"
                                class="btn btn-outline-warning btn-xs w-100 mb-2"><img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                    public_path('img/icons/dispute-warning.png')
                                ); ?> width="16px" style="margin-right:3px"> View Dispute </a>
                            @endif
                            @if($order->status=='canceled')
                            @elseif($order->waiting() or $order->purchased() or $order->accepted())
                            <label for="cancel{{ $order->id }}" class="btn btn-xs btn-outline-danger w-100 mb-2"><img
                                    src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/x-circle-red.png'
                                        )
                                    ); ?> width="13px" style="margin-right:3px;margin-top:-3px">
                                Cancel Order</label>
                            @endif
                            <input type="radio" id="cancel{{ $order->id }}" name="cancelorder"
                                class="toggle-cancelorder" hidden>
                            <input type="radio" id="toggle-close-cancel" name="cancelorder" hidden>
                            <div class="cancelorder-panel text-center">
                                <form method="get"
                                    action="{{ route('post.changeorderstatus', ['order' => $order->id, 'status' => 'canceled']) }}">
                                    @csrf
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/question-square_dark.png'
                                        )
                                    ); ?> width="50" alt="?" class="mb-4">
                                    <h5 class="mb-3 ">ARE YOU SURE YOU WANT TO CANCEL THIS ORDER?</h5>
                                    <div>
                                        <button class="btn btn-success btn-sm" type="submit">Yes I want</button>
                                        <label for="toggle-close-cancel" class="btn btn-primary btn-sm">No I
                                            don't</label>
                                    </div>
                                </form>
                            </div>
                            @if($order->shipped())
                            <label for="toggle-feedback" class="btn btn-outline-success w-100 btn-xs mb-2">
                                <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                    public_path('img/icons/gift_green.png')
                                ); ?> width="13px" style="margin-right:3px;margin-top:-3px"> Mark as Delivered</label>
                            @endif
                            @include('includes.components.feedback')
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3 mb-3">
                            <p class="fw-bold">Payment Address:</p>
                            <div class="qr-text">
                                {{ $order->escrow_monero_wallet }}
                            </div>
                            <p class="mb-0 fw-bold">Amount to Pay:</p>
                            <p class="">XMR {{ $toPay }} <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                public_path('img/XMR2.png')
                            ); ?> width="18" height="18" alt="xmr"></p>
                            <p class="mb-0 fw-bold">Amount Received:</p>
                            <p class=""> XMR {{ $totalSent }} <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                public_path('img/XMR2.png')
                            ); ?> width="18" height="18" alt="xmr"></p>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3 mb-3">
                            <p class="fw-bold">Encrypted Delivery Details:</p>
                            <textarea class="form-control" style="height: 170px;"
                                readonly>{{ $order->address }}</textarea>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3 mb-3">
                            <p class="fw-bold">Seller's PGP Key:</p>
                            <textarea class="form-control" style="height: 170px;"
                                readonly>{{ $order->seller->pgp_key }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop