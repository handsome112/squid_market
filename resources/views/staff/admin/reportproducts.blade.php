@extends('staff.admin.adminmain')
@section('content')
<title>Admin Report Products - Squid Market</title>
<!-- Reports Start -->
<div class="bg-primary text-center rounded p-2 mx-4 mt-4">
    <h4 class="mb-0" style="color:white">Report Products</h4>
</div>
<div class="container-fluid pt-4 px-4">
    <form class="d-none d-md-flex">
        <input class="form-control bg-secondary border-0 mb-3" style="width:300px;margin-left:auto" type="search"
            placeholder="Search">
    </form>
    <div class="bg-secondary text-center rounded p-4">
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">Reported On</th>
                        <th scope="col">Complainant</th>
                        <th scope="col">Product</th>
                        <th scope="col">Vendor</th>
                        <th scope="col">Report</th>
                        <th scope="col">Action</th>
                        <th scope="col">Action</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reportproducts as $reportproduct)
                    <tr>
                        <td>{{ date('d/m/y', strtotime($reportproduct->created_at)) }}</td>
                        <td>{{ $reportproduct->user->username }}</td>
                        <td>{{ $reportproduct->product->name }}</td>
                        <td>{{ $reportproduct->product->seller->username }}</td>
                        <td>{{ $reportproduct->decryptMessage() }}</td>
                        <td><a class="btn btn-sm btn-primary" href="">Accept</a></td>
                        <td><a class="btn btn-sm btn-primary" href="">Reject</a></td>
                        <td><a class="btn btn-sm btn-primary" href="">Ban Product</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="color:red;text-align:center">Looks empty :( </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Reports End -->
@stop