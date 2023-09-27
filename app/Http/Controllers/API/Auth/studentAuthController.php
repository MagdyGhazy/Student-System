<?php
namespace App\Http\Controllers\API\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Student\Auth\StudentLoginRequest;
use App\Http\Requests\Student\Auth\StudentRegisterRequest;
use App\MainClasses\Auth\MainAuth;
use App\Models\Student;

class studentAuthController extends Controller
{
    protected $mainAuth;

    public function __construct(Student $student)
    {
        $this->middleware("auth:student", ['except' => ['login', 'register']]);
        $this->mainAuth = new MainAuth($student,"student");
    }

    public function login(StudentLoginRequest $request)
    {
        $validator = $request->validated();
        return $this->mainAuth->login($validator);
    }


    public function register(StudentRegisterRequest $request)
    {
        return $this->mainAuth->register($request);
    }


    public function logout()
    {
        return $this->mainAuth->logout();
    }


    public function refresh() {
        return $this->mainAuth->refresh();
    }

    public function userProfile() {
        return $this->mainAuth->userProfile();
    }

}
