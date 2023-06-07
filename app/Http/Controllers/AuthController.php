<?php

namespace App\Http\Controllers;

use App\Http\Requests\auth\ResetPasswordRequest;
use App\Http\Services\AuthService;
use App\Mail\RecoveryCode;
use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    protected AuthService $authService;
    public function __construct(AuthService $service)
    {
        $this->authService = $service;
    }
    public function twoFactor()
    {
        return view('auth.two-factor');
    }

    public function twoFactorRecovery()
    {
        $user = User::find(session()->get('login.id'));
        $recoveryCode = json_decode(decrypt($user->two_factor_recovery_codes));
        Mail::to($user->email)->send(new RecoveryCode($recoveryCode));
        return view('auth.passwords.two-factor-recovery');
    }

    public function activeUser($token){
        try {
            $this->authService->activeUser($token);
            return redirect('/login');
        } catch (\Exception $exception){

        }
    }

    public function newPassword(){
        try {
            return view('auth.passwords.new_password');
        } catch (\Exception $exception){
        }
    }

    public function resetPassword(ResetPasswordRequest $request, $id){
        try {
             if($this->authService->resetPassowrd($id,$request->password)){
                return redirect('/home');
             }
             return 'Error';

        } catch (\Exception $exception){
        }
    }
}

