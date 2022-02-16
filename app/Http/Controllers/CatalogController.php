<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Http\Requests\StoreCatalogRequest;
use App\Http\Requests\UpdateCatalogRequest;
use Validator;
use Illuminate\Http\UploadedFile;

class CatalogController extends Controller
{
   
    public function index()
    {
        return Catalog::all();
    }

    public function store(StoreCatalogRequest $request)
    {

        $rules = [
            'name' => 'required|min:3|max:50',
            'discription' => 'required|min:3|max:255',
            'folder_id' => 'required',
            'extension_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $catalog = new Catalog();
        //$catalog->name = $request->name;
        $catalog->discription = $request->discription;
        $catalog->folder_id = $request->folder_id;
        $catalog->extension_id = $request->extension_id;
        if($request->hasFile('photo')){
            $path = $request->photo->store('image');
        }
        $catalog->name = $path;  
        $catalog->save();
        return response()->json($catalog, 201);
    }

    public function show($id)
    {
        $catalog = Catalog::find($id);
        if(is_null($catalog)){
            return  response()->json(['message' => 'Record not found!'], 404);
        }
        return response()->json($catalog, 200);
    }

    public function update(UpdateCatalogRequest $request, $id)
    {

        $rules = [
            'name' => 'required|min:3|max:50',
            'discription' => 'required|min:3|max:255',
            'folder_id' => 'required',
            'extension_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $catalog = Catalog::find($id);
        if(is_null($catalog)){
            return  response()->json(['message' => 'Record not found!'], 404);
        }
        $catalog->name = $request->name;
        $catalog->discription = $request->discription;
        $catalog->folder_id = $request->folder_id;
        $catalog->extension_id = $request->extension_id;
        $catalog->save();
        return response()->json($catalog, 200);
    }

   
    public function destroy($id)
    {
        $catalog = Catalog::find($id);
        if(is_null($catalog)){
            return  response()->json(['message' => 'Record not found!'], 404);
        }
        return response()->json(null, 204);
    }
}
