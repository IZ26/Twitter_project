@extends('account.account')

@section('content-account')
    <div class="timeline-account">
        @foreach($tweets as $t)
            <div class="tweet__container">
                <div class="avatar__tweet-timeline">
                    <img src="{{'/img/'.$users->avatar}}" class="avatar-img" alt="">
                </div>
                <div class="tweet__content">
                    <p class="username"> {{$users->username}} - <span class="tweet__time"> il y a 1h</span>
                    </p>
                    <p class="tweet">{{$t->tweet}}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection