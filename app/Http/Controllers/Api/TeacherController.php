<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\Teacher as TeacherResource;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Validator;

class TeacherController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::all();

        if (sizeof($teachers) == 0) {
            return $this->sendError(
                $this->noRecords(),
                'No existen docentes registrados.',
                901
            );
        }

        return $this->sendResponse(
            TeacherResource::collection($teachers), 
            'Se encontraron registrados '.sizeof($teachers).' docentes.'
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
            'name' => 'required|min:10',
            'email' => 'required|email|unique:teachers',
            'profession' => 'required',
            'description' => 'required',
            'github' => 'required|unique:teachers|min:10',
            'linkedin' => 'required|unique:teachers|min:10',
        ]);

        if($validator->fails()){
            return $this->sendError(
                $validator->errors(),
                'Error de validacion.', 
                900
            );       
        }

        $this->authorize('create-delete');

        $teacher = Teacher::create($data);

        return $this->sendResponse(
            new TeacherResource($teacher), 
            'El docente fue creado.'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacher = Teacher::find($id);

        if (is_null($teacher)) {
            return $this->sendError(
                $this->noRecords(),
                'Docente no encontrado.',
                902
            );
        }

        return $this->sendResponse(
            new TeacherResource($teacher),
            'El docente fue encontrado.'
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|min:10',
            'email' => 'required|email',
            'profession' => 'required',
            'description' => 'required',
            'github' => 'required|min:10',
            'linkedin' => 'required|min:10',
        ]);

        if($validator->fails()){
            return $this->sendError(
                $validator->errors(),
                'Error de validacion.', 
                900
            );       
        }

        $teacher->name = $data['name'];
        $teacher->email = $data['email'];
        $teacher->profession = $data['profession'];
        $teacher->description = $data['description'];
        $teacher->github = $data['github'];
        $teacher->linkedin = $data['linkedin'];
        
        $this->authorize('edit');

        $teacher->save();

        return $this->sendResponse(
            new TeacherResource($teacher), 
            'El docente fue actualizado.'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = Teacher::find($id);

        if (is_null($teacher)) {
            return $this->sendError(
                $this->noRecords(),
                'Docente no encontrado.',
                902
            );
        }
        
        $this->authorize('create-delete');

        $teacher->delete();

        return $this->sendResponse(
            new TeacherResource($teacher),
            'El docente fue eliminado.'
        );
    }
}
