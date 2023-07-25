<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\Module as ModuleResource;
use App\Models\Module;
use Illuminate\Http\Request;
use Validator;

class ModuleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = Module::all();        

        if (sizeof($modules) == 0) {
            return $this->sendError(
                $this->noRecords(),
                'No existen módulos registrados.',
                901
            );
        }        

        return $this->sendResponse(
            ModuleResource::collection($modules), 
            'Se encontraron registrados '.sizeof($modules).' módulos.'
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
            'content' => 'required',
            'description' => 'required',
            'course_id' => 'required|numeric',
        ]);

        if($validator->fails()){
            return $this->sendError(
                $validator->errors(),
                'Error de validacion.', 
                900
            );       
        }

        $this->authorize('create-delete');        

        $module = Module::create($data);

        return $this->sendResponse(
            new ModuleResource($module), 
            'El módulo fue creado.'
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
        $module = Module::find($id);

        if (is_null($module)) {
            return $this->sendError(
                $this->noRecords(),
                'Módulo no encontrado.',
                902
            );
        }

        return $this->sendResponse(
            new ModuleResource($module),
            'El módulo fue encontrado.'
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
    public function update(Request $request, Module $module)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|min:3',
            'content' => 'required',
            'description' => 'required',
            //'course_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError(
                $validator->errors(),
                'Error de validacion.', 
                900
            );       
        }

        $module->name = $data['name'];
        $module->content = $data['content'];
        $module->description = $data['description'];        
        if(isset($data['course_id']))
            $module->course_id = $data['course_id'];
        
        $this->authorize('edit');

        $module->save();

        return $this->sendResponse(
            new ModuleResource($module), 
            'El módulo fue actualizado.'
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
        $module = Module::find($id);

        if (is_null($module)) {
            return $this->sendError(
                $this->noRecords(),
                'Módulo no encontrado.',
                902
            );
        }
        
        $this->authorize('create-delete');
                
        $module->delete();

        return $this->sendResponse(
            new ModuleResource($module),
            'El módulo fue eliminado.'
        );
    }
}
