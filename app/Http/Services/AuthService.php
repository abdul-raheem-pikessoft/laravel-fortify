<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;

class AuthService
{

    protected UserRepository $userRepository;

    public function __construct(UserRepository $repository)
    {
        $this->userRepository = $repository;
    }

    public function activeUser($token){
        try {
            return $this->userRepository->activeUser($token);
        } catch (\Exception $exception){
            throw new \ErrorException($exception->getMessage());
        }
    }
}
