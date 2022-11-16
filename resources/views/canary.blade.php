<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')
<title>Canary - Squid Market</title>
<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center mb-0">
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/helpdesk.png')
            ); ?> width="17px" style="margin-top:-3px"> Canary</h5>
        </div>
    </div>
</section>


<section class="section mt-0 mb-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-10 mb-3">

                <div class="account-card">
                    <div class="icon-box text-center">
                        <img src=<?php echo Converter::convert_into_base64(
                            public_path('img/canary.png')
                        ); ?> style="width: 60px; height: 60px" />
                        <h4>Squid Canary:</h4>
                    </div>

                    <div class=" row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <p class="fw-bold text-center">Squid Market PGP Key:</p>
                            <textarea class="form-control text-center" style="height: 570px;">

 -----BEGIN PGP SIGNED MESSAGE-----
Hash: SHA512

A canary is to help notify users of potential compromise. Teamsnow will provide a new signed canary every 30 days. Squid Market has just launched, as of launch no backdoors or compromise of our servers has been detected. Teamsnow has full control of it's servers as of 2022 the 10th of November.
-----BEGIN PGP SIGNATURE-----

iQGTBAEBCgB9FiEE6TPnerreeGf74wAjCKFMiyYqXpoFAmNr4wBfFIAAAAAALgAo
aXNzdWVyLWZwckBub3RhdGlvbnMub3BlbnBncC5maWZ0aGhvcnNlbWFuLm5ldEU5
MzNFNzdBQkFERTc4NjdGQkUzMDAyMzA4QTE0QzhCMjYyQTVFOUEACgkQCKFMiyYq
XppAyggAky+3cB+krR7hfIXRbBxWceFyVpyAfd/UfGtxJXmcjYtbGKjMw3v6CWPA
CMih4JK59206GM9qswUUjoWDcrPCYbE9/2zUiaLJ0Uq1IxQWLp6Um+Hp0F8NXQQA
DQdgRc2HLEDD7olNsVlicMPvw2I6plOSw7gdrcQVqn7uJn42u89ICR5kbpSQDZpf
e8TSvexGcPrUlV4F8A6tYQ03S4BBkXEUDmsRqXAsVkU6CVtDbrT6t3jEzbK1KLm3
ibP3jji5qmyi4TYHYa4hNtxM/5y7hwloPHglrCJn9De38Do4QzHaCUWdq6ZBXGpk
nW3BEe1SFfN8pzvlBMry1AK4SkFeWg==
=+oo7
-----END PGP SIGNATURE-----
</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
