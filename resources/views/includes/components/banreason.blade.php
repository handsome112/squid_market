@extends('master.main')
@section('no-content')

<title>Confirm Ban - Squid Market</title>

<details class="dark" open>
    <summary>
        <div class="details-modal-overlay"></div>
    </summary>
    <div class="details-modal modal-sm">
        <div class="details-modal-title" style="font-size:30px;text-decoration:none;margin-top:10px">Input reason that
            ban this User!</div>
        <div class="details-modal-content">
            <form action="{{ route('ban.user', ['user' => $user->id]) }}" method="post">
                @csrf
                <textarea class="form-control mb-3" style="height: 250px;" name="banreason"></textarea>
                @error('banreason')
                <p class="text-danger">{{ $errors->first('banreason') }}</p>
                @enderror
                <div class="d-flex justify-content-around mb-1">
                    <button type="submit" class="btn btn-success">Confirm</button>
                    <a href="{{ route('admin.users') }}" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</details>

@stop