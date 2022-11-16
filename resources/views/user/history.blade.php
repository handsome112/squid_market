<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')

<title>Pin Settings - Squid Market</title>
@include('includes.flash.success')
@include('includes.flash.error')
@include('includes.flash.validation')
<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/pin.png')
            ); ?> width="17px" style="margin-top:-3px"> Pin Settings</h5>
        </div>
    </div>
</section>
<form action="{{ route('put.changepin') }}" method="post">
    @csrf
    @method('PUT')
    <section class="section mt-3 mb-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 col-lg-8">
                    <div class="account-card">
                        <form class="user-form">
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">Current PIN:</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="password" id="current_pin" name="current_pin"
                                        maxlength="6" placeholder="6 Digits">
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">New PIN:</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="password" id="new_pin" name="new_pin"
                                        maxlength="6" placeholder="6 Digits">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">Confirm new PIN:</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="password" id="new_pin_confirmation"
                                        name="new_pin_confirmation" maxlength="6" placeholder="6 Digits">
                                </div>
                            </div>

                            <hr>
                            <div class="row mb-0">
                                <label class="col-sm-4 col-form-label"></label>
                                <div class="col-sm-12">
                                    @include('includes.forms.captcha')
                                </div>
                                <div class="col-sm-12 justify-content-center d-flex">
                                    <button class="btn btn-sm btn-primary">Change PIN</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>


    @stop