<?php

namespace App\Http\Controllers;

use App\Http\Services\NotificationService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected NotificationService $notificationService;

    public function __construct(NotificationService $service)
    {
        $this->notificationService = $service;
    }

    public function index(){
        return view('notification');
    }

    public function updateDeviceToken(Request $request)
    {
        try {
            $this->notificationService->updateDeviceToken($request);
            return response()->json(['Token successfully stored.']);
        } catch (\Exception $exception){
            throw new HttpResponseException(response()->json([
                'status' => false,
                'errors' => 'Fail to update device token ' . $exception->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            ));
        }
    }


    public function sendNotification(Request $request)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $FcmToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $serverKey = 'AAAA4iNwwfk:APA91bHwnL3kd3jy6L6htI6S8LF1ulCMIlI25xhBrp2wCMMbv_KgNBs_6EHQ7IfwszQkkE2rhW20-jm5v4VUCe2e2Vt9-zf_spkdXYe5x1mHYAadV53dyYXAQmG8vZC6PCt-w9xQXEDb';

        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
            ]
        ];
        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        // FCM response
        dd($result);
    }

}
