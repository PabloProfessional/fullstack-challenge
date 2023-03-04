<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserWeatherDataRequest;
use App\Http\Requests\UpdateUserWeatherDataRequest;
use App\Models\UserWeatherData;

class UserWeatherDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(UserWeatherData $userWeatherData)
    {
        //
    }

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
