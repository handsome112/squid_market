@extends('staff.admin.adminmain')
@section('content')
<title>Admin Messages - Squid Market</title>
<!-- Messages Start -->
<div class="bg-primary text-center rounded p-2 mx-4 mt-4">
    <h4 class="mb-0" style="color:white">Messages</h4>
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
                        <th scope="col">Created On</th>
                        <th scope="col">Sender</th>
                        <th scope="col">Receiver</th>
                        <th scope="col">Banned Words Used</th>
                        <th scope="col">Violation</th>
                        <th scope="col">Action</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $message)
                    <tr>
                        <td>{{ date('H:i/m/d/y', strtotime($message->created_at))  }}</td>
                        <td>{{ $message->user->username }}</td>
                        <td>{{ $message->receiver->username }}</td>
                        <td>{{ $message->usedbanwords() }}</td>
                        <td>{{ $message->checkViolate() }}</td>
                        <td><a class="btn btn-sm btn-primary" href="">Delete</a></td>
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
<!-- Messages End -->
@stop