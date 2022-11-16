<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')
<title>Market PGP - Squid Market</title>
<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center mb-0">
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/helpdesk.png')
            ); ?> width="17px" style="margin-top:-3px"> Admin PGP</h5>
        </div>
    </div>
</section>

<section class="section mt-0">
    <div class="container">

        <div class="account-card">
            <div class="account-title">
                <h4>Admin PGP & Market PGP keys</h4>
            </div>

            <div class="row">

                <div class="col-sm-18 col-md-18 col-lg-6 mb-3">
                    <p class="fw-bold">Market PGP Key:</p>
                    <textarea class="form-control" style="height: 570px;" readonly>

-----BEGIN PGP PUBLIC KEY BLOCK-----

mQENBGNe1eYBCAC6o8ksLyeIRSj1YEd+OXYaBo1siGSIUthweUbIFMWp427Bi38c
P7pWjIhmSsMJOYrKVnAkT2ppJYN7SGyW/F71JV7Ws5VO57xxto3bl26AuBzX+n9C
gyl35HNO0wwUmIzZGMpUOa2Htl1YqHcCJnaZUPU7kFN3MkIsWifnYA9ekZirDnuW
OGhWncyvvcqOFjDkf1jKF9aXYKJHCXnUwvymQyHpFaoCO7hw1HiXhqd+Za7zaoOr
iAXpqBTtGO/CRQ6Jc7mEZwDfnxvUH6BC9N42U4yMqFGmtWZUwPU9Od11L8z8Xpyd
MZj60TMSJf+aDI+IfU48SsLigRlymbaJf2ybABEBAAG0IlNxdWlkTWFya2V0IDxT
cXVpZE1hcmtldEBzbm93Lm5ldD6JAU4EEwEKADgWIQTpM+d6ut54Z/vjACMIoUyL
JipemgUCY17V5gIbAwULCQgHAwUVCgkICwUWAgMBAAIeAQIXgAAKCRAIoUyLJipe
mq8NB/9BMt67lUXUsoJOTQWPVhBLEL3NUZ6Qz4zlaN+BHsKoJEg7dCvb8vUkNNPo
CVmAVm9d9TwLZJ6FJBFQlNSLK2yyJRAx2tofmuIknjKWnkrHBwqNDjkCXJHC1th3
Pvu89Eg8bCoWZOmzmFkXpPy713OqtxgaN53SxnrW8ipMjNcQ9b/UShIvuqlL/c2M
U6p7ZGFmvUGFI9atwJvDOfGSLUfsIDuCt1xuBCzj7T36hlA4zswES+tSR3bK73kD
GqFJjy9sSUGCq1ylmQ6iMQkg/q7P4yK9Ajcz4KH7t/EYOG1i46sBZGpDjY6As4oD
RiQ9qqy6XpdKzgvWodNvWMddjfRXuQENBGNe1eYBCACg+bQ/ozMlx2VN0ZnNqMHy
LbgXKaeIVEmtXKLc0G2UzXIAe0Qh8Wlw4qLfAnEThBwnmpIrMJp1Dj1smZIM4AP7
HKAp0i5i7B/puouhmi7ozuw6uiwagddu+WGnXqZ1gWjlQ6Rnyj6oj4zNmNYcpwRw
MHXjxbFIpGj8X/TV6vk1D5yxgOVoiydnhNaKkgma9jxkWmXHRTOEv+wOv2vajpyt
xuEk2WHvLQlDEw39jINQwvFFPxdZ3Ub+s/CeWyc0feeovDfJ50wUlfMBtUrxwBZ1
zNxJ+dEgBRBIu3NeHAuQpXcuEKe6E8OpAyfAvxYM16nbTQN97Tj6u4uRP3asOEHf
ABEBAAGJATYEGAEKACAWIQTpM+d6ut54Z/vjACMIoUyLJipemgUCY17V5gIbDAAK
CRAIoUyLJipemuFMB/9aEOQrQbFDhnifPqqgTRD+7YOHUjblWDx1fum0Wk+MNfnH
ITLK6VAo988VZ8/7U5WlQtI96TULl8GeYFntGgXdLzTGGy2o7I0afJekVKCkbqXJ
JyT4XDYOWJExgFIr27awWfypFFSWedx/5NzpU/dD0e33JUolOVkwAE2oFA1j9qRp
S6yAzTPTg2BP87N6HFuf33tmYmkGZrmGL/ACJ3MAvDuBjzqZ0ihOkpjKrjuluXLT
kpXAzUbgrBBFKhW82t+dOfMG8RxSoV6oxT3PoJlmOT+y5Nhr8iXNZ5UDcF98cgNv
cQnISBg54P0xq+APrwkDiJ/7e7WSTQhEH6+W34YC
=Cenu
-----END PGP PUBLIC KEY BLOCK-----</textarea>
                </div>
                <div class="col-sm-18 col-md-18 col-lg-6 mb-3">
                    <p class="fw-bold">TeamSnow PGP Key:</p>
                    <textarea class="form-control" style="height: 570px;" readonly>

