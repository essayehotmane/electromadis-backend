<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function show($id)
    {
        $user = User::find($id);
        if(is_null($user)){
            return  response()->json(['message' => 'Record not found!'], 404);
        }
        return response()->json($user, 200);
    }

    public function update(Request $request, $id)
    {

        $user = User::find($id);
        if(is_null($user)){
            return  response()->json(['message' => 'Record not found!'], 404);
        }
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->mac = $request->mac;
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
        $user->role_id = $request->role_id;
        $user->save();
        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if(is_null($user)){
            return  response()->json(['message' => 'Record not found!'], 404);
        }
        return response()->json(null, 204);
    }
}
