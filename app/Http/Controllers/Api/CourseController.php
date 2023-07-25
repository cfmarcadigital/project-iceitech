<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\Api\FileUploadController;
use App\Http\Resources\Course as CourseResource;
use App\Models\Course;
use App\Models\File;
use Illuminate\Http\Request;
use Storage;
use Validator;

class CourseController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();

        if (sizeof($courses) == 0) {
            return $this->sendError(
                $this->noRecords(),
                'No existen cursos registrados.',
                901
            );
        }

        return $this->sendResponse(
            CourseResource::collection($courses), 
            'Se encontraron registrados '.sizeof($courses).' cursos.'
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
            'name' => 'required|min:3',
            'module_duration' => 'required|min:1',
            'description' => 'required',
            'link' => 'required',
            'requirements' => 'required',
            'modality' => 'required',
            'schedules' => 'required',
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required',
        ]);
        
        if($validator->fails()){
            return $this->sendError(
                $validator->errors(),
                'Error de validacion.', 
                900
            );       
        }

        $this->authorize('create-delete');

        if ($file = $request->file('image')) {
            $path = $file->store('public/images');
            $name = $file->getClientOriginalName();
  
            $image = new File();
            $image->name = $name;
            $image->path = $path;
            $image->save();
        }

        if(asset($image->id)){
            $data['image_id'] = $image->id;
            $course = Course::create($data);
        }        

        return $this->sendResponse(
            new CourseResource($course), 
            'El curso fue creado.'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);

        if (is_null($course)) {
            return $this->sendError(
                $this->noRecords(),
                'Curso no encontrado.',
                902
            );
        }

        return $this->sendResponse(
            new CourseResource($course),
            'El curso fue encontrado.'
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|min:3',
            'module_duration' => 'required|min:1',
            'description' => 'required',
            'link' => 'required',
            'requirements' => 'required',
            'modality' => 'required',
            'schedules' => 'required',
            'category_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError(
                $validator->errors(),
                'Error de validacion.', 
                900
            );       
        }        
        
        $image = File::find($course['image_id']);

        if ($file = $request->file('image')) {
            Storage::disk()->delete($image->path);
            $path = $file->store('public/images');
            $name = $file->getClientOriginalName();
  
            $image->name = $name;
            $image->path = $path;
            $image->save();
        }

        if(asset($image->image_id)){
            $course->name = $data['name'];
            $course->module_duration = $data['module_duration'];
            $course->description = $data['description'];
            $course->link = $data['link'];
            $course->requirements = $data['requirements'];
            $course->modality = $data['modality'];
            $course->schedules = $data['schedules'];
            $course->category_id = $data['category_id'];
        }

        $this->authorize('edit');

        $course->save();

        return $this->sendResponse(
            new CourseResource($course), 
            'El curso fue actualizado.'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);

        if (is_null($course)) {
            return $this->sendError(
                $this->noRecords(),
                'Curso no encontrado.',
                902
            );
        }
        
        $image = $course->image;        

        $this->authorize('create-delete');
        
        Storage::disk()->delete($image->path);
        $image->delete();
        $course->delete();

        return $this->sendResponse(
            new CourseResource($course),
            'El curso fue eliminado.'
        );
    }
}
