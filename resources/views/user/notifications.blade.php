@extends('master.main')
@section('content')

<title>Notifications - Squid Market</title>
@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center mb-0">
            <h5><img src=<?php echo \App\Tools\Converter::convert_into_base64(
                public_path('img/icons/megaphone.png')
            ); ?> width="17px" style="margin-top:-3px"> Notifications</h5>
        </div>
    </div>
</section>

<section class="section mt-0">
    <div class="container">
        <form action="{{ route('delete.notifications') }}" method="post" class="mb-10">
            @csrf
            @method('delete')
            <div class="account-card">
                <button class="btn btn-primary w-100">Delete all read messages</button>
                <div class="d-flex justify-content-center mt-2 mb-2">
        </form>
    </div>
    @forelse($notifications as $notification)
    <div class="alert d-flex align-items-center justify-content-between @if($notification->read == 0) alert-warning unreadnoti @else alert-info @endif"
        role="alert">
        <div>{!! $notification->label !!}</div>
        <div>
            <span class="mx-2">{{ $notification->creationDate() }}</span>
            <a href="{{ route('notificationdetail', ['notification' => $notification->id]) }}"
                class="btn btn-info btn-xs ms-auto">View</a>
        </div>
    </div>
    @empty
    <div class="alert alert-warning d-flex align-items-center alert2" role="alert">
        <p>Looks empty :(</p>
    </div>
    @endforelse

</section>

@stop