<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')
<title>Overview - Squid Market</title>
@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')

<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/panel.png')
            ); ?> width="17px" style="margin-top:-3px"> Panel</h5>
        </div>
    </div>
</section>

<section class="section mt-0 mb-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-3">
                <div class="account-card h-100 mb-0">
                    <div class="account-content mt-3">
                        <div class="profile-image">
                            <img src="{{ auth()->user()->avatar }}" width="80px" alt="user">
                        </div>
                        <center style="margin-top: 45px">
                            {{auth()->user()->username}}
                            <br>
                            Last Login: {{auth()->user()->last_login}}
                        </center>
                        <form action="{{ route('put.changeavatar') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="d-flex justify-content-between">
                                <label for="avatar" class="form-label">Change Avatar</label>
                            </div>
                            <input class="form-control" name="avatar" id="avatar" type="file">
                            <div class="text-center mt-4"><input type="submit" class="btn btn-primary btn-sm"
                                    value="Confirm"></div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-3">
                <div class="account-card h-100 mb-0">
                    <div class="account-title mt-3">
                        <h4>Profile description</h4>
                    </div>
                    <form action="{{ route('post.savedescription') }}" method="post">
                        @csrf
                        <div class="account-content">
                            <div class="form-group">
                                <textarea style="height: 165px" class="form-control" name="description"
                                    id="description">{{ auth()->user()->description }}</textarea>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section mt-0">
    <div class="container">
        <div class="account-card">
            <div class="row">
                <div class="col-md-3 col-lg-3">
                    <ul class="nav nav-account">
                        <li class="nav-item active">
                            <a href="">
                                <!-- <i class="bi-graph-up"></i>  -->
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/stats.png')
                                ); ?> width="13px" style="margin-top:-2px;margin-right:5px">
                                Stats
                            </a>
                        </li>
                        @if(auth() -> user() -> isSeller())
                        <li class="nav-item">
                            <a href="{{ route('seller.dashboard') }}"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/helpdesk.png')
                            ); ?> width="13px" style="margin-top:-2px;margin-right:5px"> Vendor Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sales', ['status' => 'all']) }}"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/bag.png')
                            ); ?> width="13px" style="margin-top:-2px;margin-right:5px"> Sales</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('support')}}"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/helpdesk.png')
                            ); ?> width="13px" style="margin-top:-2px;margin-right:5px"> Support</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('seller', ['seller' => auth()->user()->username]) }}"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/helpdesk.png')
                            ); ?> width="13px" style="margin-top:-2px;margin-right:5px"> Vist My Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('affiliate')}}"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/share.png')
                            ); ?> width="13px" style="margin-top:-2px;margin-right:5px"> Referral Program</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{ route('orders', ['status' => 'purchased']) }}"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/cart-check.png')
                            ); ?> width="13px" style="margin-top:-2px;margin-right:5px">
                                Purchases</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders', ['status' => 'disputed']) }}"><img
                                    src="{{ asset('img/icons/dispute.png') }}" width="13px"
                                    style="margin-top:-2px;margin-right:5px"> Disputes</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('favorites')}}"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/heart.png')
                            ); ?> width="13px" style="margin-top:-2px;margin-right:5px"> Wishlist</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('affiliate')}}"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/share.png')
                            ); ?> width="13px" style="margin-top:-2px;margin-right:5px"> Referral Program</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('becomeseller')}}"><img src=<?php echo Converter::convert_into_base64(
                                public_path(
                                    'img/icons/UPGRADE TO VENDOR icon.png'
                                )
                            ); ?> width="13px" style="margin-top:-2px;margin-right:5px"> Upgrade to Vendor</a>
                        </li>
                        @endif
                    </ul>
                </div>
                <div class="col-md-9 col-lg-9">
                    <div class="wallet-card-group mb-3">
                        <div class="wallet-card">
                            <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/accept.png')
                            ); ?> width="80px" style="margin-top:-2px;margin-right:5px">
                            @if(auth()->user()->isSeller())
                            <p>Accepted Salse</p>
                            <h3>{{ auth()->user()->totalSales('accepted') }} </h3>
                            @else
                            <p>Accepted Orders</p>
                            <h3>{{ auth() -> user() -> totalOrders('accepted') }}</h3>
                            @endif
                        </div>
                        <div class="wallet-card">
                            <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/clock.png')
                            ); ?> width="80px" style="margin-top:-2px;margin-right:5px">
                            @if(auth()->user()->isSeller())
                            <p>Disputes</p>
                            <h3>{{ auth()->user()->totalSales('disputed') }} </h3>
                            @else
                            <p>Disputes</p>
                            <h3>{{ auth() -> user() -> totalOrders('disputed') }}</h3>
                            @endif
                        </div>
                        <div class="wallet-card">
                            <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/check.png')
                            ); ?> width="80px" style="margin-top:-2px;margin-right:5px">
                            @if(auth()->user()->isSeller())
                            <p>Watiing Sales</p>
                            <h3>{{ auth()->user()->totalSales('waiting') }} </h3>
                            @else
                            <p>Waiting Orders</p>
                            <h3>{{ auth() -> user() -> totalOrders('waiting') }}</h3>
                            @endif
                        </div>
                    </div>

                    <div class="wallet-card-group">
                        <div class="wallet-card">
                            <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/cart.png')
                            ); ?> width="80px" style="margin-top:-2px;margin-right:5px">
                            @if(auth()->user()->isSeller())
                            <p>All Sales</p>
                            <h3>{{ auth()->user()->sales()->count() - auth()->user()->totalSales('waiting') }} </h3>
                            @else
                            <p>All Orders</p>
                            <h3>{{ auth() -> user() -> orders->count() }} </h3>
                            @endif
                        </div>
                        <div class="wallet-card">
                            <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/user-plus.png')
                            ); ?> width="80px" style="margin-top:-2px;margin-right:5px">
                            @if(auth()->user()->isSeller())
                            <p>Delivered Sales</p>
                            <h3>{{ auth()->user()->totalSales('delivered') }} </h3>
                            @else
                            <p>Delivered Orders</p>
                            <h3>{{ auth() -> user() -> totalOrders('delivered') }}</h3>
                            @endif
                        </div>
                        <div class="wallet-card">
                            <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/cash.png')
                            ); ?> width="80px" style="margin-top:-2px;margin-right:5px">
                            <p>Referral Earning</p>
                            <h3>$0</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if(session()->has('overlay') and session()->get('overlay') === 'OK')
<details class="dark" open>
    <summary>
        <div class="details-modal-overlay"></div>
    </summary>
    <div class="details-modal modal-lg">
        <div class="details-modal-close">
            <!-- <i class="bi-x" style="font-size: 30px"></i> -->
            <img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/close.png')
            ); ?> width="20px">
        </div>
        <div class="details-modal-title">Squid Market links and Information</div>
        <div class="details-modal-title-subtitle">These are the only offical links for <span class="text-white">Squid
                Market!</span> Bookmark them, write them down, save them!!<br>Signed by the main admin key, you can find
            it <a href="#" class="text-white">here</a></div>
        <div class="details-modal-content">
            <textarea class="form-control" style="height: 370px;" readonly>
-----BEGIN PGP SIGNED MESSAGE-----
Hash: SHA512

http://mvuwtdbwkaoo53q67nrpqghd4jdqzppmmdeppbdsstefxuyaxplof5id.onion
-----BEGIN PGP SIGNATURE-----

iQGTBAEBCgB9FiEE6TPnerreeGf74wAjCKFMiyYqXpoFAmNr4G5fFIAAAAAALgAo
aXNzdWVyLWZwckBub3RhdGlvbnMub3BlbnBncC5maWZ0aGhvcnNlbWFuLm5ldEU5
MzNFNzdBQkFERTc4NjdGQkUzMDAyMzA4QTE0QzhCMjYyQTVFOUEACgkQCKFMiyYq
XprgWQgAgFhjS6/a7JswTTr6bMS7XjWCQyQuWXsIr7JHpzoc6Ib5O1DienVqE15Z
BLBEcuUfnhOYAKPW79Pdu7Y2uhj1fUvKW/5yHo9mZdjYNSZ23owfTLDzuhr1/RG1
MSrrwh9VSucpX3bL3Rvwbh6b7bEVbiQB2jVcv3nYh+7niUgiCzE6kf0LoSu+k+Uv
mYwbVh+cSVHQD8UqtBr+ehvrVk7GXYUnhTpHrNIqMOiUz6LbC7w6DiwW0Hz8j4NA
jAFIjZKqS7II4TPYmtxkfNLrb9fZkrS6khThm6s8eUh1rzefRwdvcfeWyOMNON6+
xqw5DK5Q7QcVwGWTXBYRfcN9lm+suA==
=uRA6
-----END PGP SIGNATURE-----</textarea>
        </div>
    </div>
</details>
<?php session()->forget('overlay'); ?>
@endif

@stop
