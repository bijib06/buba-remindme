<?php

namespace App;
use Illuminate\Support\Facades\Http;

class Utility {

    public static function refreshToken()
    {
        $refresh_token = session()->get("refresh_token");
        $response = Http::withHeaders(['Authorization' => "Bearer {$refresh_token}"])->put("http://localhost:8000/api/session", []);

        if($response->getStatusCode() != 200){
            session()->forget("uauth");
            session()->forget("access_token");
            session()->forget("refresh_token");
            return redirect()->to('/')->with("error", "Session expired, please log in."); 
        }
        $response = $response->json();
        session()->put('access_token', $response['data']['access_token']);
        return true;
    }



}