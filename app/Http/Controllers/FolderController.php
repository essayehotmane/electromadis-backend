<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Http\Requests\StoreFolderRequest;
use App\Http\Requests\UpdateFolderRequest;
use Validator;

class FolderController extends Controller
{
  
    public function index()
    {
        return Folder::all();
    }

    public function store(StoreFolderRequest $request)
    {
        $rules = [
            'name' => 'required|min:3|max:50'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $folder = new Folder();
        $folder->name = $request->name;
        $folder->save();
        return response()->json($folder, 201);
    }

   
    public function show($id)
    {
        $folder = Folder::find($id);
        if(is_null($folder)){
            return  response()->json(['message' => 'Record not found!'], 404);
        }
        return response()->json($folder, 200);
    }

    public function update(UpdateFolderRequest $request, $id)
    {
        $rules = [
            'name' => 'required|min:3|max:50'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $folder = Folder::find($id);
        if(is_null($folder)){
            return  response()->json(['message' => 'Record not found!'], 404);
        }
        $folder->name = $request->name;
        $folder->save();
        return response()->json($folder, 200);
    }

    public function destroy($id)
    {
        $folder = Folder::find($id);
        if(is_null($folder)){
            return  response()->json(['message' => 'Record not found!'], 404);
        }
        return response()->json(null, 204);
    }
}
