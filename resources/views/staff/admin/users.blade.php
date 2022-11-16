@extends('staff.admin.adminmain')
@section('content')
<title>Admin Users - Squid Market</title>
<!-- Recent Sales Start -->
<div class="bg-primary text-center rounded p-2 mx-4 mt-4">
    <h4 class="mb-0" style="color:white">Users</h4>
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
                        <th scope="col">User Since</th>
                        <th scope="col">Username</th>
                        <th scope="col">User Type</th>
                        <th scope="col">Purchases</th>
                        <th scope="col">Total Spent</th>
                        <th scope="col">Funds In Escrow</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $user->created_at->format('m/d/y') }}</td>
                        <td>{{ $user->username }}</td>
                        @if($user->admin == 1)<td class="text-danger">Admin</td>
                        @elseif($user->moderator == 1)<td class="text-success">Moderator</td>
                        @elseif($user->seller== 1)<td>Seller</td>
                        @else <td>Buyer</td>
                        @endif
                        <td>{{ $user->totalOrdersCompleted() }}</td>
                        <td>XMR {{ $user->totalSpent($user) }}</td>
                        <td>$0</td>
                        <td>
                            @if(Cache::has('user-is-online-' . $user->id))
                            <span class="text-success">Online</span>
                            @else
                            <span class="text-black">Offline</span>
                            @endif
                        </td>
                        <td>
                            @if(!$user->isAdmin())
                            <a class="btn btn-sm btn-primary"
                                href="{{ route('edituser', ['user' => $user->id, 'section' => 'users']) }}">Edit</a>
                            @else
                            <label class="bg-primary btn-sm text-white" style="">Nobody Can Edit.</label>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="color:red;text-align:center">Looks empty :( </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->
@stop