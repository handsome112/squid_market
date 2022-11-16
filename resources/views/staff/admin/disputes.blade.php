@extends('staff.admin.adminmain')
@section('content')
<title>Admin Disputes - Squid Market</title>
<!-- Disputes Start -->
<div class="bg-primary text-center rounded p-2 mx-4 mt-4">
    <h4 class="mb-0" style="color:white">Disputes</h4>
</div>
<div class="container-fluid pt-4 px-4">
    <form class="d-none d-md-flex">
        <input class="form-control bg-secondary border-0 mb-3" style="width:300px;margin-left:auto" type="search"
            placeholder="Search">
    </form>
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <form action="{{ route('admin.disputes', ['section' => 'disputes']) }}" method="get">
                @csrf
                <label for="status" style="color:white;font-size:18px">Status:</label>
                <select class="dropdown-wrapper form-control-sm bg-dark text-white" id="status" name="status">
                    <option value="unaccepted" @if($status=='resolved' ) selected @endif>Unaccepted</option>
                    <option value="acceptedbyme" @if($status=='acceptedbyme' ) selected @endif>Accepted By Me</option>
                    <option value="acceptedbyothers" @if($status=='acceptedbyothers' ) selected @endif>Accepted By
                        Others</option>
                    <option value="resolved" @if($status=='unresolved' ) selected @endif>Resolved</option>
                    <option value="all" @if($status=='all' ) selected @endif>All</option>
                </select>
                <button type="submit" class="btn btn-sm btn-primary">Filter</button>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">Created On</th>
                        <th scope="col">Product</th>
                        <th scope="col">Buyer</th>
                        <th scope="col">Vendor</th>
                        <th scope="col">Order #</th>
                        <th scope="col">Executor</th>
                        <th scope="col">Winner</th>
                        <th scope="col">Action</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($disputes as $dispute)
                    <tr>
                        <td>{{ date('m/d/y', strtotime($dispute->created_at)) }}</td>
                        <td>{{ $dispute->product->name }}</td>
                        <td>{{ $dispute->buyer->username }}</td>
                        <td>{{ $dispute->seller->username }}</td>
                        <td>{{ $dispute->order->id }}</td>
                        <td>{{ $dispute->excutor->username }}</td>
                        <td>@if(!is_null($dispute->winner)){{ $dispute->winner->username }} @else Undefined @endif</td>
                        <td>
                            @if($dispute->status() == 'unresolved' && is_null($dispute->admin_id))
                            <a class="btn btn-sm btn-primary"
                                href="{{ route('acceptdispute', ['dispute' => $dispute->id]) }}">Accept</a>
                            @elseif($dispute->status() == 'unresolved' && $dispute->admin_id == auth()->user()->id)
                            <a class="btn btn-sm btn-warning">Accepted By Me</a>
                            @elseif($dispute->status() == 'unresolved' && $dispute->admin_id != auth()->user()->id)
                            <a class="btn btn-sm btn-primary">Accepted By Others</a>
                            @elseif($dispute->status() == 'resolved')
                            <a class="btn btn-sm btn-warning">Resolved</a>
                            @endif
                        </td>
                        <td>
                            @if($dispute->admin_id == auth()->user()->id)
                            <a class="btn btn-sm btn-warning"
                                href="{{ route('dispute-message', [ 'order' => $dispute->order->id ]) }}">View
                                Dispute</a>
                            @elseif($dispute->admin_id != null && $dispute->admin_id != auth()->user()->id)
                            <a class="btn btn-sm btn-primary">View
                                Dispute</a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" style="color:red;text-align:center">The market still has no disputes!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Disputes End -->
@stop