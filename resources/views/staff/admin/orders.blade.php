@extends('staff.admin.adminmain')
@section('content')
<title>Admin Orders - Squid Market</title>
<!-- Orders Start -->
<div class="bg-primary text-center rounded p-2 mx-4 mt-4">
    <h4 class="mb-0" style="color:white">Orders</h4>
</div>
<div class="container-fluid pt-4 px-4">
    <form class="d-none d-md-flex">
        <input class="form-control bg-secondary border-0 mb-3" style="width:300px;margin-left:auto" type="search"
            placeholder="Search">
    </form>
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">Ordered On</th>
                        <th scope="col">Buyer</th>
                        <th scope="col">Vendor</th>
                        <th scope="col">Method</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>{{date('d/m/y', strtotime($order->created_at)) }}</td>
                        <td>{{ $order->buyer->username }}</td>
                        <td>{{ $order->seller->username }}</td>
                        <td>{{ $order->product->paymethod }}</td>
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
<!-- Orders End -->
@stop