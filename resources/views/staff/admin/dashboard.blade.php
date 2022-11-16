@extends('staff.admin.adminmain')
@section('content')
<title>Admin Dashboard - Squid Market</title>
<!-- Market Statistics Start -->
<div class="bg-primary text-center rounded p-2 mx-4 mt-4">
    <h4 class="mb-0" style="color:white">Dashboard</h4>
</div>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fas fa-money-bill-alt fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total XMR Fees</p>
                    <h6 class="mb-0">{{ $totalUsers }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fas fa-money-bill-alt fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Pending Withdraws</p>
                    <h6 class="mb-0">{{ $totalSellers }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fas fa-money-bill-alt fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total In Escrow</p>
                    <h6 class="mb-0">@if(auth()->user()->isAdmin()) $0 @else ??? @endif</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-list-alt fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Featured Listings</p>
                    <h6 class="mb-0">{{ $totalProducts }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-users fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Users</p>
                    <h6 class="mb-0">{{ $totalUsers }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-store fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Market Vendors</p>
                    <h6 class="mb-0">{{ $totalSellers }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-user-check fa-2x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">New Users - 24Hr</p>
                    <h6 class="mb-0">{{ $countofNewUsers }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-list-alt fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Products Listings</p>
                    <h6 class="mb-0">{{ $totalProducts }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->

<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Sales</p>
                    <h6 class="mb-0">
                        {{auth()->user()->totalSales('purchased')+auth()->user()->totalSales('shipped')+auth()->user()->totalSales('delivered')+auth()->user()->totalSales('disputed')+auth()->user()->totalSales('refunded')+auth()->user()->totalSales('canceled')}}
                    </h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Today's Sale</p>
                    <h6 class="mb-0">0</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fas fa-book fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">News</p>
                    <h6 class="mb-0">0</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fas fa-money-bill-alt fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">24Hr Withdraws</p>
                    <h6 class="mb-0">$0</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-headset fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Tickets</p>
                    <h6 class="mb-0">{{ $totalUsers }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-list fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Categories</p>
                    <h6 class="mb-0">{{ $totalSellers }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class=" fa fa-comments fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Conversations</p>
                    <h6 class="mb-0">{{ $countofNewUsers }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-flag fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Disputes</p>
                    <h6 class="mb-0">{{ $totalProducts }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Recent Salse</h6>
            <a href="{{ route('admin.orders', ['section' => 'orders']) }}">Show All</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">Date</th>
                        <th scope="col">Product</th>
                        <th scope="col">Vendor</th>
                        <th scope="col">Buyer</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>{{ date('m/d/y', strtotime($order->created_at)) }}</td>
                        <td>{{ $order->product->name }}</td>
                        <td>{{ $order->seller->username }}</td>
                        <td>{{ $order->buyer->username }}</td>
                        <td>${{ $order->product->price }}</td>
                        <td>{{ $order->status }}</td>
                        <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="color:red;text-align:center">Looks empty :(</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->

<!-- Widgets Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="h-100 bg-secondary rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="mb-0">Messages</h6>
                    <a href="{{ route('admin.messages', ['section' => 'messages']) }}">Show All</a>
                </div>
                @forelse($messages as $message)
                <div class="d-flex align-items-center border-bottom py-3">
                    <img class="rounded-circle flex-shrink-0" src="{{ $message->user->avatar }}" alt="asdf"
                        style="width: 40px; height: 40px;">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-0">{{ $message->user->username }}</h6>
                            <small>{{ $message->creationDate() }}</small>
                        </div>
                        <span class="onlyonerow">{{ $message->decryptMessage() }}</span>
                    </div>
                </div>
                @empty
                <div class="d-flex align-items-center justify-content-around py-3" style="color:red"
                    id="recent_added_product">
                    <p>Looks empty :(</p>
                </div>
                @endforelse
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="h-100 bg-secondary rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="mb-0">Recently Added Products</h6>
                    <a href="{{ route('admin.products', ['section' => 'products']) }}">Show All</a>
                </div>
                @forelse($products as $product)
                <div class="d-flex align-items-center border-bottom py-3" id="recent_added_product">
                    <img class="flex-shrink-0" src="{{ $product->image }}" alt="" style="width: 40px; height: 40px;">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-0 onlyonerow">{{ $product->name }}</h6>
                            <small style="background-color:skyblue;">${{ $product->price }}</small>
                        </div>
                        <span class="onlytworow">{{ $product->description }}<span>
                    </div>
                </div>
                @empty
                <div class="d-flex align-items-center justify-content-around py-3" style="color:red"
                    id="recent_added_product">
                    <p>Looks empty :(</p>
                </div>
                @endforelse
                <div id="calender"></div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="h-100 bg-secondary rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">To Do List</h6>
                    <a href="">Show All</a>
                </div>
                <form method="post" action="{{ route('post.addtodo') }}" class="d-flex mb-2">
                    @csrf
                    <input class="form-control bg-dark border-0" type="text" placeholder="Enter task" name="nametodo">
                    <button type="submit" class="btn btn-primary ms-2">Add</button>
                </form>
                @error('nametodo')
                <div class="error">
                    <small class="text-danger">{{ $errors->first('nametodo') }}</small>
                </div>
                @enderror
                @forelse($todolists as $todolist)
                <div class="d-flex align-items-center border-bottom py-2">
                    <input class="form-check-input m-0" type="checkbox" id="todo">
                    <div class="w-100 ms-3" id="nametodo1">
                        <div class="d-flex w-100 align-items-center justify-content-between" id="nametodo2">
                            <span class="onlyonerow" id="nametodo">{{ $todolist->name }}</span>
                            <a href="{{ route('deltodo', ['todo' => $todolist->id]) }}" class="btn btn-sm"><i
                                    class="fa fa-times"></i></a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="d-flex align-items-center justify-content-around py-3" style="color:red"
                    id="recent_added_product">
                    <p>Looks empty :(</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
<!-- Widgets End -->

<!-- Members Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-md-6 col-xl-6">
            <div class="bg-secondary rounded p-4" style="height: 520px;">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Admin/Mod Messaging</h6>
                    <a href="">Show All</a>
                </div>
                <div class="chat_total">
                    <div class="chat_pan" style="height: 350px;overflow: auto;">
                        <ol class="messanger-list">
                            <li class="common-message is-time d-flex">
                                <span class="common-message-content">Today</span>
                            </li>
                            @forelse($adminchats as $adminchat)
                            <li
                                class="common-message @if(auth()->user()==$adminchat->user) is-you @else is-other @endif">
                                <div class="d-flex flex-column align-items-center" id="user">
                                    <img class="rounded-circle flex-shrink-0" src="{{ $adminchat->user->avatar }}"
                                        alt=":(" style="width: 40px; height: 40px;">
                                    <span>{{ $adminchat->user->username }}</span>
                                </div>
                                <div class="d-flex flex-column">
                                    <small datetime>{{ date('H:m', strtotime($adminchat->created_at))  }}</small>
                                    <span class="common-message-content">
                                        {{ $adminchat->message }}
                                        <span class="status"><i class="bi-check"></i></span>
                                    </span>
                                </div>
                            </li>
                            @empty
                            <p style="color:red;text-align:center">Looks empty :(</p>
                            @endif
                        </ol>
                    </div>
                    <form class="input-group px-4" action="{{ route('post.adminchats') }}" method="post">
                        @csrf
                        <input class="form-control bg-dark border-0" type="text" placeholder="Type Message..."
                            name="message">
                        <button type="submit" class="btn btn-warning">Send</button>
                    </form>
                    @error('message')
                    <div class="error">
                        <small class="text-danger" style="margin-left:25px">{{ $errors->first('message') }}</small>
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-xl-6">
            <div class="bg-secondary rounded p-4" style="height: 520px;overflow: auto;">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Latest Members</h6>
                    <small class="px-1"
                        style="background-color: red;color:white;border-radius: 5px;font-weight: bold;">{{ $users->count() }}
                        New
                        Members</small>
                    <a href="{{ route('admin.users', ['section' => 'users']) }}">Show All</a>
                </div>
                <div class="d-flex flex-wrap">
                    @forelse($users as $user)
                    <div class="d-flex flex-column align-items-center mx-2 my-1">
                        <a href="{{ route('edituser', ['user' => $user->id, 'section' => 'users']) }}">
                            <img class="rounded-circle flex-shrink-0" src="{{ $user->avatar }}" alt=""
                                style="width: 60px; height: 60px;">
                        </a>
                        <span class="onlyonerow">{{ $user->username }}</span>
                        <small>Today</small>
                    </div>
                    @empty
                    <div>
                        <p>Looks Empty :(</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Members End -->
@stop