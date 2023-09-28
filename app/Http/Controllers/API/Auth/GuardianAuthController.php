<?php
namespace App\Http\Controllers\API\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Guardian\Auth\GuardianLoginRequest;
use App\Http\Requests\Guardian\Auth\GuardianRegisterRequest;
use App\Services\Auth\MainAuthService;
use App\Models\Guardian;

class GuardianAuthController extends Controller
{
    protected $mainAuth;

    public function __construct(Guardian $guardian)
    {
        $this->middleware("auth:guardian", ['except' => ['login', 'register']]);
        $this->mainAuth = new MainAuthService($guardian,"guardian");
    }

    public function login(GuardianLoginRequest $request)
    {
        $validator = $request->validated();
        return $this->mainAuth->login($validator);
    }


    public function register(GuardianRegisterRequest $request)
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
