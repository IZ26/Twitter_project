@extends('layouts.app')

@section('content')
    <div class="users_container">
        @foreach( $users as $u)
            @if(Auth::user()->username != $u->username)
                <div class="users">
                    <div class="avatar__users">
                        <img src="{{'/img/'. $u->avatar}}" class="avatar-img" alt="">
                    </div>
                    <a href="/users/{{$u->username}}" class="user_name">{{$u->username}}</a>
                </div>
            @endif
        @endforeach
    </div>
@endsection