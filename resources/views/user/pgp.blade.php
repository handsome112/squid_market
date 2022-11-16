<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')

<title> PGP Settings - Squid Market</title>
@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<section class="section mt-3 mb-0">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5 class="fw-bold"><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/key-white-fill.png')
            ); ?> width="17px" style="margin-top:-3px">
                PGP
                Settings</h5>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="account-card shadow-lg">
                    <div class="icon-box text-center">
                        <h4>PGP Settings:</h4>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('pgpkey') }}" class="btn btn-primary btn-sm w-100">
                            <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/key-white.png')
                            ); ?> width="14px" style="margin-top:-3px;margin-right:3px">Current PGP Key
                        </a>
                    </div>
                    @if(!session()->has('verification_name') and session()->get('verification_name')
                    !=='confirm_new_pgp_key')
                    <form action="{{ route('post.changepgpkey') }}" method="post">
                        @csrf
                        <form class="user-form">
                            <div class="form-group">
                                <label>Assign PGP Key:</label>
                                <textarea class="form-control" style="height: 250px" id="pgp_key" name="pgp_key"
                                    cols="50" rows="12"></textarea>
                            </div>
                            @include('includes.forms.captcha')
                            <div class="form-group d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm"><img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                    public_path('img/icons/key-open.png')
                                ); ?> width="17px" style="margin-top:-3px"> Assign
                                    PGP Key</button>
                            </div>
                            @else
                            <form action="{{ route('put.changepgpkey') }}" method="post">
                                @csrf
                                @method('PUT')
                                <textarea class="form-control" style="height: 250px" id="pgp_key" name="pgp_key"
                                    cols="50" rows="12" readonly>{{ session()->get('encrypted_message') }}</textarea>
                                <div class="label mt-10">
                                    <label for="verification_code">Decrypted code</label>
                                </div>
                                <input class="form-control" type="text" id="verification_code" name="verification_code">
                                <br>
                                @include('includes.forms.captcha')
                                <div class="mt-10">
                                    <a class="btn btn-warning btn-sm"
                                        href="{{ route('cancelpgpkeychange') }}">Cancel</a>
                                    <button type="submit" class="btn btn-primary btn-sm"><img src=<?php echo Converter::convert_into_base64(
                                        public_path('img/icons/key_.png')
                                    ); ?> width="12px" style="margin-top:-3px">
                                        Assign Key</button>
                                </div>
                            </form>
                            @endif
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop