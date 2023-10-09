<?php

namespace App\Services\CRUD;

use App\Models\Question;

class SystemCRUDService
{
    protected $model;
    public function __construct($model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $data = $this->model::all();
        return response()->json([
            "message" => "success",
            "data" => $data
        ]);
    }

    public function getOne($id)
    {
        $data = $this->model::find($id);
        return response()->json([
            "message" => "success",
            "data" => $data
        ]);
    }

    public function store($request)
    {
        $request = $request->all();
        $data = $this->model::create($request);
        return response()->json([
            "message" => "success",
            "data" => $data
        ]);
    }

    public function update($request)
    {
        $data = $this->model::find($request->id);
        $request = $request->all();
        $data->update($request);
        return response()->json([
            "message" => "success",
            "data" => $data
        ]);
    }

    public function delete($request)
    {
        $data = $this->model::find($request->id);
        $data->delete();
        return response()->json([
            "message" => "success",
        ]);
    }
}
