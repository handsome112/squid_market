@extends('staff.admin.adminmain')
@section('content')
<title>Admin Settings - Squid Market</title>

<div class="bg-primary text-center rounded p-2 mx-4 mt-4">
    <h4 class="mb-0" style="color:white">Settings</h4>
</div>
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <form action="{{ route('put.admin.dashboard') }}" class="d-flex mb-4 row" id="adminsettings" method="post">
            @csrf
            @method('PUT')
            <div class="col-sm-12 col-md-6 col-xl-4">
                <span>Fee to become a seller</span>
                <input class="form-control bg-dark border-0" type="text" placeholder="Set fee to become a seller"
                    id="seller_fee" name="seller_fee" value="{{ $sellerFee }}">
                @error('seller_fee')
                <div class="error">
                    <small class="text-danger">{{ $errors->first('seller_fee') }}</small>
                </div>
                @enderror
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4">
                <span>Dread forum</span>
                <input class="form-control bg-dark border-0" type="text" placeholder="Set dread forum link"
                    id="dread_forum_link" name="dread_forum_link" value="{{ $dreadForumLink }}">
                @error('dread_forum_link')
                <div class="error">
                    <small class="text-danger">{{ $errors->first('dread_forum_link') }}</small>
                </div>
                @enderror
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4">
                <span>Wiki</span>
                <input class="form-control bg-dark border-0" type="text" placeholder="Set wiki link" id="wiki_link"
                    name="wiki_link" value="{{ $wikiLink }}">
                @error('wiki_link')
                <div class="error">
                    <small class="text-danger">{{ $errors->first('wiki_link') }}</small>
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-warning mt-4" style="width:200px;margin-left:auto">Change
                Settings</button>
        </form>
        <hr>
        <form method="post" action="" class="d-flex row mb-4">
            <div class="col-sm-12 col-md-6 col-xl-6 d-flex">
                <span class="text-start text-light" style="width:30%">Admin PGP Key</span>
                <textarea class="form-control" rows="5" style="width:70%" id="adminpgpkey" name="adminpgpkey"
                    placeholder="PGP Key"></textarea>
                @error('adminpgpkey')
                <div class="error">
                    <small class="text-danger">{{ $errors->first('adminpgpkey') }}</small>
                </div>
                @enderror
            </div>
            <div class="col-sm-12 col-md-6 col-xl-6 d-flex">
                <span class="text-start text-light" style="width:30%">Moderator PGP Key</span>
                <textarea class="form-control" rows="5" style="width:70%" id="mpgpkey" name="mpgpkey"
                    placeholder="PGP Key"></textarea>
                @error('mpgpkey')
                <div class="error">
                    <small class="text-danger">{{ $errors->first('mpgpkey') }}</small>
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-warning mt-4" style="width:200px;margin-left:auto">Update PGP
                Keys</button>
        </form>
        <hr>
        <form method="post" action="" class="d-flex row mb-4">
            <span class="text-start text-light" style="width:15%">Canary</span>
            <textarea class="form-control" rows="5" style="width:85%" id="canary" name="canary"
                placeholder="Canary"></textarea>
            @error('canary')
            <div class="error">
                <small class="text-danger">{{ $errors->first('canary') }}</small>
            </div>
            @enderror
            <button type="submit" class="btn btn-warning mt-4" style="width:200px;margin-left:auto">Update
                Canary</button>
        </form>
        <hr>
        <div>
            <div class="info-wrapper inblock mt-40">
                <div class="info-folder">
                    <div class="info-message" style="color: #E80000; border-color: #E80000; background-color: #FFE3E3">
                        <strong>Exit Button is highly dangerous!</strong> If you click on it, money from the market is
                        sent
                        to users' backup wallets. In addition to transferring all the money, this button will delete all
                        conversations and messages in the database.
                    </div>
                </div>
            </div>
            <form action="{{ route('post.admin.exitbutton') }}" method="post" class="inblock">
                @csrf
                <button type="submit" class="btn btn-primary ms-2 mt-4">EXIT BUTTON</button>
            </form>
        </div>
    </div>
</div>

@stop