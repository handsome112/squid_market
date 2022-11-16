@extends('staff.admin.adminmain')
@section('content')
<title>Admin Vendors - Squid Market</title>
<!-- Vendors Start -->
<div class="bg-primary text-center rounded p-2 mx-4 mt-4">
    <h4 class="mb-0" style="color:white">Vendors</h4>
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
                        <th scope="col">Vendor Since</th>
                        <th scope="col">Username</th>
                        <th scope="col">Sales</th>
                        <th scope="col">Total Sold</th>
                        <th scope="col">Funds In Escrow</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vendors as $vendor)
                    <tr>
                        <td>{{ date('d/m/y', strtotime($vendor->seller_since)) }}</td>
                        <td>{{ $vendor->username }}</td>
                        <td>{{$vendor->totalSales('purchased')+$vendor->totalSales('shipped')+$vendor->totalSales('delivered')+$vendor->totalSales('disputed')+$vendor->totalSales('refunded')+$vendor->totalSales('canceled')}}
                        </td>
                        <td>$9799</td>
                        <td>$564</td>
                        <td>
                            @if(Cache::has('user-is-online-' . $vendor->id))
                            <span class="text-success">Online</span>
                            @else
                            <span class="text-black">Offline</span>
                            @endif
                        </td>
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
<!-- Vendors End -->
@stop