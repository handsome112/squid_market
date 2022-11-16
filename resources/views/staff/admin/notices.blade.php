@extends('staff.admin.adminmain')
@section('content')
<title>Admin Notices - Squid Market</title>

<div class="bg-primary text-center rounded p-2 mx-4 mt-4">
    <h4 class="mb-0" style="color:white">Notices</h4>
</div>
<div class="container-fluid pt-4 px-4">
    <form class="d-none d-md-flex flex-column bg-secondary mb-4 p-4" action="{{ route('post.admin.addnotice') }}"
        method="post">
        @csrf
        <h3 class="mb-3">Add New Notices</h3>
        <div class="d-flex align-items-center mb-3">
            <h5 class="mb-0 mx-3" style="margin-right:34px !important">Title</h5>
            <input class="form-control bg-dark border-0" style="width:300px" type="text" id="title" name="title"
                placeholder="Title">
            <div class="error">
                @error('title')
                <small class="text-danger">{{ $errors->first('title') }}</small>
                @enderror
            </div>
        </div>
        <div class="d-flex mb-3">
            <h5 class="mb-0 mx-3">Notice</h5>
            <textarea class="bg-dark form-control border-0 mb-2" placeholder="Notice" id="notice"
                name="notice"></textarea>
            <div class="notice">
                @error('notice')
                <small class="text-danger">{{ $errors->first('notice') }}</small>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-primary" style="width:100px;margin-left:90px">Add</button>
    </form>
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Notice</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Updated at</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($notices as $notice)
                    <tr>
                        <td>{{ $notice->title }}</td>
                        <td>{{ $notice->user->username }}</td>
                        <td>{{ $notice->notice }}</td>
                        <td>{{ $notice->createdAt() }}</td>
                        <td>{{ $notice->updatedAt() }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="" class="btn btn-sm btn-primary mx-1">edit</a>
                                <form action="{{ route('delete.admin.notice', ['notice' => $notice->id]) }}"
                                    class="inblock" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-primary">delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="color:red;text-align:center">Looks empty :(</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop