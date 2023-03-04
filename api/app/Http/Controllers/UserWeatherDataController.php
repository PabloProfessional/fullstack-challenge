<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserWeatherDataRequest;
use App\Http\Requests\UpdateUserWeatherDataRequest;
use App\Models\User;
use App\Models\UserWeatherData;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class UserWeatherDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // The below is purely for testing the API

        /*$lat = User::first()->latitude;
        $long = User::first()->longitude;

        $url = "https://api.openweathermap.org/data/3.0/onecall?lat=".$lat."&lon=".$long."&units=metric&exclude=hourly,daily&appid=".env('OPENWEATHERMAP_API_KEY');


        $response = Http::acceptJson()->get($url);

        $current_weather = UserWeatherData::create([
            'user_id' => User::first()->id,
            'current_weather' => json_encode($response->body())
        ]);


        //dd(json_decode($current_weather->current_weather));

        return json_decode($response->body())->current;*/


    }

    public function show($email)
    {
        //
        $user = User::where('email',$email)->first();

        if ($user->weather->first() == null || $user->weather->first()->created_at->diffInHours() >= 5) {

            $latest_weather = $this->getUserWeatherData($user);

        } else {

            $latest_weather = json_decode($user->weather->first());
        }

        return $latest_weather->current_weather;
    }


    public function getUserWeatherData($user) {

        $url = "https://api.openweathermap.org/data/3.0/onecall?lat=".$user->latitude."&lon=".$user->longitude."&units=metric&exclude=hourly,daily&appid=".env('OPENWEATHERMAP_API_KEY');


        $response = Http::acceptJson()->get($url);

        if ($response->status() == 200) {

            $current_weather = UserWeatherData::create([
                'user_id' => $user->id,
                'current_weather' => json_encode(json_decode($response->body())->current)
            ]);

            return $current_weather;

        } else {

            return "Weather currently unavailable. Please check back later";
        }


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserWeatherDataRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserWeatherData $userWeatherData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserWeatherDataRequest $request, UserWeatherData $userWeatherData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserWeatherData $userWeatherData)
    {
        //
    }
}
