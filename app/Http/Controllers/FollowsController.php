<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function store($id){
        $user=User::where('id',$id)->firstOrFail();
        return auth()->user()->following()->toggle($user->profile);

    }
}
