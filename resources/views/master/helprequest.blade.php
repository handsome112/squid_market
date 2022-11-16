@extends('master.main')
@section('content')

<title> Ticket - Squid Market</title>

@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')

<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center mb-0">
            <h5><img src="{{ asset('img/icons/chat.png') }}" width="17px" style="margin-top:-3px"> Helpdesk</h5>
        </div>
    </div>
</section>

<form action="{{ route('post.helprequest', ['helpRequest' => $helpRequest->id]) }}" method="post">
    @csrf
    <section class="section mt-0 mb-3">
        <div class="container">
            <div class="account-card">
                <div class="col-md-8 col-lg-12">
                    <form class="contact-form mb-3">
                        <h4 class="mb-3">Support Ticket - {{ $helpRequest->decryptTitle() }}
                            ({{ $helpRequest->status() }})
                            @if(auth()->user()->admin == 1)
                            <small><a href="{{ route('admin.supporttickets', ['section' => 'supporttickets']) }}">View
                                    all tickets</a></small>
                            @else
                            <small><a href="{{route('support')}}">View all tickets</a></small>
                            @endif
                        </h4>
                        @foreach($messages as $message)
                        <br>
                        <div class="card">
                            <div class="card-body">
                                {{ $message->decryptMessage() }}
                            </div>
                            <div class="card-footer text-end">
                                {{ $message->creationDate() }} <strong>{{ $message->user->username }}</strong>
                            </div>
                        </div>
                        @endforeach
                        <br>
                        @if( $helpRequest->status() !== 'closed' && ($helpRequest->user_id == auth()->user()->id ||
                        $helpRequest->admin_id == auth()->user()->id))
                        <div class="form-group">
                            <label>Compose Message:</label>
                            <textarea class="form-control" id="message" name="message" rows="20" cols="50"
                                placeholder="Type Message Here..."></textarea>
                        </div>
                        <button type="submit" class="form-btn-group">
                            Send Message <img src="{{ asset('img/icons/plus-circle.png') }}" width="14px"
                                style="margin-top:-3px"></i>
                        </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>
</form>

@stop