<?php

namespace App\Http\Controllers\Api\admin;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::with('posts')->get();
        if ($users){
            return ApiResponse::sendResponse(200 , 'Users Returned Successfully', UserResource::collection($users));
        }else{
            return ApiResponse::sendResponse(201,'No Users Found',[]);
        }
    }
}
