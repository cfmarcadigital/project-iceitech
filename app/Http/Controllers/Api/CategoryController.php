<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\Category as CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        if (sizeof($categories) == 0) {
            return $this->sendError(
                $this->noRecords(),
                'No existen categorias registradas.',
                901
            );
        }

        return $this->sendResponse(
            CategoryResource::collection($categories), 
            'Se encontraron registrados '.sizeof($categories).' categorias.'
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
            'name' => 'required|unique:categories|min:3',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError(
                $validator->errors(),
                'Error de validacion.', 
                900
            );       
        }

        $category = Category::create($data);

        return $this->sendResponse(
            new CategoryResource($category), 
            'La categoria fue creada.'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        if (is_null($category)) {
            return $this->sendError(
                $this->noRecords(),
                'Categoria no encontrada.',
                902
            );
        }

        return $this->sendResponse(
            new CategoryResource($category),
            'La categoria fue encontrada.'
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|min:3',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError(
                $validator->errors(),
                'Error de validacion.', 
                900
            );       
        }

        $category->name = $data['name'];
        $category->description = $data['description'];
        $category->save();

        return $this->sendResponse(
            new CategoryResource($category), 
            'La categoria fue actualizada.'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if (is_null($category)) {
            return $this->sendError(
                $this->noRecords(),
                'Categoria no encontrada.',
                902
            );
        }
        
        $category->delete();
        return $this->sendResponse(
            new CategoryResource($category),
            'La categoria fue eliminada.'
        );
    }
}
