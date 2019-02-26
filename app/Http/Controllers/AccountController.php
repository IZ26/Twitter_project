<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tweet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use File;
use function Sodium\compare;


class AccountController extends Controller
{
    public function getUsers(Request $req, User $user)
    {
        $users = $user->get();
        return view('users.users', compact('users'));
    }

    public function account(Request $req, User $user, Tweet $tweet)
    {
        $users = $user->where('username', $req->username)->firstOrFail();
        $tweets = $tweet->where('users_id', $users->id)->get();
        $countTweet = count($tweets);
        return view('account.account-timeline', compact("users", 'tweets', 'countTweet'));
    }

    public function getFollowers(Request $req, User $user)
    {
        $users = $user->where('username', $req->username)->firstOrFail();
        return view('account.account-followers', compact('users'));
    }

    public function getFollowings(Request $req, User $user)
    {
        $users = $user->where('username', $req->username)->firstOrFail();
        return view('account.account-following', compact('users'));
    }

    public function editAccount(User $user)
    {
        $user = $user->where('id', Auth::user()->id)->first();
        return view('account.edit-account', compact('user'));
    }

    public function editUserInfo(Request $request, User $user)
    {
        request()->validate([
            'username' => 'required',
            'email' => 'required',
        ]);

        $avatar = $request->avatar;
        Storage::disk('public')->put($avatar->getClientOriginalName(), File::get($avatar));
        $user = $user->where('id', Auth::user()->id)->first();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->avatar = $avatar->getClientOriginalName();
        $user->save();

        return redirect('/');
    }

    public function followUser($id)
    {
        $user = User::find($id);
        $user->followers()->attach(auth()->user()->id);
        $isFollowing = 1;
        return redirect("/users/". $user->username)->with('isFollowing');
    }
    public function unfollowUser($id)
    {
        $user = User::find($id);
        $user->followers()->detach(auth()->user()->id);

        return redirect()->back();
    }
}