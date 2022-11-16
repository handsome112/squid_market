<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')
<title>Mirrors - Squid Market</title>
<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center mb-0">
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/list.png')
            ); ?> width="17px" style="margin-top:-3px"> Mirrors</h5>
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
                            public_path('img/icons/list-black.png')
                        ); ?> style="margin-top:-3px;width:40px;height:40px">
                        <h4>Current Squid Mirrors:</h4>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <p class="fw-bold text-center">Squid Market PGP Key:</p>
                            <textarea class="form-control text-center" style="height: 370px;">

-----BEGIN PGP SIGNED MESSAGE-----
Hash: SHA512

http://mvuwtdbwkaoo53q67nrpqghd4jdqzppmmdeppbdsstefxuyaxplof5id.onion
-----BEGIN PGP SIGNATURE-----

iQGTBAEBCgB9FiEE6TPnerreeGf74wAjCKFMiyYqXpoFAmNr4G5fFIAAAAAALgAo
aXNzdWVyLWZwckBub3RhdGlvbnMub3BlbnBncC5maWZ0aGhvcnNlbWFuLm5ldEU5
MzNFNzdBQkFERTc4NjdGQkUzMDAyMzA4QTE0QzhCMjYyQTVFOUEACgkQCKFMiyYq
XprgWQgAgFhjS6/a7JswTTr6bMS7XjWCQyQuWXsIr7JHpzoc6Ib5O1DienVqE15Z
BLBEcuUfnhOYAKPW79Pdu7Y2uhj1fUvKW/5yHo9mZdjYNSZ23owfTLDzuhr1/RG1
MSrrwh9VSucpX3bL3Rvwbh6b7bEVbiQB2jVcv3nYh+7niUgiCzE6kf0LoSu+k+Uv
mYwbVh+cSVHQD8UqtBr+ehvrVk7GXYUnhTpHrNIqMOiUz6LbC7w6DiwW0Hz8j4NA
jAFIjZKqS7II4TPYmtxkfNLrb9fZkrS6khThm6s8eUh1rzefRwdvcfeWyOMNON6+
xqw5DK5Q7QcVwGWTXBYRfcN9lm+suA==
=uRA6
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
