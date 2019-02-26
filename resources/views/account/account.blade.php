@extends('layouts/app')

@section('content')
    <div class="account__container">
        <div class="account__page-info">
            <div class="account__page-top"></div>
            <div class="avatar__account">
                <img src="{{'/img/'.$users->avatar}}" class="avatar-img" alt="">
            </div>
            <div class="account__page-bottom">
                <a href="/users/{{$users->username}}" class="account__item-info">
                    <strong>Tweets</strong>
                    <p class="number">{{$countTweet}}</p>
                </a>
                <a href="/users/{{$users->username}}/following" class="account__item-info">
                    <strong>Abonnements</strong>
                    <p class="number"></p>
                </a>
                <a href="/users/{{$users->username}}/followers" class="account__item-info">
                    <strong>Abonnés</strong>
                    <p class="number"></p>
                </a>
                @if(Auth::user()->username != $users->username)
                        <a href="/user/{{$users->id}}/follow" class="btn__follow-account">follow</a>
                        <a href="/{{$users->id}}/unfollow" class="btn__follow-account">unfollow</a>
                @else
                    <a href="/edit-account" class="btn__edit-account">Edit profil</a>
                @endif
            </div>
        </div>
        <div class="content__account">
            <div class="timeline__account">
                @yield('content-account')
            </div>
        </div>
    </div>
@endsection