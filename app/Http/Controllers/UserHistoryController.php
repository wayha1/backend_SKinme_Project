<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserHistoryResource;
use App\Models\UserHistory;
use Illuminate\Http\Request;

class UserHistoryController extends Controller
{
    public function index(){
        $user_history = UserHistory::with('users')->with('products')->get();
        return UserHistoryResource::collection($user_history);
    }
    public function store(){

    }
    public function update(){

    }
    public function destroy(){
        
    }
}
