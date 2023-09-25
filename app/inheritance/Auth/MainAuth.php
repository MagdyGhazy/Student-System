<?php

namespace App\inheritance\Auth;

use App\Http\Controllers\Controller;

class MainAuth
{
    protected $model;
    protected $guard;

    public function __construct($model,$guard)
    {
          $this->model = $model;
          $this->guard = $guard;
    }

    public function login($validator){
        if (! $token = auth()->guard($this->guard)->attempt($validator)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }

    public function register($request) {

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data = $this->model::create($data);
        return response()->json([
            'message' => "{$this->guard} successfully registered",
            "{$this->guard}" => $data
        ], 201);
    }


    public function logout() {
        auth()->guard($this->guard)->logout();
        return response()->json(['message' => "{$this->guard} successfully signed out"]);
    }


    public function refresh() {
        return $this->createNewToken(auth()->guard($this->guard)->refresh());
    }

    public function userProfile() {
        return response()->json(auth()->guard($this->guard)->user());
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard($this->guard)->factory()->getTTL() * 60,
            "{$this->guard}" => auth()->guard($this->guard)->user()
        ]);
    }

}
