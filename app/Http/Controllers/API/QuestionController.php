<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\Questions\FindQuestionIdRequest;
use App\Http\Requests\System\Questions\StoreQuestionRequest;
use App\Http\Requests\System\Questions\UpdateQuestionRequest;
use App\Models\Question;
use App\Services\CRUD\SystemCRUDService;

class QuestionController extends Controller
{
    protected $systemCRUD;

    public function __construct(Question $model)
    {
        $this->systemCRUD = new SystemCRUDService($model);
    }


    public function index()
    {
        return  $this->systemCRUD->index();
    }

    public function getOne(FindQuestionIdRequest $id)
    {
        return $this->systemCRUD->getOne($id);
    }

    public function store(StoreQuestionRequest $request)
    {
        return  $this->systemCRUD->store($request);
    }

    public function update(UpdateQuestionRequest $request)
    {
        return  $this->systemCRUD->update($request);
    }

    public function delete(FindQuestionIdRequest $id)
    {
        return $this->systemCRUD->delete($id);
    }
}
