@extends('master.main')
@section('no-content')

<title>Reset Password - Squid Market </title>

@include('includes.flash.error')

<body class="bg-dark">
    <div class="backdrop"></div>
    <section class="user-form-part">

        <div class="user-form-logo"><img style="width:400px;" src="{{asset('logo.png')}}" alt="logo"></div>

        <div class="container">
            <ul class="nav nav-tabs">
                <li><a href="{{route('login')}}" class="tab-link">Login</a></li>
                <li><a href="{{route('register')}}" class="tab-link">Sign up</a></li>
                <li><a href="#" class="tab-link">Check Mirror</a></li>
            </ul>
        </div>

        <section class="section mt-3">
            <div class="container">
                <div class="page-title justify-content-center">
                    <h5 class="fw-bold"><img src="{{ asset('img/icons/key-white.png') }}" width="24px"
                            style="margin-top:-3px"> Password Recovery</h5>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-5">
                        <div class="account-card shadow-lg">
                            <div class="icon-box text-center">
                                <img src="{{ asset('img/icons/key.png') }}" width="17px" style="margin-top:-3px">
                                <h4>Password Recovery</h4>
                            </div>

                            <div class="alert alert-warning text-center" role="alert">
                                When you reset your password, you wont be able to read your previous encrypted
                                messages.
                            </div>
                            <p class="text-center text-dark"><strong>Choose recovery method:</strong></p>

                            <div class="form-group d-flex justify-content-center">
                                <a href="{{ route('resetwithpgp') }}" class="btn btn-primary btn-sm w-100"><img
                                        src="{{ asset('img/icons/user-x.png') }}" width="13px" style="margin-top:-3px">
                                    Recovery
                                    with PGP</a>
                            </div>
                            <div class="form-group d-flex justify-content-center">
                                <a href="{{ route('resetwithmnemonic') }}" class="btn btn-primary btn-sm w-100"><img
                                        src="{{ asset('img/icons/user-x.png') }}" width="13px" style="margin-top:-3px">
                                    Recovery with MnemonicHTML</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</body>
@stop