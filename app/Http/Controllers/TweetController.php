<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use App\User;
use Illuminate\Support\Facades\Auth;


class TweetController extends Controller
{
    public function create(Request $req, Tweet $tweet){
        $data = [
            'users_id' => Auth::user()->id,
            'tweet' => $req->tweet
        ];
        $tweet->users_id  = $data['users_id'];
        $tweet->tweet = $data["tweet"];
        $tweet->save();
        return redirect()->back();
    }
    public function getTweets(Tweet $tweet, User $user){
        $tweets = $tweet->orderBy('created_at', 'desc')->where('users_id', Auth::user()->id)->get();
        $users = $user->where('id', Auth::user()->id)->first();
        $countTweets = count($tweets);
        return view('timeline.timeline', compact('tweets', 'users', 'countTweets'));
    }
}
