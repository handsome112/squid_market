@extends('master.main')
@section('content')

<title>Mnemonic - Squid Market </title>
<section class="section">
    <div class="container">
        <div class="alert alert-danger text-center text-uppercase">
            <h4 class="text-danger fw-bold">Your MNEMONIC & Automatically generated personal phrase</h4>
        </div>

        <div class="account-card" style="margin-bottom:10px">
            <div class="account-content text-center">
                <p><strong>Please take note of the information listed below as they are extremely important for your
                        account:</strong></p>
                <ol>
                    <li><strong class="text-danger">MNEMONIC</strong> is required to reset your account if you lose
                        your
                        <strong>PASSWORD</strong> or <strong>PIN</strong>. Without the mnemonic, there is no way to
                        reset your account and no way staff can help you.
                    </li>
                    <li><strong class="text-danger">Squid GENERATED PASSPHRASE:</strong> This is automatically generated
                        by the market. It is a unique pass phrase which helps authenticate your account upon login.</li>
                </ol>
            </div>
        </div>

        <div class="account-card">
            <div class="account-content">
                <div class="row">
                    <div class="col-md-9 col-lg-6 alert fade show mb-3">
                        <div class="profile-card address h-100 mb-0">
                            <h6 class="text-danger">MNEMONIC</h6>
                            <p class="fw-bold" style="overflow-wrap: break-word">{{ auth()->user()->mnemonic }}</p>
                        </div>
                    </div>
                    <div class="col-md-9 col-lg-6 alert fade show mb-3">
                        <div class="profile-card address h-100 mb-0">
                            <h6 class="text-danger">Squid GENERATED PHRASE</h6>
                            <p class="fw-bold">{{ auth()->user()->phrase }}</p>
                        </div>
                    </div>
                </div>

                <p class="fw-bold h5 text-uppercase text-danger text-center">Please copy the information Above and store
                    it somewhere safe as this is your only opportunity to see this data. If you loose the info, it is
                    lost forever. </p>
                <p class="text-center">Remember that the login page will never ask for your mnemonic or your PIN. Be
                    careful, If you lose your PIN of 2FA private key and you cannot remember your mnemonic, your account
                    cannot be reset and this will result in loss of all your coins!</p>

                <div class="text-center"><a href="{{ route('mnemoniccopied') }}" class="btn btn-primary">Yes! I have
                        copied |
                        LETS
                        CONTINUE</a>
                </div>
            </div>
        </div>
    </div>
</section>

@stop