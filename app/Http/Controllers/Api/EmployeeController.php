<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\Api\FileUploadController;
use App\Http\Resources\Employee as EmployeeResource;
use App\Models\File;
use App\Models\Employee;
use Illuminate\Http\Request;
use Storage;
use Validator;

class EmployeeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();

        if (sizeof($employees) == 0) {
            return $this->sendError(
                $this->noRecords(),
                'No existen empleados registrados.',
                901
            );
        }

        return $this->sendResponse(
            EmployeeResource::collection($employees), 
            'Se encontraron registrados '.sizeof($employees).' empleados.'
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
            'type' => 'required',
            'name' => 'required|min:10',
            'email' => 'required|email|unique:employees',
            'profession' => 'required',
            'description' => 'required',
            'linkedin' => 'required|unique:employees|min:10',
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
            $path = $file->store('images');
            $name = $file->getClientOriginalName();
  
            $image = new File();
            $image->name = $name;
            $image->path = $path;
            $image->save();
        }

        if(asset($image->id)){
            $data['image_id'] = $image->id;
            $employee = Employee::create($data);
        }        

        return $this->sendResponse(
            new EmployeeResource($employee), 
            'El empleado fue creado.'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);

        if (is_null($employee)) {
            return $this->sendError(
                $this->noRecords(),
                'Empleado no encontrado.',
                902
            );
        }

        return $this->sendResponse(
            new EmployeeResource($employee),
            'El empleado fue encontrado.'
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'type' => 'required',
            'name' => 'required|min:10',
            'email' => 'required|email',
            'profession' => 'required',
            'description' => 'required',
            'github' => 'required|min:10',
            'linkedin' => 'required|min:10',
        ]);

        if($data['type'] == 1)
            $validator = Validator::make($data, [
                'github' => 'required|min:10',
            ]);

        if($validator->fails()){
            return $this->sendError(
                $validator->errors(),
                'Error de validacion.', 
                900
            );       
        }        
        
        $image = File::find($employee['image_id']);

        if ($file = $request->file('image')) {
            Storage::disk()->delete($image->path);
            $path = $file->store('images');
            $name = $file->getClientOriginalName();
  
            $image->name = $name;
            $image->path = $path;
            $image->save();
        }

        if(asset($image->image_id)){
            $employee->type = $data['type'];
            $employee->name = $data['name'];
            $employee->email = $data['email'];
            $employee->profession = $data['profession'];
            $employee->description = $data['description'];
            $employee->github = $data['github'];
            $employee->linkedin = $data['linkedin'];
        }

        $this->authorize('edit');

        $employee->save();

        return $this->sendResponse(
            new EmployeeResource($employee), 
            'El empleado fue actualizado.'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);

        if (is_null($employee)) {
            return $this->sendError(
                $this->noRecords(),
                'Empleado no encontrado.',
                902
            );
        }
        
        $image = $employee->image;        

        $this->authorize('create-delete');
        
        Storage::disk()->delete($image->path);
        $image->delete();
        $employee->delete();

        return $this->sendResponse(
            new EmployeeResource($employee),
            'El empleado fue eliminado.'
        );
    }
}
