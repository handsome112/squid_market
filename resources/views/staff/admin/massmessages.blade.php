@extends('staff.admin.adminmain')
@section('content')
<title>Admin Mass Messages - Squid Market</title>

@include('includes.flash.success')
@include('includes.flash.error')
@include('includes.flash.validation')
<div class="bg-primary text-center rounded p-2 mx-4 mt-4">
    <h4 class="mb-0" style="color:white">Mass Message</h4>
</div>
<div class="container-fluid pt-4 px-4">
    <form class="bg-secondary text-center rounded p-4" action="{{ route('post.admin.massmessage') }}" method="post">
        @csrf
        <div class="d-flex mb-3">
            <h5 class="mb-0 mx-3">Message</h5>
            <textarea class="bg-dark form-control border-0 mb-2" placeholder="Mass Message" id="message"
                name="message"></textarea>
            <div class="notice">
                @error('message')
                <small class="text-danger">{{ $errors->first('message') }}</small>
                @enderror
            </div>
        </div>
        <div class="d-flex" style="margin-left:110px">
            <div class="d-flex align-items-center mx-2">
                <input class="form-check-input m-0" type="checkbox" value="buyers" name="group[]">
                <span>&nbsp;Buyers</span>
            </div>
            <div class="d-flex align-items-center mx-2">
                <input class="form-check-input m-0" type="checkbox" value="sellers" name="group[]">
                <span>&nbsp;Sellers</span>
            </div>
            <div class="d-flex align-items-center mx-2">
                <input class="form-check-input m-0" type="checkbox" value="staff" name="group[]">
                <span>&nbsp;Staff</span>
            </div>
            <button type="submit" class="btn btn-sm btn-primary ms-auto">Send</button>
        </div>
    </form>
</div>

@stop