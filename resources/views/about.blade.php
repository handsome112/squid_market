<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')

<title>FAQ - Squid Market</title>

<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center mb-0">
            <h5> <img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/plus-circle.png')
            ); ?> width="17px" style="margin-top:-3px">
                FAQ</h5>
        </div>
    </div>
</section>

<section class="section mt-0">
    <div class="container">
        <div class="account-card">
            <div class="row">
                <div class="col-md-12 col-lg-6 mb-3">
                    <div class="icon-box text-center">
                        <img src=<?php echo Converter::convert_into_base64(
                            public_path('img/icons/user-plus-black.png')
                        ); ?> style="margin-top:-3px;width:40px;height:40px">
                        <h4>Customer Frequently Asked Questions</h4>
                    </div>
                    <div class="accordion">
                        <div class="option">
                            <input type="checkbox" id="toggle1" class="toggle" />
                            <label class="title" for="toggle1">What should I do first when I sign up?</label>
                            <div class="content">
                                <div>
                                    <p>When you first sign up, you should add a PGP key to your profile and enable 2FA.
                                        Doing this will increase the security of your account and allow vendors to
                                        communicate with you with encryption. To do this, go to the PGP Settings page
                                        under Settings and afterwards on the 2FA Settings page also under Settings.</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle2" class="toggle" />
                            <label class="title" for="toggle2"> How can I pay for my order?</label>
                            <div class="content">
                                <div>
                                    <p>We accept Monero (XMR). You can pay for your order with either
                                        cryptocurrency by sending the appropriate payment value to the given payment
                                        address.
                                        Your order will be registered as "paid" after 10 confirmations.</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle3" class="toggle" />
                            <label class="title" for="toggle3"> What if my order is canceled? How do I get
                                refunded?</label>
                            <div class="content">
                                <div>
                                    <p>Even though our market is walletless, meaning that you will directly pay for each
                                        order invoice rather than funding an on-site deposit wallet, refunds are
                                        automatically
                                        sent back to your unique internal market wallet. This means that if your order
                                        is canceled, the funds are sent back to your market wallet and you will need to
                                        withdraw them
                                        to your off-site wallet manually.</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle4" class="toggle" />
                            <label class="title" for="toggle4">Where do I give my delivery details?</label>
                            <div class="content">
                                <div>
                                    <p>After you have added your product to your basket, you will be prompted to enter
                                        your shipping info on the "cart" page. Once you add your delivery information
                                        (make sure to PGP encrypt!),
                                        you must "save changes" to ensure the vendor sees your details once the order is
                                        submitted.
                                        In the case of an item that does not require delivery details (like certain
                                        digital products), you can leave this area blank.</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle5" class="toggle" />
                            <label class="title" for="toggle5">I think I got scammed, what must I do?</label>
                            <div class="content">
                                <div>
                                    <p>Raise a ticket for Squid Market staff and be sure to explain all the pertintent
                                        information of the situation. Please allow 24-48 hours for a staff member to
                                        review your message and
                                        take action.</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle6" class="toggle" />
                            <label class="title" for="toggle6">What must I do if I get an error page?</label>
                            <div class="content">
                                <div>
                                    <p>If you get an error page, please open a ticket and inform our staff where you
                                        encountered the error page and exactly what it said.</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle7" class="toggle" />
                            <label class="title" for="toggle7">Is it safe to make deals outside of Squid Market?</label>
                            <div class="content">
                                <div>
                                    <p>No, it is not safe to make deals outside of the marketplace and if a vendor
                                        encourages you to do direct deals you should be very cautious and report him/her
                                        to staff. If you lose
                                        money on a deal performed outside of the marketplace, there is nothing we can do
                                        to help you.</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle8" class="toggle" />
                            <label class="title" for="toggle8">Is it safe to use Finalize Early listings?</label>
                            <div class="content">
                                <div>
                                    <p>We do our absolute best to ensure that only the most respected and trusthworthy
                                        vendors are able to have Finalize Early priviliges, however, it is important to
                                        understand that we cannot
                                        recover your money if a scam or dispute situation arises with an FE order. The
                                        absolute safest method for your transaction is with Escrow.</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle9" class="toggle" />
                            <label class="title" for="toggle9">How does Escrow work?</label>
                            <div class="content">
                                <div>
                                    <p>Escrow works by the marketplace providing you (the customer) a safe intermediary
                                        wallet to hold your funds until you receive your order. We keep your b
                                        XMR safe while the vendor
                                        processes and ships your order to ensure that you do not get scammed or lose
                                        money. Once you receive your order, you can log into the market and release your
                                        escrow so the vendor is paid.</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle10" class="toggle" />
                            <label class="title" for="toggle10">How does Finalize Early work?</label>
                            <div class="content">
                                <div>
                                    <p>Certain vendors with a longstanding history of professionalism and trustworthiness
                                        can receive Finalize Early, which allows them to engage in transactions without
                                        escrow. When you open an FE
                                        transaction, the vendor will receive your money as soon as they mark the order
                                        "shipped." There is no escrow and you do not have to release escrow once your
                                        order arrives as the vendor is paid immediately.</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle11" class="toggle" />
                            <label class="title" for="toggle11">How can I leave feedback?</label>
                            <div class="content">
                                <div>
                                    <p>Once you release escrow (or, in the case of FE, once the vendor marks your order
                                        as shipped and the funds get released) you will be given the option of leaving
                                        feedback for the transaction on the
                                        page of the completed order. Make sure to leave feedback soon after your order
                                        is completed, as there is a time limit on how long feedback can be left.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-12 col-lg-6 mb-3">
                    <div class="icon-box text-center">
                        <img src=<?php echo Converter::convert_into_base64(
                            public_path('img/icons/helpdesk-black.png')
                        ); ?> style="margin-top:-3px;width:40px;height:40px">
                        <h4>Vendor Frequently Asked Questions</h4>
                    </div>
                    <div class="accordion">
                        <div class="option">
                            <input type="checkbox" id="toggle21" class="toggle" />
                            <label class="title" for="toggle21">What should I do before I apply as a vendor?</label>
                            <div class="content">
                                <div>
                                    <p>Before applying as a vendor, you must add a PGP key and enable 2FA. To do this,
                                        go to the PGP Settings page under Settings
                                        and afterwards on the 2FA Settings page also under Settings.</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle22" class="toggle" />
                            <label class="title" for="toggle22">How do I become a vendor?</label>
                            <div class="content">
                                <div>
                                    <p>To become a vendor on Squid Market, you can select the "Become A Vendor" button
                                        on the main page. We have an extremely high standard for
                                        sellers on our platform and for the safety of our platform and customers we
                                        require a vendor bond payment of 300 USD. This bond payment is
                                        held as a security deposit in case a vendor attempts to scam customers/steal
                                        money.</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle23" class="toggle" />
                            <label class="title" for="toggle23">I am an established vendor with a great reputation, do I
                                need to pay bond?</label>
                            <div class="content">
                                <div>
                                    <p>If you are a highly established vendor with a history of trustworthiness and a
                                        verifiable sales history, you may be eligible to have your vendor
                                        bond waived. In this situation, you can open a ticket to apply for vendorship
                                        without a bond payment and your individual case will be reviewed
                                        and verified by our staff.</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle24" class="toggle" />
                            <label class="title" for="toggle24">I don't have the money to pay for the vendor bond, can I
                                still become a vendor?</label>
                            <div class="content">
                                <div>
                                    <p>No, not having enough money is not an excuse to avoid paying the vendor bond,
                                        especially if you have no verifiable sales history. We have a high
                                        standards for sellers on our platform and encourage you to begin on a different
                                        market and return when you have the funds/sales history. Do not
                                        open a ticket asking about this as it will be closed.</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle25" class="toggle" />
                            <label class="title" for="toggle25">Can you import my feedback from other markets?</label>
                            <div class="content">
                                <div>
                                    <p>Yes, we can fully integrate verifiable feedback from other markets onto your
                                        profile. That said, it is important to remember that many sites are either
                                        outdated or no longer updated and we cannot be responsible for outdated sales
                                        statistics.</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle26" class="toggle" />
                            <label class="title" for="toggle26">How do I set up my product listings?</label>
                            <div class="content">
                                <div>
                                    <p>All you do is, as a vendor, click on vendor dashboard, 
                                    it will take you to your vendor dashboard where you will see options to list 
                                    either digital or physical products.</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle27" class="toggle" />
                            <label class="title" for="toggle27">How do I set a shipping method?</label>
                            <div class="content">
                                <div>
                                    <p>You set your shipping method while product is in cart before checking out..</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle28" class="toggle" />
                            <label class="title" for="toggle28">How will I get paid for my orders?</label>
                            <div class="content">
                                <div>
                                    <p>Once the customer finalizes the order, the funds for the order will go into your
                                        unique market wallet. You are responsible for manually withdarwing those
                                        funds to your off-site wallet.</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle29" class="toggle" />
                            <label class="title" for="toggle29">How long is the escrow time on orders?</label>
                            <div class="content">
                                <div>
                                    <p>Physical products have an auto-finalization timer of 14 days. A customer can
                                        extend that timer if they have not received their product yet, and for digital
                                        products, it take 7 days to autofinalize, for Auto-ship products it takes 3 days
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle30" class="toggle" />
                            <label class="title" for="toggle30">I believe a customer may be scamming me, what can I
                                do?</label>
                            <div class="content">
                                <div>
                                    <p>If you believe a customer may be scamming you, you should raise a ticket with our
                                        staff and explain the situation with as much evidence as possible.</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle30" class="toggle" />
                            <label class="title" for="toggle30">A customer has disputed an order, what should I
                                do?</label>
                            <div class="content">
                                <div>
                                    <p>If a customer disputes an order, don't get upset. Provide as much evidence to the
                                        customer and the Squid Market Staff member regarding your point of view
                                        and make sure you are polite and willing to accept the resolution.</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle30" class="toggle" />
                            <label class="title" for="toggle30"> Is there anything else I should know about vending
                                here?</label>
                            <div class="content">
                                <div>
                                    <p>We require our vendors to be honest, trustworthy and professional. Vending on
                                        Squid Market is a privilege and our customers and staff expect the best.
                                        We expect you to uphold our high standards.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


@stop
