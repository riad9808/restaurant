<?php

namespace App\Http\Controllers;

use App\user;
use Illuminate\Http\Request;

class userControl extends Controller
{
    public function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function store(Request $request)
    {
        //
        $user =new user;
        $user->username=$request->get('username');
        $user->fullname=$request->get('fullname');
        $user->telephone=$request->get('telephone');
        $p=$request->get('password');
        $storedsalt=self::generateRandomString(rand(100, 200));
        $user->salt=$storedsalt;
        $localsalt='thisisthesaltthatisusedfortheedlprojectrestaurantappfrombbt';
        $user->password= hash('sha512',$storedsalt.$p.$localsalt);
        $user->type=$request->get('type');
        $x=user::where('username',$request->get('username'))->count();
        $y=user::where('telephone',$request->get('telephone'))->count();
        if($x>=1||$y>=1){
            return json_encode( false);
        }
        $user->save();

        return json_encode( true);
    }



    public function signin(Request $request)
    {
        $localsalt='thisisthesaltthatisusedfortheedlprojectrestaurantappfrombbt';

        $usname=$request->get('username');
        $p=$request->get('password');

        $size=user::where('username',$usname)->count();

        if($size==1){

            $pass=user::where('username',$usname)->pluck('password');
            $storedsalt=user::where('username',$usname)->pluck('salt')[0];
            $hashedpass=hash('sha512',$storedsalt.$p.$localsalt);
            if($pass[0]===$hashedpass){
                return json_encode(user::where('username',$usname)->pluck('type')[0]);
            }
            else{
                return json_encode('erreur');
            }

        }

    }
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
    /**
     * Display the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        //
    }
    public function show(user $user)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        //
    }
}
