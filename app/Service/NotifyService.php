<?php
namespace App\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Users;
use App\Model\Apps;
use App\Model\Scores;
use App\Model\Questions;
use App\Model\Wins;

class NotifyService {

    public function store($params)
    {
        $appName = $params['app_name'];
        switch ($appName) {
            case 'Ai Là Triệu Phú':
                $instanceId = env('INSTANCE_ID_AI_LA_TRIEU_PHU');
                $secretKey = env('SECRET_KEY_AI_LA_TRIEU_PHU');
                break;
            case 'Luyện nghe Tiếng Anh':
                $instanceId = env('INSTANCE_ID_ENGLISH');
                $secretKey = env('SECRET_KEY_ENGLISH');
                break;

            default:
                break;
        }

        $beamsClient = new \Pusher\PushNotifications\PushNotifications(array(
            "instanceId" => $instanceId,
            "secretKey" => $secretKey,
        ));

        $users = [];
        foreach ($params['ids'] as $item) {
            $user_id    = Scores::findOrFail($item)->user_id;
            $users[] = Users::findOrFail($user_id)->fb_id;
        }

        return $beamsClient->publishToInterests(
            $users,
            [
                "fcm" => [
                    "notification" => [
                        "title" => "Hi!",
                        "body" => $params['notify']
                    ]
                ],
                "apns" => [
                    "aps" => [
                        "alert" => [
                            "title" => "Hi!",
                            "body" => $params['notify']
                        ]
                    ]
                ]
            ]
        );
    }
}
