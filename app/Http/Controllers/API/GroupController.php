<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\Groups\FindGroupIdRequest;
use App\Http\Requests\System\Groups\StoreGroupRequest;
use App\Http\Requests\System\Groups\UpdateGroupRequest;
use App\Services\CRUD\SystemCRUDService;
use App\Models\Group;

class GroupController extends Controller
{
    protected $systemCRUD;
    public function __construct(Group $model)
    {
        $this->systemCRUD = new SystemCRUDService($model);
    }

    public function index()
    {
        return  $this->systemCRUD->index();
    }

    public function getOne(FindGroupIdRequest $id)
    {
        return $this->systemCRUD->getOne($id);
    }

    public function store(StoreGroupRequest $request)
    {
        return  $this->systemCRUD->store($request);
    }

    public function update(UpdateGroupRequest $request)
    {
        return  $this->systemCRUD->update($request);
    }

    public function delete(FindGroupIdRequest $id)
    {
        return $this->systemCRUD->delete($id);
    }
}
