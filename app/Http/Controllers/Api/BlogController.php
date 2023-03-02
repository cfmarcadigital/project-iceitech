<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\Blog as BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;
use Validator;

class BlogController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();

        if (sizeof($blogs) == 0) {
            return $this->sendError(
                $this->noRecords(),
                'No existen blogs registrados.',
                901
            );
        }

        return $this->sendResponse(
            BlogResource::collection($blogs), 
            'Se encontraron registrados '.sizeof($blogs).' blogs.'
        );
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
        $data = $request->all();

        $validator = Validator::make($data, [
            /*'title' => 'required|min:3',
            'description' => 'required',
            'url' => 'required|unique:videos|min:10',
            'user_id' => 'required',*/
        ]);

        if($validator->fails()){
            return $this->sendError(
                $validator->errors(),
                'Error de validacion.', 
                900
            );       
        }

        $this->authorize('create-delete-videos');

        $blog = Blog::create($data);

        return $this->sendResponse(
            new BlogResource($blog), 
            'El blog fue creado.'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::find($id);

        if (is_null($blog)) {
            return $this->sendError(
                $this->noRecords(),
                'Blog no encontrado.',
                902
            );
        }

        return $this->sendResponse(
            new BlogResource($blog),
            'El blog fue encontrado.'
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => 'required|min:3',
            'body' => 'required',
            'image' => 'required',
            'user_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError(
                $validator->errors(),
                'Error de validacion.', 
                900
            );       
        }

        $blog->title = $data['title'];
        $blog->body = $data['body'];
        $blog->image = $data['image'];
        $blog->user_id = $data['user_id'];
        
        $this->authorize('edit');

        $blog->save();

        return $this->sendResponse(
            new BlogResource($blog), 
            'El blog fue actualizado.'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);

        if (is_null($blog)) {
            return $this->sendError(
                $this->noRecords(),
                'Blog no encontrado.',
                902
            );
        }
        
        $this->authorize('create-delete');
        
        $blog->delete();

        return $this->sendResponse(
            new BlogResource($blog),
            'El blog fue eliminado.'
        );
    }
}
