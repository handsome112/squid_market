@extends('master.main')
@section('content')
<title>Referrals - Squid Market</title>

<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5><img src="{{ asset('img/icons/user-plus.png') }}" width="17px" style="margin-top:-3px"> Referrals</h5>
        </div>
    </div>
</section>

<section class="section mt-0">
    <div class="container">
        <div class="account-card">
            <h4 class="account-title">Referral</h4>
            <p>Earn money with us through our referral program!</p>
            <p>Refer users and earn up to 25% of the profit we make from their spendings on this website.</p>
            <p>Find your referral link below:</p>
            <p>Your Referral Link</p>
            <div class="qr-text qr-text-lg">
                {{ route('register', ['reference' => auth()->user()->reference_code]) }}
            </div>
            <hr>

            <div class="row">
                <div class="col-md-3 col-lg-3">
                    <div class="wallet-card-group mb-3">
                        <div class="wallet-card">
                            <img src="{{ asset('img/icons/user-plus.png') }}" width="80px" style="margin-top:-3px">
                            <p>Reffered Users</p>
                            <h3>0</h3>
                        </div>
                    </div>
                    <div class="wallet-card-group mb-3">
                        <div class="wallet-card">
                            <img src="{{ asset('img/icons/cash.png') }}" width="80px" style="margin-top:-3px">
                            <p>Refferal Earning</p>
                            <h3>$0</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-lg-9">
                    <p><strong>Users Reffered by you</strong></p>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <th>Name</th>
                                <th>Referred at</th>
                                <th>Earnings</th>
                            </thead>
                            <tbody>
                                <td colspan="3">No referred user</td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
