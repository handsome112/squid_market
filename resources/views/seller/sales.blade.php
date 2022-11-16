<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')

<title>{{ucfirst($status)}} Sales - Squid Market</title>
@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/list.png')
            ); ?> width="17px" style="margin-top:-3px"> {{ucfirst($status)}} Sales</h5>
        </div>
    </div>
</section>
@php
$rates = \App\Tools\Converter::currencyLatestPrice();
@endphp
<section class="section mt-0">
    <div class="container">
        <div class="account-card">
            <div class="row">
                <div class="col-md-12 col-lg-2">
                    <ul class="nav nav-account">
                        <li @if($status=='all' ) class="nav-item active" @else class="nav-item" @endif>
                            <a href="{{ route('sales', ['status' => 'all']) }}">
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/list.png')
                                ); ?> width="16px" style="margin-right:3px"> All
                                Sales({{ $user->sales()->count() - $user->totalSales('waiting') }})</a>
                        </li>
                        <li @if($status=='waiting' ) class="nav-item active" @else class="nav-item" @endif>
                            <a href="{{ route('sales', ['status' => 'waiting']) }}">
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/clock.png')
                                ); ?> width="16px" style="margin-right:3px">Waiting
                                Sales({{$user->totalSales('waiting')}})</a>
                        </li>
                        <li @if($status=='purchased' ) class="nav-item active" @else class="nav-item" @endif>
                            <a href="{{ route('sales', ['status' => 'purchased']) }}">
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/clock.png')
                                ); ?> width="16px" style="margin-right:3px">Purchased
                                Sales({{$user->totalSales('purchased')}})</a>
                        </li>
                        <li @if($status=='accepted' ) class="nav-item active" @else class="nav-item" @endif>
                            <a href="{{ route('sales', ['status' => 'accepted']) }}">
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/check.png')
                                ); ?> width="16px" style="margin-right:3px"> Accepted
                                Sales({{ $user->totalSales('accepted') }})</a>
                        </li>
                        <li @if($status=='shipped' ) class="nav-item active" @else class="nav-item" @endif>
                            <a href="{{ route('sales', ['status' => 'shipped']) }}">
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/shipped.png')
                                ); ?> width="16px" style="margin-right:3px">Shipped
                                Sales({{$user->totalSales('shipped')}})
                            </a>
                        </li>
                        <li @if($status=='delivered' ) class="nav-item active" @else class="nav-item" @endif>
                            <a href="{{ route('sales', ['status' => 'delivered']) }}">
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/gift.png')
                                ); ?> width="16px" style="margin-right:3px">Delivered
                                Sales({{$user->totalSales('delivered')}})
                            </a>
                        </li>
                        <li @if($status=='disputed' ) class="nav-item active" @else class="nav-item" @endif>
                            <a href="{{ route('sales', ['status' => 'disputed']) }}">
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/dispute.png')
                                ); ?> width="16px" style="margin-right:3px">Disputed
                                Sales({{$user->totalSales('disputed')}})
                            </a>
                        </li>
                        <li @if($status=='canceled' ) class="nav-item active" @else class="nav-item" @endif>
                            <a href="{{ route('sales', ['status' => 'canceled']) }}">
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/cancel.png')
                                ); ?> width="16px" style="margin-right:3px">Canceled
                                Sales({{$user->totalSales('canceled')}})
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-12 col-lg-10">

                    <div class="p-2 h6 fw-bold bg-primary text-white rounded mb-3"><img src=<?php echo Converter::convert_into_base64(
                        public_path('img/icons/tags.png')
                    ); ?> width="17px" style="margin-right:3px" /> Sales</div>

                    @forelse($sales as $order)
                    <div class="account-title bg-light p-2 mb-0 border border-bottom-0">
                        <a href="{{ route('detailview', ['product' => $order->product->id]) }}" id="orderproduct">
                            <h6 class="fw-bold onlyonerow" style="width:400px">{{ $order->product->name }}</h6>
                        </a>
                        <div>
                            <a href="{{ route('sale', ['order' => $order->id]) }}" class="btn btn-info btn-xs"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/eye-black.png')
                            ); ?> width="13px" style="margin-right:3px;margin-top:-3px"> View Sale</a>
                            <a href="{{ route('newconversation', ['vendor' => $order->buyer->id]) }}"
                                class="btn btn-info btn-xs"><img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/messenger-dark.png')
                                ); ?> width="13px" style="margin-right:3px;margin-top:-3px"> Messages</a>
                            @if($order->purchased())
                            <label for="accept{{ $order->id }}" class="btn btn-success btn-xs"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/check.png')
                            ); ?> width="13px" style="margin-right:3px;margin-top:-3px"> Accept Order</label>
                            @endif
                            <input type="radio" id="accept{{ $order->id }}" name="acceptorder"
                                class="toggle-acceptorder" hidden>
                            <input type="radio" id="toggle-close-accept" name="acceptorder" hidden>
                            <div class="acceptorder-panel text-center">
                                <form method="get"
                                    action="{{ route('post.changeorderstatus', ['order' => $order->id, 'status' => 'accepted']) }}">
                                    @csrf
                                    <img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/question-square_dark.png'
                                        )
                                    ); ?> width="50" alt="?" class="mb-4">
                                    <h5 class="mb-3 ">ARE YOU SURE YOU WANT TO ACCEPT THIS ORDER?</h5>
                                    <div>
                                        <button class="btn btn-success btn-sm" type="submit">Yes I want</button>
                                        <label for="toggle-close-accept" class="btn btn-primary btn-sm">No I
                                            don't</label>
                                    </div>
                                </form>
                            </div>
                            @if($order->accepted())
                            <a href="{{ route('post.changeorderstatus', ['order' => $order->id, 'status' => 'shipped']) }}"
                                class="btn btn-success btn-xs"><img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/check.png')
                                ); ?> width="13px" style="margin-right:3px;margin-top:-3px"> Mark as Shipped</a>
                            @endif
                            @if($order->purchased() or $order->accepted() or $order->waiting())
                            <label for="cancel{{ $order->id }}" class="btn btn-primary btn-xs"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/cancel.png')
                            ); ?> width="16px" style="margin-right:3px"> Cancel Order</label>
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
                            @if($order->shipped() and $order->paymehtod != 'fe' and !$order->purchased())
                            <label for="dispute{{ $order->id }}" class="btn btn-primary btn-xs"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/dispute.png')
                            ); ?> width="16px" style="margin-right:3px"> Dispute Order</label>
                            @endif
                            <input type="radio" id="dispute{{ $order->id }}" name="disputeorder"
                                class="toggle-disputeorder" hidden>
                            <input type="radio" id="toggle-close-cancel" name="disputeorder" hidden>
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
                                class="btn btn-warning btn-xs"><img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/dispute-black.png')
                                ); ?> width="13px" style="margin-right:3px;margin-top:-3px"> View Dispute </a>
                            @endif
                        </div>
                    </div>
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Payment Type</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Buyer</th>
                                    <th scope="col">Shipping with</th>
                                    <th scope="col">Purchased at</th>
                                    <th scope="col">Auto Finalizer at</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ number_format($order->total * $rates[auth()->user()->currency] / $rates[$order->product->currency], 2) }}
                                        {{ auth()->user()->currency }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>
                                        @if($order->paymethod == 'fe')
                                        <label
                                            style="background-color:var(--primary);color:white;padding:2px 5px;border-radius:5px">Finalize
                                            Early</label>
                                        @elseif($order->paymethod == 'escrow')
                                        <label
                                            style="background-color:var(--green);color:white;padding:2px 5px;border-radius:5px">Normal
                                            Escrow</label>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-status">
                                            <button type="button"
                                                class="btn btn-paid {{ $order->paidOrder() ? 'active' : '' }}"><i
                                                    class="bi-currency-dollar"></i> Paid</button>
                                            <button type="button"
                                                class="btn btn-shipped {{ $order->status=='shipped' ? 'active' : '' }}"><i
                                                    class="bi-truck"></i>
                                                Shipped</button>
                                            <button type="button"
                                                class="btn btn-delivered {{ $order->status=='delivered' ? 'active' : '' }}"><i
                                                    class="bi-gift"></i>
                                                Delivered</button>
                                            <button type="button"
                                                class="btn btn-disputed {{ $order->status=='disputed' ? 'active' : '' }}"><i
                                                    class="bi-exclamation-triangle"></i> Disputed</button>
                                        </div>
                                    </td>
                                    <td>{{ $order->buyer->username }}</td>
                                    @if($order->product->type == "Physical")
                                    <td>{{ $order->ships_with }}</td>
                                    @else
                                    <td>-</td>
                                    @endif
                                    <td>{{ $order->created_at }}</td>
                                    @if($order->product->type == 'Physical')
                                    <td>{{ $order->created_at->addDays(config('general.days_complete_orders')) }}</td>
                                    @else
                                    <td>{{ $order->created_at->addDays(config('general.days_complete_orders_d')) }}</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @empty
                    <div>Looks Empty :(</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
@stop