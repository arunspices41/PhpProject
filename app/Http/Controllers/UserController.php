<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Http;



class UserController extends Controller
{
    public function registeruser(Request $request)
    {

        $mobile = $request->mobile;
        $password =  $request->password;

        Log::info("user & pwdr");
        Log::info($mobile . ":" . $password);

        return view('menuitems');
    }

    public function saveuserdetails(Request $request)
    {
        Log::info("saveuserdetails");
        $tea = $request->items["tea"];
        $meals = $request->items["meals"];

        $teaarray = array(
            'details' => $tea
        );

        $mealsarray = array(
            'details' => $meals
        );

        $order = array(
            'tea' =>  $teaarray,
            'meals' =>  $mealsarray,
        );

        $msg = json_encode([
            'data' => $order
        ]);
        $subscribers = Redis::publish('message-channel', $msg);
        if ($subscribers > 0) {
            Log::info('No subscribers');
        } else {
            Log::info('No Of subscribers = ' . $subscribers);
        }

        $response = Http::get('http://localhost:8081/processMessage');
        // $redis = app('redis'); // returns a Redis connection
        // $redis->publish('messages-channel', 'Hello world!');
        $resbody = $response->body();

        Log::info('response from java');
        Log::info($resbody);
    }
}
