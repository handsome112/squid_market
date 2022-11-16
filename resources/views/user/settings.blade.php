<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')
<title>Currency Settings - Squid Market</title>
@include('includes.flash.success')
@include('includes.flash.error')
@include('includes.flash.validation')
<section class="section mt-3 mb-0">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5 class="fw-bold"><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/money.png')
            ); ?> width="19px" style="margin-top:-3px">
                Currency Settings</h5>
        </div>
    </div>
</section>


<form action="{{ route('post.changecurrency') }}" method="post">
    @csrf
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="account-card shadow-lg">
                        <div class="icon-box text-center">
                            <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/money-black.png')
                            ); ?> style="margin-top:-3px;width:40px;height:40px">
                            <h4>Your Currency</h4>
                        </div>
                        <form class="user-form">
                            <div class="form-group">
                                <select class="form-select" id="currency" name="currency" aria-label="select">
                                    @foreach(config('currencies') as $currency)
                                    <option value="{{ $currency }}" @if($currency==auth()->user()->currency) selected
                                        @endif>{{ $currency }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm"><img src=<?php echo \App\Tools\Converter::convert_into_base64(
                                    public_path('img/icons/money.png')
                                ); ?> width="17px" style="margin-top:-3px"> Change
                                    Currency</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>

@stop