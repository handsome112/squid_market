<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')
<title>Conversations - Squid Market</title>

@include('includes.flash.success')
@include('includes.flash.error')
@include('includes.flash.validation')
<section class="section mt-3">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/messenger.png')
            ); ?> width="17px" style="margin-top:-3px"> Message Inbox
            </h5>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="account-card shadow-lg">
                    <div class="icon-box text-center">
                        <img src=<?php echo Converter::convert_into_base64(
                            public_path('img/icons/messenger-black.png')
                        ); ?> style="margin-top:-3px;width:80px;height:60px">
                    </div>
                    <p><strong>Message Inbox Login</strong></p>
                    <p>Your message inbox is automatically encrypted by Squid Market. </p>
                    <p>To access your messages, please enter your password. </p>
                    <p>Remember - never trust any vendors or users who message you to send payments either directly or
                        via finalizing early. </p>
                    <form action="{{ route('openconversationmessages') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Enter Password:</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        @include('includes.forms.captcha')
                        <div class="form-group d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-sm"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/key_.png')
                            ); ?> width="17px" style="margin-top:-3px">
                                Open Message Inbox
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@stop