@extends('staff.admin.adminmain')
@section('content')
<title>Admin Edit Users - Squid Market</title>

@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<div class="bg-primary text-center rounded p-2 mx-4 mt-4">
    <h4 class="mb-0" style="color:white">User Settings</h4>
</div>
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="row">
            <form class="col-md-6 col-lg-6" method="post"
                action="{{ route('edit.mainsettings', ['user' => $user->id]) }}" style="border-right: 1px solid grey"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label text-start">User Avatar</label>
                    <div class="col-sm-8 d-flex align-items-center justify-content-between">
                        <label for="file-input" style="padding: 10px;border: 3px solid #726b6b;border-style: dashed;">
                            <img src="{{ asset('img/icons/upload.png') }}" width="50px" style="cursor:pointer;" />
                        </label>
                        <input id="file-input" name="avatar" type="file" style="display:none" />
                        <img src="{{ $user->avatar }}" width="70px" style="border-radius:50%;margin-right:30px" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label text-start">Username</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="username" name="username"
                            value="{{ $user->username }}" placeholder="Username" @if(auth()->user()->isModerator())
                        readonly
                        @endif>
                        @error('username')
                        <div class="error">
                            <small class="text-danger">{{ $errors->first('username') }}</small>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label text-start">Profile Description</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="profile" name="profile"
                            placeholder="Profile Description">@if($user->seller=='1'){{ $user->seller_description }}@else{{$user->description}}@endif</textarea>
                        @error('profile')
                        <div class="error">
                            <small class="text-danger">{{ $errors->first('profile') }}</small>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label text-start" for="status">Status</label>
                    <div class="col-sm-8">
                        <select class="w-100 dropdown-wrapper form-control-sm bg-dark text-white" id="status"
                            name="status">
                            @if(!auth()->user()->isModerator())
                            <option value="admin" @if($user->admin=='1' ) selected @endif>Admin</option>
                            <option value="mod" @if($user->moderator=='1' ) selected @endif>Moderator</option>
                            @endif
                            <option value="seller" @if($user->seller=='1' ) selected @endif>Seller</option>
                            <option value="buyer" @if($user->admin!='1' && $user->moderator!='1' && $user->seller!='1' )
                                selected
                                @endif>Buyer</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3 d-flex align-items-center">
                    <label class="col-sm-4 col-form-label text-start" for="fe">FE Rights</label>
                    <div class="col-sm-8">
                        <div class="form-switch d-flex align-items-center justify-content-between">
                            <input class="form-check-input form-control-md" type="checkbox" id="fe" name="fe"
                                style="width:3em;height:2em" @if($user->finalizeEarly()) checked @endif>
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
            <form class="col-md-6 col-lg-6" method="post" action="{{ route('edit.banuser', ['user' => $user->id]) }}">
                @csrf
                <label class="mb-2 text-white" style="font-size:18px;text-decoration:underline">Ban Options</label>
                <div class="row mb-3 d-flex align-items-center">
                    <label class="col-sm-4 col-form-label text-start" for="status">Ban User</label>
                    <div class="col-sm-8">
                        <div class="form-switch d-flex align-items-center justify-content-between">
                            <input class="form-check-input form-control-md" type="checkbox" id="c5" name="ban"
                                value="ban" style="width:3em;height:2em;" @if($user->ban=='1') checked @endif>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-4 col-form-label text-start">Ban Reason</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="banreason" name="banreason" rows="4"
                            placeholder="Ban Reason">{{ $user->banreason }}</textarea>
                        @error('banreason')
                        <div class="error">
                            <small class="text-danger">{{ $errors->first('banreason') }}</small>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <button class="btn btn-sm btn-primary" type="submit"
                        style="width:50px;margin-left:auto;margin-right:12px">Save</button>
                </div>
            </form>
        </div>
        <hr>
        @php
        $products = \App\Models\Product::featuredproductsofseller($user->id);
        @endphp
        <div class="row d-flex align-items-center">
            @if(auth()->user()->isAdmin())
            <form method="post" action="{{ route('edit.fakefeedback', ['user' => $user->id]) }}"
                class="col-md-6 col-lg-6" style="border-right: 1px solid grey">
                @csrf
                <label class="mb-2 text-white" style="font-size:18px;text-decoration:underline">Feedbacks</label>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label text-start" for="status">Select Products</label>
                    <div class="col-sm-8">
                        <select class="w-100 dropdown-wrapper form-control-sm bg-dark text-white" id="product_name"
                            name="product_name">
                            @forelse($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @empty
                            <option value="None" selected>-- None --</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label text-start">Review</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="review" name="review" placeholder="Shop Details"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label text-start">Rating</label>
                    <div class="col-sm-8 d-flex align-items-center justify-content-between">
                        <input type="number" class="form-control" id="rating" name="rating"
                            placeholder="Number Between 1 and 5">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label text-start">Type</label>
                    <div class="col-sm-8 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">Positive:&nbsp; <input class="form-check-input m-0"
                                type="checkbox" value="positive" name="positive"></div>
                        <div class="d-flex align-items-center">Neutral:&nbsp; <input class="form-check-input m-0"
                                type="checkbox" value="neutral" name="neutral"></div>
                        <div class="d-flex align-items-center">Negative:&nbsp; <input class="form-check-input m-0"
                                type="checkbox" value="negative" name="negative"></div>
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </div>
                </div>
            </form>
            @endif
            <div class="col-md-6 col-lg-6">
                <label class="mb-2 text-white" style="font-size:18px;text-decoration:underline">Other Markets</label>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-3">
                        <thead>
                            <tr>
                                <th>Market Logos</th>
                                <th class="text-success">Sales</th>
                                <th class="text-warning">Ratings</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($markets as $market)
                            <tr>
                                <td class="d-flex align-items-center"><input class="form-check-input m-0"
                                        type="checkbox" id="todo"><img src="{{ $market->logo }}" class="mx-2" />
                                </td>
                                <td><input type="text" class="bg-secondary text-white border-0 w-100" name="sales"
                                        @if(is_null(\App\Models\Marketofvendor::getRow($market, $user))) value="0" @else
                                        value="2" @endif />
                                </td>
                                <td><input type="text" class="bg-secondary text-white border-0 w-100" name="rating"
                                        @if(is_null(\App\Models\Marketofvendor::getRow($market, $user))) value="0" @else
                                        value="3" @endif />
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" style="color:red;text-align:center">Looks empty :( </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <form action="{{ route('asdf', ['user' => $user->id]) }}" method="post">
                        @csrf
                        <button class="btn btn-sm btn-primary" type="submit"
                            style="width:50px;margin-left:auto;float:right">Save</button>
                    </form>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6 col-lg-6" style="border-right:1px solid grey">
                <label class="mb-2 text-white" style="font-size:18px;text-decoration:underline">Warnings</label>
                <div class="row">
                    <label class="col-sm-3 col-form-label text-start text-danger">WARNINGS</label>
                    <div class="col-sm-9 mb-3">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="text-danger">1.</span>
                            <input class="form-check-input m-0 mx-2" type="checkbox" id="todo">
                            <input type="text" class="form-control" id="warning1" name="warning1" placeholder="">
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="text-danger">2.</span>
                            <input class="form-check-input m-0 mx-2" type="checkbox" id="todo">
                            <input type="text" class="form-control" id="warning1" name="warning1" placeholder="">
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="text-danger">3.</span>
                            <input class="form-check-input m-0 mx-2" type="checkbox" id="todo">
                            <input type="text" class="form-control" id="warning1" name="warning1" placeholder="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <button class="btn btn-sm btn-primary"
                            style="width:50px;margin-left:auto;margin-right:-12px">Save</button>
                    </div>
                </div>
            </div>
            <form method="post" action="{{ route('edit.pgp', ['user' => $user->id]) }}" class="col-md-6 col-lg-6">
                @csrf
                <label class="mb-2 text-white" style="font-size:18px;text-decoration:underline">PGP & 2FA</label>
                <div class="row mb-3 d-flex align-items-center">
                    <label class="col-sm-4 col-form-label text-start" for="status">Activate 2FA</label>
                    <div class="col-sm-8">
                        <div class="form-switch d-flex align-items-center justify-content-between">
                            <input class="form-check-input form-control-md" type="checkbox" id="c5" name="two_factor"
                                value="2fa" style="width:3em;height:2em" @if($user->two_factor=='1') checked @endif>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label text-start">PGP Key</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="pgpkey" name="pgpkey"
                            placeholder="PGP Key">{{ $user->pgp_key }}</textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <button class="btn btn-sm btn-primary" type="submit"
                        style="width:50px;margin-left:auto;margin-right:12px">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop