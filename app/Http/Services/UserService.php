<?php

namespace App\Http\Services;

use App\Enums\UserRole;
use App\Http\Repositories\UserRepository;
use App\Mail\RegisterUser;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class UserService
{

    protected UserRepository $userRepository;

    public function __construct(UserRepository $repository)
    {
        $this->userRepository = $repository;
    }

    public function create($data){
        try {
            $password = $this->randString(15);
            $token = $this->randString(30);
            $user = $this->userRepository->create($data, $password, $token);
            $user->assignRole(UserRole::USER);
            $url = env('WEBSITE_BASE_URL') . '/auth/' . $token;
            Mail::to($user->email)->send(new RegisterUser($user, $password, $url));
            return $user;
        }catch (\Exception $exception){
            throw new \ErrorException($exception->getMessage());
        }
    }

    public function index(){
        try {
            return $this->userRepository->index();
        } catch (\Exception $exception){

        }
    }

    private function randString( $length ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);

    }

    public function delete($id){
        try {
            return $this->userRepository->delete($id);
        } catch (\Exception $exception){
            throw new \ErrorException($exception->getMessage());
        }
    }

    public function status($id){
        try {
            return $this->userRepository->status($id);
        } catch (\Exception $exception){
            throw new \ErrorException($exception->getMessage());
        }
    }
}
