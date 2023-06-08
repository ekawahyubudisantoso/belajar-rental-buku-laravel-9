<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('role_id', 2)->where('status', 'active')->get();

        return view('dashboard.users.index', [
            'users' => $user,
        ]);
    }

    public function registered()
    {
        $user = User::where('role_id', 2)->where('status', 'inactive')->get();

        return view('dashboard.users.registered', [
            'users' => $user,
        ]);
    }

    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();
        
        return view('dashboard.users.show', [
            'user' => $user,
        ]);
    }

    public function approve($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->status = 'active';
        $user->save();

        return redirect('/dashboard/users/detail/'.$slug)->with('success', 'User has been approved!');
    }

    public function destroy($slug)
    {
        $sofdelUser = User::where('slug', $slug)->first();
        $sofdelUser->delete();

        return redirect('/dashboard/users')->with('success', 'User has been banned!');
    }

    public function banned()
    {
        return view('dashboard.users.banned', [
            'users' => User::onlyTrashed()->get()
        ]);
    }

    public function restore($slug)
    {
        $restoreUser = User::withTrashed()->where('slug', $slug)->first();
        $restoreUser->restore();

        return redirect('/dashboard/users')->with('success', 'User has been restored!');
    }

    public function forceDelete($slug)
    {
        $forcdelUser = User::withTrashed()->where('slug', $slug)->first();
        $forcdelUser->forceDelete();

        return redirect('/dashboard/users/deleted')->with('success', 'User has been force deleted!');
    }
}
