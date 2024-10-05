<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    private $baseUrl = null;
    public function __construct(){
        $this->baseUrl = config("BASE_URL", "http://localhost:8000/api");
    }
    
    public function login(Request $request)
    {

        try
        {
            $response = $response = Http::post("{$this->baseUrl}/session", [
                'email' => $request->email,
                'password' => $request->password,
            ]);
            
            if($response->getStatusCode() == 200){
                $data = $response->json();

                session()->put('uauth', $data);
                session()->put('access_token', $data['data']['access_token']);
                session()->put('refresh_token', $data['data']['refresh_token']);
            }

            //return view('blank', []);
            return redirect()->to('/reminders?limit=5');
        }catch (\Exception $e){
            $error = "Unable to login. Please suply valid credentials";
            redirect()->back()->withErrors($error);
        }
    }

    

    public function logout(Request $request)
    {
        if (session()->has("uauth")){
            session()->forget("uauth");
            session()->forget("access_token");
            session()->forget("refresh_token");
        }
           
        return redirect()->to("/");
    }


    public function show(Request $request)
    {
        return view('signin', []);
    }
}
