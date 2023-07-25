<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\Role as RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Validator;

class RoleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();        

        if (sizeof($roles) == 0) {
            return $this->sendError(
                $this->noRecords(),
                'No existen roles registrados.',
                901
            );
        }        

        return $this->sendResponse(
            RoleResource::collection($roles), 
            'Se encontraron registrados '.sizeof($roles).' roles.'
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
        ]);

        if($validator->fails()){
            return $this->sendError(
                $validator->errors(),
                'Error de validacion.', 
                900
            );       
        }

        $this->authorize('create-delete');        

        $role = Role::create($data);

        return $this->sendResponse(
            new RoleResource($role), 
            'El rol fue creado.'
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
        $role = Role::find($id);

        if (is_null($role)) {
            return $this->sendError(
                $this->noRecords(),
                'Módulo no encontrado.',
                902
            );
        }

        return $this->sendResponse(
            new RoleResource($role),
            'El rol fue encontrado.'
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
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|min:3',
        ]);

        if($validator->fails()){
            return $this->sendError(
                $validator->errors(),
                'Error de validacion.', 
                900
            );       
        }                
        
        $this->authorize('edit');

        $role->save();

        return $this->sendResponse(
            new RoleResource($role), 
            'El rol fue actualizado.'
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
        $role = Role::find($id);

        if (is_null($role)) {
            return $this->sendError(
                $this->noRecords(),
                'Módulo no encontrado.',
                902
            );
        }
        
        $this->authorize('create-delete');
                
        $role->delete();

        return $this->sendResponse(
            new RoleResource($role),
            'El rol fue eliminado.'
        );
    }
}
