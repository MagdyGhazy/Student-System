<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\Headquarters\FindHeadquarterIdRequest;
use App\Http\Requests\System\Headquarters\StoreHeadquarterRequest;
use App\Http\Requests\System\Headquarters\UpdateHeadquarterRequest;
use App\MainClasses\CRUD\SystemCRUD;
use App\Models\Headquarter;

class HeadquarterController extends Controller
{
    protected $systemCRUD;
    public function __construct(Headquarter $model)
    {
        $this->systemCRUD = new SystemCRUD($model);
    }

    public function index()
    {
        return  $this->systemCRUD->index();
    }

    public function getOne(FindHeadquarterIdRequest $id)
    {
        return $this->systemCRUD->getOne($id);
    }

    public function store(StoreHeadquarterRequest $request)
    {
        return  $this->systemCRUD->store($request);
    }

    public function update(UpdateHeadquarterRequest $request)
    {
        return  $this->systemCRUD->update($request);
    }

    public function delete(FindHeadquarterIdRequest $id)
    {
        return $this->systemCRUD->delete($id);
    }
}


