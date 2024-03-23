<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return "hello world";
    }
    public function store(Request $request)
    {
        $this->validate($request, [ 
            "name"=> "",    
            "email"=> "",
            "password"=> "",
            "gener" => "",
            "is_active"=> "",
            "user_image"=> "",
            ]);
    }
}
