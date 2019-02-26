@extends('layouts.app')

@section('content')
    <section class="home">
        <article class="account__container">
            <div class="account__top"></div>
            <div class="avatar__container">
                <img src="{{'/img/'. $users->avatar}}" class="avatar-img" alt="">
            </div>
            <div class="account__bottom">
                <div class="account__info">
                    <a  href="/users/{{$users->username}}" class="username"> {{Auth::user()->username}} </a>
                </div>
                <div class="account__activity">
                    <div class="account__activity-info">
                        <strong>Tweets</strong>
                        <p>{{$countTweets}}</p>
                    </div>
                    <div class="account__activity-info">
                        <strong>Abonnements</strong>
                        <p></p>
                    </div>
                    <div class="account__activity-info">
                        <strong>Abonnés</strong>
                        <p></p>
                    </div>
                </div>
            </div>
        </article>
        <article class="timeline__container">
            <div class="tweet__form">
                <div class="avatar__tweet">
                    <img src="{{'/img/'. $users->avatar}}" class="avatar-img" alt="">
                </div>
                <form action="/tweet" method="post" class="form">
                    {{csrf_field()}}
                    <div>
                        <label for="tweet"></label>
                        <textarea class="tweet__input" id="tweet" name="tweet" placeholder="Votre tweet..."></textarea>
                    </div>
                    <input class="btn__tweet" type="submit" value="tweeter"/>
                </form>
            </div>
            <div class="timeline">
                @foreach($tweets as $t)
                    <div class="tweet__container">
                        <div class="avatar__tweet-timeline">
                            <img src="{{'/img/'. $users->avatar}}" class="avatar-img" alt="">
                        </div>
                        <div class="tweet__content">
                            <a href="/users/{{$users->username}}" class="username">{{Auth::user()->username}}</a> <span class="tweet__time"> - {{$t->created_at->diffForHumans()}}</span>
                            <p class="tweet">{{$t->tweet}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </article>
    </section>
@endsection
