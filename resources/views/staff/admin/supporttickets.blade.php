@extends('staff.admin.adminmain')
@section('content')
<title>Admin Vendors - Squid Market</title>
<!-- Support tickets Start -->
<div class="bg-primary text-center rounded p-2 mx-4 mt-4">
    <h4 class="mb-0" style="color:white">Support Tickets</h4>
</div>
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <form action="{{ route('admin.supporttickets', ['section' => 'supporttickets']) }}" method="get">
                @csrf
                <label for="status" style="color:white;font-size:18px">Status:</label>
                <select class="dropdown-wrapper form-control-sm bg-dark text-white" id="status" name="status">
                    <option value="closed" @if($status=='closed' ) selected @endif>Closed</option>
                    <option value="opened" @if($status=='opened' ) selected @endif>Opened</option>
                    <option value="accepted" @if($status=='accepted' ) selected @endif>Accepted</option>
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
                        <th scope="col">Username</th>
                        <th scope="col">Title</th>
                        <th scope="col">Action</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($helpRequests as $helpRequest)
                    <tr>
                        <td>{{ date('m/d/y', strtotime($helpRequest->created_at)) }}</td>
                        <td>{{ $helpRequest->user->username }}</td>
                        <td>
                            {{ $helpRequest->decryptTitle() }}
                        </td>
                        <td>
                            @if($helpRequest->status() == 'opened')
                            <form
                                action="{{ route('post.staff.openhelprequest', ['helpRequest' => $helpRequest->id]) }}"
                                method="post" class="inblock">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary">Accept Ticket</button>
                            </form>
                            @elseif($helpRequest->status() == 'accepted' && $helpRequest->admin->username ==
                            auth()->user()->username)
                            <form
                                action="{{ route('post.staff.closehelprequest', ['helpRequest' => $helpRequest->id]) }}"
                                method="post" class="inblock">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary">Close Ticket</button>
                            </form>
                            @elseif($helpRequest->status() == 'accepted' && $helpRequest->admin->username !=
                            auth()->user()->username)
                            <button class="btn btn-sm btn-warning">Accepted</button>
                            @elseif($helpRequest->status() == 'closed')
                            <button class="btn btn-sm btn-primary">Closed</button>
                            @endif
                        </td>
                        <td>
                            @if($helpRequest->admin_id != null && $helpRequest->admin->username ==
                            auth()->user()->username)
                            <a href="{{ route('helprequest', ['helpRequest' => $helpRequest->id]) }}"
                                class="btn btn-sm btn-warning">
                                View Ticket
                            </a>
                            @else
                            <a href="{{ route('helprequest', ['helpRequest' => $helpRequest->id]) }}"
                                class="btn btn-sm btn-primary">
                                View Ticket
                            </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="color:red;text-align:center">Looks empty :(</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Support helprequests End -->
@stop