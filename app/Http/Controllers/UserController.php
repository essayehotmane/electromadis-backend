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

        $rules = [
            'fname' => 'required|min:3|max:50',
            'lname' => 'required|min:3|max:50',
            'email' => 'required|email',
            'mac' => 'required',
            'role_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $user = User::find($id);
        if(is_null($user)){
            return  response()->json(['message' => 'Record not found!'], 404);
        }
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->mac = $request->mac;
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
