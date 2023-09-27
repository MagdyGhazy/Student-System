<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\Grades\FindGradeIdRequest;
use App\Http\Requests\System\Grades\StoreGradeRequest;
use App\Http\Requests\System\Grades\UpdateGradeRequest;
use App\MainClasses\CRUD\SystemCRUD;
use App\Models\Grade;

class GradeController extends Controller
{
    protected $systemCRUD;
    public function __construct(Grade $model)
    {
        $this->systemCRUD = new SystemCRUD($model);
    }

    public function index()
    {
      return  $this->systemCRUD->index();
    }

    public function getOne(FindGradeIdRequest $id)
    {
        return $this->systemCRUD->getOne($id);
    }

    public function store(StoreGradeRequest $request)
    {
        return  $this->systemCRUD->store($request);
    }

    public function update(UpdateGradeRequest $request)
    {
        return  $this->systemCRUD->update($request);
    }

    public function delete(FindGradeIdRequest $id)
    {
        return $this->systemCRUD->delete($id);
    }
}
