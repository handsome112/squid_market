<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')

<title> Helpdesk - Squid Market</title>

@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center mb-0">
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/chat.png')
            ); ?> width="17px" style="margin-top:-3px"> Helpdesk</h5>
        </div>
    </div>
</section>


<form action="{{ route('post.createhelprequest') }}" method="post">
    <div class="alert alert-warning text-center" role="alert">
        If you receive any messages soliciting payments or are suspicious in any way, please report them to our
        helpdesk.
    </div>
    @csrf
    <section class="section mt-0 mb-3">
        <div class="container">
            <div class="account-card">
                <div class="row">
                    <div class="col-md-4 col-lg-4 mb-3">
                        <h4 class="mb-3">Helpdesk Tickets:</h4>
                        <ul class="nav nav-account">
                            <li class="nav-item active">
                                <a class="justify-content-center">
                                    <img src=<?php echo Converter::convert_into_base64(
                                        public_path('img/icons/plus-circle.png')
                                    ); ?> width="14px" style="margin-top:0px;margin-right:3px">
                                    New Helpdesk Ticket
                                </a>
                            </li>
                        </ul>
                        <table style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($helpRequests as $helpRequest)
                                <tr>
                                    <td>{{ $helpRequest->decryptTitle() }}</td>
                                    <td><strong>{{ $helpRequest->status() }}</strong></td>
                                    <td>
                                        <a href="{{ route('helprequest', ['helpRequest' => $helpRequest->id]) }}">Go</a>
                                    </td>
                                </tr>
                                <tr>
                                    @empty
                                    <div class="alert alert-warning text-center" role="alert">
                                        You have no Helpdesk tickets
                                    </div>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-8 col-lg-8">
                        <form class="contact-form">
                            <h4 class="mb-3">Create Helpdesk Ticket</h4>
                            <div class="form-group">
                                <label>Subject:</label>
                                <input class="form-control" type="text" id="title" name="title"
                                    placeholder="Enter Subject">
                            </div>
                            <div class="form-group">
                                <label>Subject Message:</label>
                                <textarea class="form-control" id="message" name="message" rows="20" cols="50"
                                    placeholder="Enters Message"></textarea>
                            </div>
                            <button type="submit" class="form-btn-group">
                                Open Helpdesk Ticket <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/chat.png')
                                ); ?> width="17px" style="margin-top:-3px">
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>

@stop