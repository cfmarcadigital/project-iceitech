<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\Video as VideoResource;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Validator;

class VideoController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::all();

        if (sizeof($videos) == 0) {
            return $this->sendError(
                $this->noRecords(),
                'No existen videos registrados.',
                901
            );
        }

        return $this->sendResponse(
            VideoResource::collection($videos), 
            'Se encontraron registrados '.sizeof($videos).' videos.'
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
            'title' => 'required|min:3',
            'description' => 'required',
            'url' => 'required|unique:videos|min:10',
            'user_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError(
                $validator->errors(),
                'Error de validacion.', 
                900
            );       
        }

        $user = User::find($data['user_id']);        

        if($user == null){
            return $this->sendError(
                $this->noUsers(),
                'El usuario no fue encontrado.', 
                901
            );       
        }

        $this->authorize('create-delete');

        /*if($this->authorize('create-delete')){
            return $this->sendError(
                $this->noPermissions(),
                'El usuario no tiene permisos.', 
                902
            ); 
        }*/

        $video = Video::create($data);

        return $this->sendResponse(
            new VideoResource($video), 
            'El video fue creado.'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = Video::find($id);

        if (is_null($video)) {
            return $this->sendError(
                $this->noRecords(),
                'Video no encontrado.',
                902
            );
        }

        return $this->sendResponse(
            new VideoResource($video),
            'El video fue encontrado.'
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => 'required|min:3',
            'description' => 'required',
            'url' => 'required|min:10',
            'user_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError(
                $validator->errors(),
                'Error de validacion.', 
                900
            );       
        }

        if($video['id'] == null){
            return $this->sendError(
                $this->noRecords(),
                'El video no fue encontrado.', 
                901
            );       
        }

        $video->title = $data['title'];
        $video->description = $data['description'];
        $video->url = $data['url'];
        if(isset($data['user_id']))
            $video->user_id = $data['user_id'];
        
        $this->authorize('edit');

        $video->save();

        return $this->sendResponse(
            new VideoResource($video), 
            'El video fue actualizado.'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::find($id);

        if (is_null($video)) {
            return $this->sendError(
                $this->noRecords(),
                'Video no encontrado.',
                902
            );
        }
        
        $this->authorize('create-delete');

        $video->delete();

        return $this->sendResponse(
            new VideoResource($video),
            'El video fue eliminado.'
        );
    }
}
