<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')

<title> Change Password - Squid Market</title>

@include('includes.flash.success')
@include('includes.flash.error')
@include('includes.flash.validation')
<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/gear.png')
            ); ?> width="17px" style="margin-top:-3px"> Password Settings
            </h5>
        </div>
    </div>
</section>

<section class="section mt-3 mb-3">
    <form action="{{ route('put.changepassword') }}" method="post">
        @csrf
        @method('PUT')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7">
                    <div class="account-card">
                        <div class="icon-box text-center">
                            <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/key.png')
                            ); ?> style="margin-top:-3px;width:40px;height:40px">
                            <h4>Change Password</h4>
                        </div>
                        <form class="user-form">
                            <div class="form-group">
                                <label>Old Password:</label>
                                <input class="form-control" type="password" id="current_password"
                                    name="current_password">
                            </div>
                            <div class="form-group">
                                <label>Enter New Password:</label>
                                <input class="form-control" type="password" id="new_password" name="new_password">
                            </div>
                            <div class="form-group">
                                <label>Confirm New Password:</label>
                                <input class="form-control" type="password" id="new_password_confirmation"
                                    name="new_password_confirmation">
                            </div>

                            <p class="invalid-feedback d-block"></p>
                            @include('includes.forms.captcha')
                            <div class="form-group d-flex justify-content-center">
                                <button class="btn btn-sm btn-primary">
                                    Change Password <img src=<?php echo Converter::convert_into_base64(
                                        public_path('img/icons/arrow-right.png')
                                    ); ?> width="15px" style="margin-top:-3px">
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

@stop