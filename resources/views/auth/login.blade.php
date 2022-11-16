<?php namespace App\Tools; ?>
@extends('master.main')
@section('no-content')

<title>Login - Squid Market </title>

<body class="bg-dark">
    <div class="backdrop"></div>
    <section class="user-form-part">
        <section class="section mt-3">
            <div class="user-form-logo"><img style="width:400px;" src=<?php echo Converter::convert_into_base64(
                public_path('logo.png')
            ); ?> alt="logo"></div>
            <div class="container">
                <ul class="nav nav-tabs">
                    <li><a href="{{route('login')}}" class="tab-link">Login</a></li>
                    <li><a href="{{route('register')}}" class="tab-link">Sign up</a></li>
                    <li><a href="#" class="tab-link">Check Mirror</a></li>
                </ul>
            </div>
            @include('includes.flash.success')
            @include('includes.flash.error')
            <div class="container text-center">
                <div class="page-title justify-content-center">
                    <h5 class="fw-bold"><img src=<?php echo Converter::convert_into_base64(
                        public_path('img/icons/helpdesk.png')
                    ); ?> width="17px" style="margin-top:-3px"> Login</h5>
                </div>
            </div>
        </section>

        <form action="{{ route('post.login') }}" method="post">
            @csrf
            <section class="user-form-part pt-0">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <div class="user-form-card">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input id="username" name="username" class="form-control" placeholder="SquidUser">
                                    @error('username')
                                    <p class="text-danger">{{ $errors->first('username') }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="Password">
                                    @error('password')
                                    <p class="text-danger">{{ $errors->first('password') }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Session Time</label>
                                    <select class="form-select" aria-label="Session Time select">
                                        <option value="1" selected>10 minutes</option>
                                        <option value="2">30 minutes</option>
                                        <option value="2">60 minutes</option>
                                        <option value="2">128 minutes</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-24 col-md-12 col-lg-12">
                                        @include('includes.forms.captcha')
                                    </div>
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-sm">login</button>
                                </div>
        </form>
        </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="user-form-card bg-secondary text-white">
                <h2 class="mb-3 text-white h3">Welcome to Squid <span>Market</span>!</h2>
                <p>We are extremely proud to present to you the future of Darknet Markets on our platform.<br> We have
                    worked tirelessly to provide you a high quality shopping experience with the best quality vendors
                    and the safety of your funds.<br> To begin your shopping experience, you may login or register
                    with a new username and password combination. </p>
                <p>- <strong>Squid</strong> Team</p>
            </div>

            <div class="user-form-card">
                <h3 class="mb-3">Account Recovery</h3>
                <p>To reset your account, enter your Mnemonic Phrase or PGP key.</p>
                <p>If you have not already set up a PGP key
                    but you still need to reset your account, you can use your Mnemonic Phrase, if you lost your
                    Mnemonic Phrase please register a new username and open a support ticket referencing the issue.</p>
                <p>If you forgot your account details
                    <a href="{{ route('resetpassword') }}" class="link-danger">reset it here.</a>
                </p>
                <p>URL:<img src="/../url.png"> </p>
                <a href="" class="link-danger">
                    <small>if this does not match what's in the address bar leave immediately.</small>
                </a>
            </div>
        </div>

        </div>
        </div>

    </section>

    </section>

</body>





@stop