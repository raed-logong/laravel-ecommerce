<?php

namespace App\Http\Controllers;

use App\Notifications\UserPosted;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Intervention\Image\Facades\Image;
use function Sodium\add;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('my-profile')->with('user', auth()->user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request->all());





        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.auth()->id(),
            'password' => 'sometimes|nullable|string|min:6|confirmed',
            'image'=>'image',
        ]);
        $imagepath=$request->image->store('profiles','public');
        $avatarimage=$request->image->store('users','public');
        $request->image=$imagepath;
        $img = Image::make($request->file('image')->getRealPath())->fit(100,100);

        $img=$img->save(public_path('storage/'.$avatarimage));

        $user = auth()->user();
        $profile=$user->profile;
        $input1 = $request->except('password', 'password_confirmation',
                                'address','description','image');
        $input1=array_merge($input1,['avatar'=>'users/'.$img->basename]);


        //dd();
        $input2=$request->except('password','password_confirmation','name',
            'email');
        if (! $request->filled('password')) {

            $user->fill($input1)->save();


            $profile->fill($input2);
            $profile->image=$imagepath;
            $profile->save();


            return back()->with('success_message', 'Profile updated successfully!');
        }

        $user->password = bcrypt($request->password);
        $user->fill($input1)->save();
        $profile->fill($input2);
        $profile->image=$imagepath;
        $profile->save();

        return back()->with('success_message', 'Profile (and password) updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function markasread($id){
        foreach (auth()->user()->unreadNotifications as $notification){
            if($notification->id==$id){
                $notification->markAsRead();
            }
        }

    }
}
