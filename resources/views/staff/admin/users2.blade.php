@extends('master.main')
@section('content')

<title>Admin Users - Squid Market</title>
@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')

@include('includes.components.menustaff')

<div class="content-profile container">
    <div class="h3">All users ({{ $totalUsers }})</div>
    <form action="{{ route('admin.users', ['username' => $username, 'role' => $role]) }}" method="GET" class="mt-10">
        <div class="inblock">
            <label for="username">username:</label>
            <input type="text" id="username" name="username" value="{{ $username }}">
        </div>
        <div class="inblock">
            <label for="role">role</label>
            <select id="role" name="role" class="dropdown-wrapper">
                <option value="all" @if($role=='all' ) selected @endif>all</option>
                <option value="seller" @if($role=='seller' ) selected @endif>seller</option>
                <option value="moderator" @if($role=='moderator' ) selected @endif>moderator</option>
                <option value="admin" @if($role=='admin' ) selected @endif>admin</option>
            </select>
        </div>
        <div class="inblock">
            <button type="submit">filter</button>
        </div>
    </form>
    <table class="zebra mt-10" style="width: 100%; text-align: center">
        <thead>
            <tr>
                <th>username</th>
                <th>seller</th>
                <th>moderator</th>
                <th>admin</th>
                <th>last login</th>
                <th>completed orders</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td @if($user->ban==1) style='color:red' @endif>{{ $user->username }}</td>
                <td><strong>{{ $user->isSeller() ? 'yes' : 'no' }}</strong></td>
                <td><strong>{{ $user->isModerator() ? 'yes' : 'no' }}</strong></td>
                <td><strong>{{ $user->isAdmin() ? 'yes' : 'no' }}</strong></td>
                <td>{{ $user->lastLogin() }}</td>
                <td>{{ $user->totalOrdersCompleted() }}</td>
                <td><button><a href="{{ route('admin.user', ['user' => $user->id]) }}" class="button">Edit
                            User</a></button><br>
                    @if($user->ban==0)
                    <button><a href="{{ route('banreason', ['user' => $user->id, 'ban' => 1]) }}" class="button">Ban
                            User</a></button>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">Looks like there aren't any users around here!</td>
            </tr>
            @endforelse
            <tr>
                <td colspan="7">{{ $users->appends($filters)->links('includes.components.pagination') }}</td>
            </tr>
        </tbody>
    </table>
</div>

@stop