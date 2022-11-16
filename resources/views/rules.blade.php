<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')
<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center mb-0">
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/list.png')
            ); ?> width="17px" style="margin-top:-3px"> Rules</h5>
        </div>
    </div>
</section>

<section class="section mt-0">
    <div class="container">
        <div class="rules-card">
            <span class="rules">
                <strong>At Squid Market,</strong> we have a variety of rules which are required to uphold the high
                standards of our
                marketplace.<br>
                Some rules are for buyers, some are for vendors and other rules are for everyone.<br>
                It is important to follow these rules to ensure the highest quality shopping/vending experience.<br>

                &nbsp;&nbsp;1. Vendors are stricty prohibited from selling: child/animal pornography, weapons,
                fentanyl.<br>
                &nbsp;&nbsp;2. Vendors are strictly prohibited from asking for early finalization from customers unless
                they have
                been granted FE by the marketplace<br>
                &nbsp;&nbsp;3. Customers must PGP encrypt shipping addresses provided to vendors<br>
                &nbsp;&nbsp;4. Customers must finalize their orders as quickly as possible upon receipt and verification
                of
                contents<br>
                &nbsp;&nbsp;5. All users are expected to interact maturely and professionally regardless of any dispute
                or
                disagreements<br>
                &nbsp;&nbsp;6. All users must listen to and adhere to any rulings or directives by Squid Market
                Staff<br>
                &nbsp;&nbsp;7. Any exchange or posting of direct contact information is strictly prohibited - this
                includes
                Telegram, Whatsapp, Wickr and more<br>
                &nbsp;&nbsp;8. Any rulings by Squid Market staff during an order dispute are considered final and cannot
                be
                argued<br>

                Using Squid Market is a privilege, and we expect our users to uphold the same high standards that we
                follow!
            </span>
        </div>
    </div>
</section>

@stop