-----BEGIN PGP PUBLIC KEY BLOCK-----

mQENBGNe1TABCAC7vExIshQL5MZns6eIFy7v5unoLZQep1c9hgmiF21ZRIpz+Vw9
IckyoJ3ZO7UpbXieB7PM0V+yBTGupBLyqQ7HPrlkEa4C/vdOFEuOPFiKnstZzgIW
hYoNqHP55y/s4RXH2VhtJtjLDqXyAJHKG2gt7vJMNpDc+vE2wLIfRDG5lULb19d/
DsXdo8OQvLMiTTgenVukGCr38ZX1Bnj5wncdXg9f761c1ya/0eUd7eQ5hF7zQ/ZN
suMtUCKipv+xmQtvxR/ZkUXd/4ZPzQCBdAvHDWvOFaww2Z0o6mqGw2lHFq+cg6w9
ww/Wpy69TW1RFfIqy64mH2MRS/udOcYCrIRDABEBAAG0HVRlYW1Tbm93IDx0ZWFt
c25vd0BmbG9ndS5uZXQ+iQFOBBMBCgA4FiEES3LL+Bv64R0IzHvdz/au7zjgqGAF
AmNe1TACGwMFCwkIBwMFFQoJCAsFFgIDAQACHgECF4AACgkQz/au7zjgqGCziggA
t8wDG4p0oAmvGsVBUtNWcmUzF+L0lmN2wM8lGWyGvkTRnZywVWknYD+9m/9zbru8
SQADO97n3SQyhEWuqaqOtCjTGv1Bh54pg1TAEY9L4qJvXMnEqezAMUa0EiOkGCxz
5xVte0FgbFjUJkUwehdhE0xCSdsRmW5dFAEUfKVakbkv/TbrScYIf5e5DkzRjzcr
SKReCLNQzF+aLsy/QdsZJ9yXAfN/kWFhUEQdiSnFQXdOGYvrTlw2LQP9H5x9Ekrp
9zXQvDFJ1lRs+r2vLm35YryaWlXsKTfpThwShjELshUXc8lSKNUOXnwMP4UtrtIP
v+5SQkLVhHqQOI/eY9ghXbkBDQRjXtUwAQgAu1NYNYzyRbkCwcWbCLADSVU/tjWb
RUBFN1xb5i2p5aBIBrn2uhw0rZp0v9K6w+aL+bxsaj9jYcsSPfYbLyCvNdATGuF6
OdjCyGvzQhm/MUMDFSfqf9spNcErvr3PhPob2vvdTZG/7i088sbq5kc/jVdhyN54
2+TmzHDNMuRgNFJJHHLuYAwSyswhvvH7nRu4AVRYqM2lzZjDaEZ+xEcu8dSW9+3h
DPNAG210i+HTMYkiA6KYOpscNUIi5mIMUvVhGHNXg23h40FQ3eT5uDkkIItdR7Du
qDgUhOTzn9MNx74jYLkmQa49TEyQWaBj8rCfuGrit6yX6GMU8koi+xOOvQARAQAB
iQE2BBgBCgAgFiEES3LL+Bv64R0IzHvdz/au7zjgqGAFAmNe1TACGwwACgkQz/au
7zjgqGCbKgf/aPQFDdZWzAlyaY+mraAVdddwToOwwGF9ro4/Y20supkTv+hHaWuG
xeB4n8zzdeyPQg/aCG+Gx02L+7J20yAwSkr2+LWni39lkENIua3mwLvRX8BxWhSl
6j9XDsir5gMNERTbKhSMMbB0mTh6lMpFjRx1Cav16l29dcJ61ZbphgrX3oQj2VPQ
lVeZxeSN/8J315yQBBDpF5Wrjldlo35M624FYlHslvrn+LzTvt+eTmk7J/WkDxoa
jK4hDaDPLtXf/8seJkAaUGaQ/nQN4uxahO6iyGkK4t/dFitC6+OkXeGU1z+hbW/v
YfIVpnqNz/IB0xj/tUKCtI61laopESEswg==
=hVL4
-----END PGP PUBLIC KEY BLOCK-----</textarea>
                </div>


            </div>
        </div>
    </div>
</section>


@stop
