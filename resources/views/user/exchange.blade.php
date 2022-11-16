@extends('master.main')
@section('content')

<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5><img src="{{ asset('img/icons/wallet.png') }}" width="17px" style="margin-top:-3px"> Wallet</h5>
        </div>
    </div>
</section>

<section class="section mt-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-8">
                <div class="pc-tab">
                    <nav>
                        <ul>
                            <li class="tab2"><a href="{{ route('payment') }}">XMR</a></li>
                            <li class="tab3 active"><a href="">Exchange (Coming Soon!)</a></li>
                        </ul>
                    </nav>
                    <section>
                        <div class="tab3 d-block">
                            <form class="user-form">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>From</label>
                                            <select class="form-select">
                                                <option value="1" selected>BTC</option>
                                                <option value="2">XMR</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>To</label>
                                            <select class="form-select">
                                                <option value="1" selected>XMR</option>
                                                <option value="2">BTC</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Value</label>
                                    <input type="number" class="form-control">
                                    <small class="ps-0">Exchange Fee: 2%</small>
                                </div>
                                <div class="form-group">
                                    <a href="#" class="btn btn-sm btn-primary">Exchange</a>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
