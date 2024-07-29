<?php

namespace App\Services;
use GuzzleHttp\Client;

class PushNotificationService
{
    public function send($post, $user_ids)
<<<<<<< HEAD
{
    try {
=======
    {
>>>>>>> f822cf6 (updation in the)
        if(count($user_ids) < 1) {
            return true;
        }

        $content = array(
            "en" => $post['notification_message']
        );

        $headings = array(
            "en" => 'TMS App',
        );
        $filters = [];

        $or_filter = [
            'operator' => 'OR'
        ];

        foreach($user_ids as $user_id) {
            $filter = [
                'field' => 'tag',
                'key' => 'userId',
                'relation' => '=',
                'value' => $user_id,
            ];

            array_push($filters, $filter, $or_filter);
        }

        array_pop($filters);

        // using guzzleHTTP method
        $client = new Client([
            'base_uri' => 'https://onesignal.com/api/v1/',
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . env('ONE_SIGNAL_REST_KEY'),
            ],
        ]);
        
        $body = [
            'app_id'   => env('ONE_SIGNAL_APP_ID'),
            'filters'  => $filters,
            'headings' => $headings,
            'contents' => $content,
            'url'      => $post['url'],
        ];

        $response = $client->post('notifications', [
            'json' => $body,
            'verify' => false,
        ]);
<<<<<<< HEAD

        return $response;
    } catch (\Exception $e) {
       
    }
}

}
=======
        return $response;
    }
}
>>>>>>> f822cf6 (updation in the)
