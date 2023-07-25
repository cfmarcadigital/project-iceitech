<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;
use Validator;

class FileUploadController extends Controller
{
    public function uploadImage(Request $request)
    {
       $validator = Validator::make($request->all(),[ 
              'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);   
 
        if($validator->fails()) {          
            
            return response()->json(['error'=>$validator->errors()], 401);                        
         }  
 
  
        if ($file = $request->file('file')) {
            $path = $file->store('/images');
            $name = $file->getClientOriginalName();
 
            //store your file into directory and db
            $save = new File();
            $save->name = $name;
            $save->path= $path;
            $save->save();
              
            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $file
            ]);
  
        }
    }
}
