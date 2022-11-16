@extends('staff.admin.adminmain')
@section('content')
<title>Admin BannedUsers - Squid Market</title>
<!-- Recent Sales Start -->
<div class="bg-primary text-center rounded p-2 mx-4 mt-4">
    <h4 class="mb-0" style="color:white">Banned Users</h4>
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
                        <th scope="col">Banned On</th>
                        <th scope="col">Username</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bannedusers as $user)
                    <tr>
                        <td>{{ date('d/m/y', strtotime($user->ban_since)) }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->banreason }}</td>
                        <td><a class="btn btn-sm btn-primary"
                                href="{{ route('unban.user', ['user' => $user->id]) }}">Unban</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="color:red;text-align:center;">Looks empty :(</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->

@stop