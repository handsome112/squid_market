<?php namespace App\Tools; ?>
@extends('master.main')
@section('no-content')
<title>Register - Squid Market </title>

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
            @include('includes.flash.error')
            <div class="container text-center">
                <div class="page-title justify-content-center">
                    <h5 class="fw-bold"><img src=<?php echo Converter::convert_into_base64(
                        public_path('img/icons/user-plus.png')
                    ); ?> width="17px" style="margin-top:-3px"> Register</h5>
                </div>
            </div>
        </section>
        <form action="{{ route('post.register') }}" method="post">
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
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" type="password" id="password" name="password"
                                                placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Password Repeat</label>
                                            <input class="form-control" type="password" id="password_confirmation"
                                                placeholder="Confirm Password" name="password_confirmation">
                                        </div>
                                    </div>
                                </div>
                                @error('password')
                                <p class="text-danger">{{ $errors->first('password') }}</p>
                                @enderror
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Pin (6 numeric digits)</label>
                                            <input class="form-control" type="password" id="pin" name="pin"
                                                placeholder="123456" maxlength="6">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Confirm pin (6 numeric digits)</label>
                                            <input class="form-control" type="password" id="pin_confirmation"
                                                name="pin_confirmation" maxlength="6" placeholder="123456">
                                        </div>

                                    </div>
                                </div>
                                @error('pin')
                                <p class="text-danger">{{ $errors->first('pin') }}</p>
                                @enderror


                                <div class="form-group">
                                    <label>Referral Code</label>
                                    <input type="text" id="reference_code" name="reference_code" class="form-control"
                                        value="{{ $reference_code }}" placeholder="Reference Code">
                                </div>

                                <div class="row">
                                    <div class="col-24 col-md-12 col-lg-12">
                                        @include('includes.forms.captcha')

                                    </div>
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-sm">Signup</button>
                                </div>
        </form>
        </div>
        </div>

        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="user-form-card">
                <h2 class="mb-3">Congratulations!</h2>
                <p>You have made the decision to register on <strong>Squid Market</strong>!</p>
                <p>Please enter your selected username and password to begin shopping on <strong>Squid
                        Market</strong> via our Secure <strong>Escrow System</strong>.</p>
                <p>We encourage you to record your unique login passphrase which will be generated. This unique
                    passphrase will help verify that you are on the authentic marketplace and not a phishing site.
                </p>
                <p>We highly recommend adding a <strong>PGP public key</strong> and enabling <strong>Two-Factor
                        Authentication</strong>(2FA) for added security on your account. </p>

                <p>URL:<img src="/../url.png"> </p> <a href="" class="link-danger"><small>if this does not match what's
                        in the address bar leave immediately.</small></a>
            </div>
        </div>


        </div>
        </div>
    </section>


    </section>
    @stop