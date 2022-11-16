@extends('master.main')
@section('no-content')

<title>Twofactor - Squid Market</title>

<br>
<br>
@include('includes.flash.error')
<form action="{{ route('post.verifylogin') }}" method="post">
    @csrf
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="account-card shadow-lg">
                        <div class="icon-box text-center">
                            <h4>2FA</h4>
                        </div>

                        <form class="user-form">
                            <div class="form-group">
                                <label>Encrypted PGP Message:</label>
                                <textarea class="form-control" style="height: 250px"
                                    readonly>{{ session()->get('encrypted_message') }}</textarea>
                            </div>
                            <input class="form-control" type="text" id="verification_code" name="verification_code"
                                placeholder="Decrypted code">
                            <br>
                            <div class="form-group d-flex justify-content-center">
                                <a class="btn btn-warning btn-sm" href="{{ route('logout') }}"><button
                                        type="button">Logout</button></a>
                                <button type="submit" class="btn btn-primary btn-sm"> Continue</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>

@stop