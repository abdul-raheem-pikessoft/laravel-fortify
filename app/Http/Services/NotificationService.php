<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;

class NotificationService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $repository)
    {
        $this->userRepository = $repository;
    }

    public function updateDeviceToken($data){
        try {
            $this->userRepository->updateDeviceToken($data);
        } catch (\Exception $exception){
            throw new \ErrorException($exception->getMessage());
        }
    }

}
