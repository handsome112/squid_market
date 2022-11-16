@extends('staff.admin.adminmain')
@section('content')
<title>Admin LiveFeed - Squid Market</title>
<!-- LiveFeed Start -->
<div class="bg-primary text-center rounded p-2 mx-4 mt-4">
    <h4 class="mb-0" style="color:white">Livefeed</h4>
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
                        <th scope="col">Date | Time</th>
                        <th scope="col">Symbol</th>
                        <th scope="col">Event</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($livefeeds as $livefeed)
                    <tr>
                        <td>{{ date('d/m/y', strtotime($livefeed->created_at)) }}
                            {{ date('H:i', strtotime($livefeed->created_at))  }}</td>
                        <td><?php echo $livefeed->symbol(); ?></td>
                        <td>{{ $livefeed->event }}</td>
                        <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="color:red;text-align:center">The market still has no livefeeds!</td>
                    </tr>
                    @endforelse
                    <tr>
                        <td colspan="5">{{ $livefeeds->links('includes.components.pagination') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- LiveFeed End -->
@stop