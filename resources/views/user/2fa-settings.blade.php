<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')
<title>2FA-Settings - Squid Market</title>

@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<section class="section mt-3 mb-0">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5 class="fw-bold"><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/key_.png')
            ); ?> width="15px" style="margin-top:-3px"> 2FA
                Settings</h5>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-7">
                <div class="account-card shadow-lg">
                    <div class="icon-box text-center">
                        <img src=<?php echo Converter::convert_into_base64(
                            public_path('img/icons/key-black.png')
                        ); ?> style="margin-top:-3px;width:40px;height:40px">
                        <h4>2FA Settings</h4>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" style="height: 250px"
                            placeholder="To be able to use all functions on Squid, You must have 2FA enabled on your account. But before being able to enable 2FA, you must add a PGP Key first. Once you have added your PGP Key and activated 2FA on your account, you will be able to use all functions on Squid. The above ensures that you make use of the Squid environment in total security and safety"
                            readonly></textarea>
                    </div>
                    <div class="form-group text-center">
                        <p><strong>Enable or Disable 2FA</strong></p>
                        <div class="cd-switch">
                            <div class="switch">
                                <label id="label_yes" for="submit_yes" <?php if (
                                    auth()->user()->two_factor == 1
                                ) {
                                    echo 'style=color:white;background:var(--green);';
                                } ?>>
                                    <input type=" radio" name="choice" id="yes" value="enable" style="display:none">
                                    Enable</label>
                                <label id="label_no" for="submit_no" <?php if (
                                    auth()->user()->two_factor == 0
                                ) {
                                    echo 'style=color:white;background:var(--red);';
                                } ?>>
                                    <input type="radio" name="choice" id="no" value="disable" style="display:none">
                                    Disable</label>
                                <span class="switchFilter"></span>
                                <form method="post" action="{{ route('post.enable2FA') }}">
                                    @csrf
                                    <input type="submit" id="submit_yes" style="display:none" />
                                </form>
                                <form method="post" action="{{ route('post.disable2FA') }}">
                                    @csrf
                                    <input type="submit" id="submit_no" style="display:none" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop