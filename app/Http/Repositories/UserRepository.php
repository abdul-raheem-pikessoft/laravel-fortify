<?php

namespace App\Http\Repositories;

use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function create($data, $password, $token){
        try {
            return User::create([
                'name' => $data->name,
                'email' => $data->email,
                'password' => Hash::make($password),
                'status' => UserStatus::ASSIGN,
                'token' => $token
            ]);
        }catch (\Exception $exception){
            throw new \ErrorException($exception->getMessage());
        }
    }

    public function activeUser($token){
        try {
            User::where('token', $token)->update([
                'status' => UserStatus::ACTIVE,
            ]);
            return 'User is Activated';
        } catch (\Exception $exception){
            throw new \ErrorException($exception->getMessage());
        }
    }

    public function updatePassword($id, $password){
        try {
            User::where('id', $id)->update([
                'password' => Hash::make($password),
                'first_login' => false,
            ]);
            return true;
        } catch (\Exception $exception){
            throw new \ErrorException($exception->getMessage());
        }
    }

    public function index(){
        try {
            return User::with('roles')->get();
        } catch (\Exception $exception){

        }
    }

    public function delete($id){
        try {
            return User::where('id', $id)->delete();
        } catch (\Exception $exception){
            throw new \ErrorException($exception->getMessage());
        }
    }

    public function status($id){
        try {
            $user = User::where('id' , $id)->first();
            if($user->status === UserStatus::ACTIVE){
                $user->status = UserStatus::BLOCK;
            }else if($user->status === UserStatus::BLOCK){
                $user->status = UserStatus::ACTIVE;
            }
            $user->save();
            return $user;
        } catch (\Exception $exception){
            throw new \ErrorException($exception->getMessage());
        }
    }

    public function updateDeviceToken($data){
        try {
            Auth::user()->device_token =  $data->token;
            Auth::user()->save();
        } catch (\Exception $exception){
            throw new \ErrorException($exception->getMessage());
        }
    }
}
