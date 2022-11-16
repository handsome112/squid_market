<?php namespace App\Tools; ?>
@php
#Get all root categories
$totaloforders = \App\Models\Order::totalCounts();
$totalofmessages = \App\Models\ConversationMessage::totalCounts();
$totalofreprotvendors = \App\Models\Reportvendor::totalCounts();
$totalofreprotproducts = \App\Models\Report::totalCounts();
$totalofhelpdesks = \App\Models\HelpRequest::totalCounts();
$totalofdisputes = \App\Models\Dispute::totalCounts();
@endphp
<!-- Sidebar Start -->
<div class="sidebar pe-3 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <!-- <img src="../../../../../public/logo.png" /> -->
        <!-- <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Squid</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Jhon Doe</h6>
                        <span>Admin</span>
                    </div>
                </div> -->
        <div class="navbar-nav w-100">
            <a href="{{ route('admin.dashboard', ['section' => 'dashboard']) }}"
                class="nav-item nav-link @if($section=='dashboard') active @endif"><i
                    class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.settings', ['section' => 'adminsettings']) }}"
                class="nav-item nav-link @if($section=='adminsettings') active @endif"><i
                    class=" fa fa-wrench me-2"></i>Market
                Settings</a>
            @endif
            <a href="{{ route('admin.users', ['section' => 'users']) }}"
                class="nav-link @if($section=='users') active @endif"><i class=" fa fa-users me-2"></i>Manage Users</a>
            @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.categories', ['section' => 'categories']) }}"
                class="nav-item nav-link @if($section=='categories') active @endif"><i
                    class="fa fa-list me-2"></i>Manage Categories</a>
            <a href="{{ route('admin.faqs', ['section' => 'faqs']) }}"
                class="nav-item nav-link @if($section=='faqs') active @endif"><i class="fa fa-list me-2"></i>Manage
                Faqs</a>
            @endif
            <a href="{{ route('admin.news', ['section' => 'news']) }}"
                class="nav-link @if($section=='news') active @endif"><i class=" fa fa-book me-2"></i>Manage News</a>
            @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.withdrawmarketfees', ['section' => 'withdrawmarketfees']) }}"
                class="nav-link @if($section=='withdrawmarketfees') active @endif"><i
                    class=" fa fa-money-bill-alt me-2"></i>Withdraw
                Market
                Fees</a>
            <a href="{{ route('admin.lostmoneyhistory', ['section' => 'lostmoneyhistory']) }}"
                class="nav-link @if($section=='lostmoneyhistory') active @endif"><i
                    class=" fa fa-money-bill-alt me-2"></i>Lost
                Money
                History</a>
            <a href="{{ route('admin.withdrawalhistory', ['section' => 'withdrawalhistory']) }}"
                class="nav-link @if($section=='withdrawalhistory') active @endif"><i
                    class=" fa fa-money-bill-alt me-2"></i>Withdrawal
                History</a>
            @endif
            <a href="{{ route('admin.livefeed', ['section' => 'livefeed']) }}"
                class="nav-item nav-link @if($section=='livefeed') active @endif"><i
                    class=" fa fa-briefcase me-2"></i>Staff LiveFeed</a>
            <a href="{{ route('admin.vendors', ['section' => 'vendors']) }}"
                class="nav-item nav-link @if($section=='vendors') active @endif"><i
                    class=" fa fa-store me-2"></i>Vendors</a>
            <a href="{{ route('admin.massmessages', ['section' => 'massmessages']) }}"
                class="nav-item nav-link @if($section=='massmessages') active @endif"><i
                    class=" fa fa-envelope-open-text me-2"></i>Mass
                Message</a>
            <a href="{{ route('admin.products', ['section' => 'products']) }}"
                class="nav-item nav-link @if($section=='products') active @endif"><i
                    class=" fa fa-tags me-2"></i>Products</a>
            <a href="{{ route('admin.orders', ['section' => 'orders']) }}"
                class="nav-item nav-link @if($section=='orders') active @endif"><i class=" fa fa-gift me-2"></i>Orders
                <span class="float-right badge bg-danger">{{ $totaloforders }}</span></a>
            <a href="{{ route('admin.messages', ['section' => 'messages']) }}"
                class="nav-item nav-link @if($section=='messages') active @endif"><i
                    class=" fa fa-comments me-2"></i>Messages <span
                    class="float-right badge bg-danger">{{ $totalofmessages }}</span></a>
            <a href="{{ route('admin.withdrawals', ['section' => 'withdrawals']) }}"
                class="nav-item nav-link @if($section=='withdrawals') active @endif"><i
                    class="fa fa-wallet me-2"></i>Withdrawals</a>
            @if(auth()->user()->admin==1)
            <a href="{{ route('admin.notices', ['section' => 'adminnotices']) }}"
                class="nav-item nav-link @if($section=='adminnotices') active @endif"><i
                    class="fa fa-check me-2"></i>Notices</a>
            @endif
            <a href="{{ route('admin.othermarkets', ['section' => 'othermarkets']) }}"
                class="nav-item nav-link @if($section=='othermarkets') active @endif"><i
                    class="fa fa-store me-2"></i>Other Markets</a>
            <a href="{{ route('admin.disputes', ['section' => 'disputes']) }}"
                class="nav-item nav-link @if($section=='disputes') active @endif"><i
                    class="fa fa-flag me-2"></i>Disputes <span
                    class="float-right badge bg-danger">{{ $totalofdisputes }}</span></a>
            <a href="{{ route('admin.bannedusers', ['section' => 'bannedusers']) }}"
                class="nav-item nav-link @if($section=='bannedusers') active @endif"><i
                    class="fa fa-ban me-2"></i>Banned Users</a>
            <a href="{{ route('admin.supporttickets', ['section' => 'supporttickets']) }}" class="nav-item nav-link"><i
                    class="fa fa-headset me-2"></i>Help desk <span
                    class="float-right badge bg-danger">{{ $totalofhelpdesks }}</span></a>
            <a href="{{ route('admin.reportvendors', ['section' => 'reportvendors']) }}"
                class="nav-item nav-link @if($section=='reportvendors') active @endif"><i
                    class="fa fa-exclamation me-2"></i>ReportVendors <span
                    class="float-right badge bg-danger">{{ $totalofreprotvendors }}</span></a>
            <a href="{{ route('admin.reportproducts', ['section' => 'reportproducts']) }}"
                class="nav-item nav-link @if($section=='reportproducts') active @endif"><i
                    class="fa fa-exclamation me-2"></i>ReportProducts <span
                    class="float-right badge bg-danger">{{ $totalofreprotproducts }}</span></a>
        </div>
    </nav>
</div>
<!-- Sidebar End -->