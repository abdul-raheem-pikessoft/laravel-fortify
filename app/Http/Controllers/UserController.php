<?php

namespace App\Http\Controllers;

use App\Http\Requests\user\CreateUserRequest;
use App\Http\Services\UserService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected UserService $userService;
    public function __construct(UserService $service)
    {
        $this->userService = $service;
    }


    public function index() {
        try {
            $users = $this->userService->index();
            return view('user.user',['users' => $users]);
        }catch (\Exception $exception){

        }
    }

    public function store(CreateUserRequest $request) {
        try {
            $user = $this->userService->create($request);
            return response()->json([
                'status' => true,
                'data' => $user,
            ], JsonResponse::HTTP_OK);
        }catch (\Exception $exception){
            throw new HttpResponseException(response()->json([
                'status' => false,
                'errors' => 'Fail to create user ' . $exception->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            ));
        }
    }

    public function delete($id){
        try {
            $this->userService->delete($id);
            return response()->json([
                'message' => 'User is Deleted!',
                'status' => true,
            ]);
        } catch (\Exception $exception){
            throw new HttpResponseException(response()->json([
                'status' => false,
                'errors' => 'Fail to delete user ' . $exception->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            ));
        }
    }

    public function status($id){
        try {
            $this->userService->status($id);
            return response()->json([
                'message' => 'User is Blocked!',
                'status' => true,
            ]);
        } catch (\Exception $exception){
            throw new HttpResponseException(response()->json([
                'status' => false,
                'errors' => 'Fail to delete user ' . $exception->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            ));
        }
    }
}
