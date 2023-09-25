<?php
namespace App\Http\Controllers\API\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\AdminLoginRequest;
use App\Http\Requests\Admin\Auth\AdminRegisterRequest;
use App\inheritance\Auth\MainAuth;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    protected $mainAuth;

    public function __construct(Admin $admin)
    {
        $this->middleware("auth:admin", ['except' => ['login', 'register']]);
        $this->mainAuth = new MainAuth($admin,"admin");
    }

    public function login(AdminLoginRequest $request)
    {
        $validator = $request->validated();
        return $this->mainAuth->login($validator);
    }


    public function register(AdminRegisterRequest $request)
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
