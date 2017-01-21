<?php

namespace App\Http\Controllers;

use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class FcmController
{

    public function notification($title,$message,$token)
    {

        $optionBuiler = new OptionsBuilder();
        $optionBuiler->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($message)
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);

        $option = $optionBuiler->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

//$token = "fCUa45QKdQU:APA91bHMUNWqUC06X_QxP6IwFsnRlw6uI9y84PIhEiVQrJ3ZQQiHLGeNuCiR9BwOg_Fe8VDAGMh2hbczDA42wKv6nSPF5G69eSY3ThkZBRtu96t9uqiKuh8p_MEi24JQBTbwImLiLPpR";

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();

//return Array - you must remove all this tokens in your database
        $downstreamResponse->tokensToDelete();

//return Array (key : oldToken, value : new token - you must change the token in your database )
        $downstreamResponse->tokensToModify();

//return Array - you should try to resend the message to the tokens in the array
        $downstreamResponse->tokensToRetry();
    }

}
