<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')
<title> PGP Key - Squid Market</title>

@include('includes.flash.success')
@include('includes.flash.error')
@include('includes.flash.validation')
<section class="section mt-3 mb-0">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5 class="fw-bold"><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/key-white-fill.png')
            ); ?> width="17px" style="margin-top:-3px"> PGP Keys</h5>
        </div>
    </div>
</section>


<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="account-card shadow-lg">
                    <div class="icon-box text-center">
                        <h4>Current PGP Key:</h4>
                    </div>

                    <form class="user-form">
                        <div class="form-group">
                            <label>Current PGP Key:</label>
                            <textarea class="form-control" style="height: 250px" id="pgp_key" name="pgp_key" cols="50"
                                rows="12"
                                readonly>@if(!is_null($key)){{ $key }}@else You don't have a PGP key yet! @endif</textarea>
                        </div>
                        <a class="btn btn-warning btn-sm" href="{{ route('pgp') }}">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop