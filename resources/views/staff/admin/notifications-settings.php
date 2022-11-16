<?php include 'header.php'; ?>
<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center mb-0">
            <h5><i class="bi-megaphone"></i> Notifications Settings</h5>
        </div>
    </div>
</section>

<?php include 'header-alert.php'; ?>

<section class="section mt-0">
    <div class="container">

        <div class="account-card">
            <h5 class="account-title">Jabber Notification</h5>

            <div class="alert alert-info" role="alert">
                Enter your Jabber ID to receive copy of notifications on your Jabber client.
            </div>
            <div class="alert alert-warning" role="alert">
                Don't use servers with heavy restrictions.
            </div>

            <form class="user-form">
                <div class="form-group">
                    <label>Jabber ID</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group mb-0">
                    <input type="submit" value="Update" class="btn btn-sm btn-primary">
                </div>
            </form>
        </div>

        <div class="account-card">
            <h5 class="account-title">Choose Notification to Receive</h5>

            <div class="alert alert-info" role="alert">
                Uncheck the notification you don't want to receive.
            </div>

            <form class="user-form">

                <p><strong>Applications</strong></p>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="c1" checked>
                            <label class="form-check-label" for="c1">Application Accepted</label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="c2" checked>
                            <label class="form-check-label" for="c2">Application Rejected</label>
                        </div>
                    </div>
                </div>

                <hr>
                <p><strong>Balance</strong></p>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input" type="checkbox" id="c3" checked>
                            <label class="form-check-label" for="c3">Balance Decreased</label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input" type="checkbox" id="c4" checked>
                            <label class="form-check-label" for="c4">Balance Increased</label>
                        </div>
                    </div>
                </div>

                <hr>
                <p><strong>Conversations</strong></p>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input" type="checkbox" id="c5" checked>
                            <label class="form-check-label" for="c5">Conversation Closed</label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input" type="checkbox" id="c6" checked>
                            <label class="form-check-label" for="c6">Conversation Received</label>
                        </div>
                    </div>
                </div>

                <hr>
                <p><strong>Disputes</strong></p>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input" type="checkbox" id="c7" checked>
                            <label class="form-check-label" for="c7">Disputes Closed</label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input" type="checkbox" id="c8" checked>
                            <label class="form-check-label" for="c8">Disputes Received</label>
                        </div>
                    </div>
                </div>

                <hr>
                <p><strong>Message</strong></p>
                <div class="form-check form-switch form-check-inline">
                    <input class="form-check-input" type="checkbox" id="c9" checked>
                    <label class="form-check-label" for="c9">Message Received</label>
                </div>

                <hr>
                <p><strong>Onions</strong></p>
                <div class="form-check form-switch form-check-inline">
                    <input class="form-check-input" type="checkbox" id="c10" checked>
                    <label class="form-check-label" for="c10">Onions Changed</label>
                </div>

                <hr>
                <p><strong>Orders</strong></p>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input" type="checkbox" id="c11" checked>
                            <label class="form-check-label" for="c11">Order Canceled</label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input" type="checkbox" id="c12" checked>
                            <label class="form-check-label" for="c12">Order Disputed</label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input" type="checkbox" id="c13" checked>
                            <label class="form-check-label" for="c13">Order Finalized</label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input" type="checkbox" id="c14" checked>
                            <label class="form-check-label" for="c14">Order Received</label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input" type="checkbox" id="c15" checked>
                            <label class="form-check-label" for="c15">Order Refunded</label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input" type="checkbox" id="c16" checked>
                            <label class="form-check-label" for="c16">Order Shipped</label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input" type="checkbox" id="c17" checked>
                            <label class="form-check-label" for="c17">Order Split</label>
                        </div>
                    </div>
                </div>

                <hr>
                <p><strong>Tickets</strong></p>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input" type="checkbox" id="c18" checked>
                            <label class="form-check-label" for="c18">Ticket Closed</label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input" type="checkbox" id="c19" checked>
                            <label class="form-check-label" for="c19">Ticket Received</label>
                        </div>
                    </div>
                </div>

                <hr>
                <input type="submit" value="Update" class="btn btn-primary btn-sm">



            </form>
        </div>

    </div>
</section>

<?php include 'footer.php'; ?>