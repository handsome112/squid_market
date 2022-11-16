<div class="backdrop"></div>
<section class="header-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-6 d-flex align-items-center">
                <ul class="header-top-list">
                    <li>XMR 1.00 = $0</li>
                </ul>
                <div class="header-top-select ps-3">
                    <div class="header-select">
                        <i class="bi-globe"></i>
                        <select class="select">
                            @foreach(config('currencies') as $currency)
                            <option value="{{ $currency }}" @if($currency==auth()->user()->currency) selected
                                @endif>{{ $currency }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <ul class="header-top-list justify-content-end">
                    @staff
                    <li><a href="{{ route('staff.products') }}" class="btn btn-sm btn-success">Moderator panel</a></li>
                    @endstaff
                    <li><a href="" class="btn btn-sm btn-warning fw-bold">Exchange</a></li>
                    <li><span class="text-danger fw-bold">My Funds:</span> XMR = {{ auth()->user()->balance() }}</li>
                    <li>BTC 0.00 = $0.0</li>
                    <li class="flex-shrink-0 dropdown pe-3">
                        <a href="#" class="text-white dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown"
                            aria-expanded="false">My Support</a>
                        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="">FAQ</a></li>
                            <li><a class="dropdown-item" href="">Market PGP</a></li>
                            <li><a class="dropdown-item" href="">Mirrors</a></li>
                            <li><a class="dropdown-item" href="">Canary</a></li>
                            <li><a class="dropdown-item" href="{{ route('support') }}">Helpdesk</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="header-part sticky-top">
    <div class="container">
        <div class="header-content">
            <div class="header-widget-group">
                <a href="{{ route('openconversationmessages') }}" class="header-widget">
                    <i style="font-size: 25px;" class="bi-chat"></i>
                </a>

                <a href="{{ route('notifications') }}" class="header-widget">
                    <i style="font-size: 25px;" class="bi-bell"></i><sup class="text-white bg-danger"
                        style="width: 17px; height: 18px;">{{ auth()->user()->totalUnreadNotifications() }}</sup>
                </a>

                <a href="" class="header-widget">
                    <i style="font-size: 25px;" class="bi-bag"></i><sup class="text-white bg-danger"
                        style="width: 17px; height: 18px;">{{ auth()->user()->totalUnreadMessages() }}</sup>
                </a>

                <a href="{{ route('cart') }}" class="header-widget">
                    <i style="font-size: 25px;" class="bi-cart"></i><sup class="text-white bg-danger"
                        style="width: 17px; height: 18px;">{{ session()->has('cart') ? count(session()->get('cart')) : 0 }}</sup>
                </a>

                <a href="" class="header-widget">
                    <i style="font-size: 25px;" class="bi-wallet2"></i>
                </a>
            </div>
            <div class="header-media-group">
                <label for="toogle-menu" class="menu-icon header-user"><i class="bi-list"></i></label>
                <form class="header-form d-lg-none">
                    <input type="text" class="search-field" name="s" placeholder="Search for...">
                    <button><i class="bi-search"></i></button>
                </form>
                <div class="header-top-select">
                    <div class="flex-shrink-0 dropdown pe-3">
                        <a href="#" class="d-block text-white text-decoration-none dropdown-toggle" id="dropdownUser2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Hi {{auth()->user()->username}}!
                        </a>
                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                            <li><a class="dropdown-item" href="{{ route('accountindex') }}">Dashboard</a></li>
                            <li><a class="dropdown-item" href="{{ route('pgp') }}">PGP Settings</a></li>
                            <li><a class="dropdown-item" href="">2FA Settings</a></li>
                            <li><a class="dropdown-item" href="{{ route('statistics') }}">Password Settings</a></li>
                            <li><a class="dropdown-item" href="{{ route('settings') }}">Currency Settings</a></li>
                            <li><a class="dropdown-item" href="{{ route('history') }}">Pin Settings</a></li>
                            @if(auth() -> user() -> isSeller())
                            <li><a class="dropdown-item" href="{{ route('seller.dashboard') }}">Vendor Dashboard</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <form class="form-inline" action="" method="post">
                        <a href="{{ route('logout') }}" class="btn btn-danger"><i class="bi-box-arrow-right"></i>
                            Logout</a>
                    </form>
                </div>

            </div>
        </div>
</section>


<input type="checkbox" id="toogle-menu">
<aside class="nav-sidebar">
    <div class="nav-header">

        <label for="toogle-menu" class="menu-icon nav-close">
            <i class="bi-x"></i>
        </label>
    </div>
    <div class="nav-content">
        <div class="nav-select-group">
            <ul class="d-flex nav mb-0">
                <li class="nav-item"><a href="" class="nav-link"><i class="bi-wallet2"></i> Your Wallet</a></li>
                <li class="nav-item"><a href="" class="nav-link"><i class="bi-bag-plus"></i> Your Orders</a></li>
            </ul>
        </div>
        <div class="nav-select-group">
            <div class="flex-shrink-0 dropdown">
                <a href="#" class="d-block text-white text-decoration-none dropdown-toggle" id="dropdownUser3"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Hi! {{auth()->user()->username}}
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3">
                    <li><a class="dropdown-item" href="">Dashboard</a></li>
                    <li><a class="dropdown-item" href="">Password Settings</a></li>
                    <li><a class="dropdown-item" href="">PGP Settings</a></li>
                    <li><a class="dropdown-item" href="">2FA Settings</a></li>
                </ul>
            </div>

            <div class="flex-shrink-0 dropdown ps-3">
                <a href="#" class="text-white dropdown-toggle" id="dropdownUser4" data-bs-toggle="dropdown"
                    aria-expanded="false">My Support</a>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser4">
                    <li><a class="dropdown-item" href="">FAQ</a></li>
                    <li><a class="dropdown-item" href="">Market PGP</a></li>
                    <li><a class="dropdown-item" href="">Mirrors</a></li>
                    <li><a class="dropdown-item" href="">Canary</a></li>
                    <li><a class="dropdown-item" href="">Helpdesk</a></li>
                </ul>
            </div>
        </div>

        <ul class="nav-list">
            <li class="nav-item"><a class="nav-link" href="">Home <span></span></a></li>
            <li class="nav-item"><a class="nav-link" href="">Dashboard <span></span></a></li>
        </ul>

        <div class="nav-info-group">
            <ul>
                <li>XMR 1.00 = $259.27</li>
                <li>BTC 1.00 = $63803.6</li>
            </ul>
            <ul>

                <li><a href="exchange.php" class="btn btn-sm btn-warning">Exchange</a></li>

            </ul>
        </div>

        <div class="nav-select">
            <i class="bi-globe"></i>
            <select class="select">
                <option value="currency" selected>USD</option>

            </select>
        </div>

    </div>
</aside>

<menu class="mobile-menu">
    <a href="{{route('home')}}"><i class="bi-house"></i><span>Home</span></a>
    <a href=""><i class="bi-chat"></i><span>Chat</a>
    <a href="><i class=" bi-bell"></i><span>Notification</span><sup></sup></a>
    <a href=""><i class="bi-cart"></i><span>Cart</span><sup></sup></a>
</menu>