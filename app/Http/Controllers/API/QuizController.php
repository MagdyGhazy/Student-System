<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\Quizzes\FindQuizIdRequist;
use App\Http\Requests\System\Quizzes\StoreQuizRequest;
use App\Http\Requests\System\Quizzes\UpdateQuizRequest;
use App\Models\Quiz;
use App\Services\CRUD\SystemCRUDService;

class QuizController extends Controller
{
    protected $systemCRUD;

    public function __construct(Quiz $model)
    {
        $this->systemCRUD = new SystemCRUDService($model);
    }


    public function index()
    {
        return  $this->systemCRUD->index();
    }

    public function getOne(FindQuizIdRequist $id)
    {
        return $this->systemCRUD->getOne($id);
    }

    public function store(StoreQuizRequest $request)
    {
        return  $this->systemCRUD->store($request);
    }

    public function update(UpdateQuizRequest $request)
    {
        return  $this->systemCRUD->update($request);
    }

    public function delete(FindQuizIdRequist $id)
    {
        return $this->systemCRUD->delete($id);
    }
}
