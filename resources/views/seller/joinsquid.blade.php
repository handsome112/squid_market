<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')
<title>Join Squid - Squid Market</title>
@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <div class="account-card shadow-lg">
                    <form action="{{ route('post.becomeseller') }}" method="post">
                        @csrf
                        <div class="icon-box text-center">
                            <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/key.png')
                            ); ?> style="margin-top:-3px;width:40px;height:40px">
                            <h4>Join as Squid Vendor</h4>
                        </div>
                        <div class="account-content text-center">
                            <textarea id="joinQuest" class="form-control" rows="10" cols="100" style="height: 250px;"
                                readonly>
To become a vendor on Squid Market, you can select the "Become A Vendor" button on the main page. 

We have an extremely high standard for sellers on our platform and for the safety of our platform and customers we require a vendor bond payment of 300 USD. 

This bond payment is held as a security deposit in case a vendor attempts to scam customers/steal money. 
							</textarea>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th>Currency</th>
                                        <th>Payment Address</th>
                                        <th>Fee</th>
                                        <th>Received</th>
                                        <th>paid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-evenly">
                                                <img src=<?php echo Converter::convert_into_base64(
                                                    public_path('img/XMR2.png')
                                                ); ?> width="30" height="30" alt="xmr" style="margin-right: 3px">
                                                <div style="margin-top: 3px">XMR</div>
                                            </div>
                                        </td>
                                        <td class="d-flex flex-column justify-content-center align-items-center">
                                            <div class="qr-text" style="width:300px">
                                                {{ auth()->user()->become_monero_wallet }}</div>
                                            <img src=<?php echo \App\Tools\Converter::generateQRCode(
                                                auth()->user()
                                                    ->become_monero_wallet
                                            ); ?> width="100" height="100" />
                                        </td>
                                        <td>{{ $sellerFee }}</td>
                                        <td>{{ $totalReceived }}</td>
                                        <td>
                                            <span
                                                class="flashdata flashdata-warning">{{ $user->paidSellerFee() ? 'Yes' : 'No' }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @if(is_null($user->pgp_key) or auth()->user()->two_factor == 0)
                        <div class="form-group d-flex justify-content-center mt-3">
                            <a href="{{ route('pgp') }}" class="btn btn-primary btn-sm"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/dispute.png')
                            ); ?> width="15px" style="margin-top:-3px">
                                To become a Vendor first add your PGP Key and activate 2FA </a>
                        </div>
                        @else
                        <div class="form-group d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-primary btn-sm"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/check.png')
                            ); ?> width="15px" style="margin-top:-3px">
                                Upgrade Account to Vendor </button>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@stop