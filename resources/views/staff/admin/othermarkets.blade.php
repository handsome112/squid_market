@extends('staff.admin.adminmain')
@section('content')
<title>Admin Other Markets - Squid Market</title>
<!-- Other Markets Start -->
<div class="bg-primary text-center rounded p-2 mx-4 mt-4">
    <h4 class="mb-0" style="color:white">Other Markets</h4>
</div>

<div style="margin-top: 30px; text-align: center">
    <label for="addmarket">
        <td><a class="btn btn-sm btn-primary">Add Market</a></td>
    </label>
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
                        <th scope="col">Market Name</th>
                        <th scope="col">Market Logo</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($markets as $market)
                    <tr>
                        <td>{{ $market->name }}</td>
                        <td class="d-flex align-items-center"><input class="form-check-input m-0" type="checkbox"
                                id="todo"><img src="{{ $market->logo }}" class="mx-2" /></td>
                        <td><label for="editmarket"><a class="btn btn-sm btn-primary">Edit</a></label></td>
                        <input type="checkbox" id="editmarket" />
                        <div class="editmarket">
                            <h3>Edit Market</h3>
                            <h5 class="text-muted">Input the market name and market logo(base 64)</h5>
                            <form
                                action="{{ route('editothermarket', ['section' => $section, 'market' => $market->id]) }}"
                                method="post">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <span>Market Name:</span>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control bg-secondary" name="marketname"
                                            value="{{ $market->name }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <span>Market Logo:</span>
                                    </div>
                                    <div class="col-md-9">
                                        <textarea class="form-control bg-secondary" rows="5"
                                            name="marketlogo">{{ $market->logo }}</textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                </div>
                            </form>
                        </div>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="color:red;text-align:center">Looks empty :( </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<input type="checkbox" id="addmarket" />
<div class="addmarket">
    <h3>Add Market</h3>
    <h5 class="text-muted">Input the market name and market logo(base 64)</h5>
    <form action="{{ route('addothermarket', ['section' => $section]) }}" method="post">
        @csrf
        <div class="row mb-3">
            <div class="col-md-3">
                <span>Market Name:</span>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control bg-secondary" name="marketname" />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3">
                <span>Market Logo:</span>
            </div>
            <div class="col-md-9">
                <textarea class="form-control bg-secondary" rows="5" name="marketlogo"></textarea>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
        </div>
    </form>
</div>
<!-- Other Markets End -->
@stop