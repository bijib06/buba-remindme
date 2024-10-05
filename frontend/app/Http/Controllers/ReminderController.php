<?php

namespace App\Http\Controllers;

use App\Utility;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class ReminderController extends Controller
{

    private $baseUrl = null;
    public function __construct(){
        $this->baseUrl = config("BASE_URL", "http://localhost:8000/api");
    }
    
    public function index()
    {
        $access_token = session()->get("access_token");
        //dd($access_token);
        $response = Http::withHeaders(['Authorization' => "Bearer {$access_token}"])->get("{$this->baseUrl}/reminders?limit=5");
        //dd($response->json());
        if($response->getStatusCode() >= 400)
        {
            if($response->getStatusCode() == Response::HTTP_UNAUTHORIZED)
            {
                Utility::refreshToken();
                return redirect()->to('/')->with("error", "Session expired, please log in.");            
            }else{
                return redirect()->back()->with("error","Request failed with error code: ".$response->getStatusCode());
            }
        }
       
        $reminders = $response->json()["data"];
        //dd($reminders);
        return view("reminders", compact("reminders"));
    }

    public function create(Request $request)
    {
        return view("reminder_create");
    }

    public function store(Request $request)
    {

        $access_token = session()->get("access_token");
        //dd($access_token);
        $response = Http::withHeaders(['Authorization' => "Bearer {$access_token}"])->post("{$this->baseUrl}/reminders",[
            'title' => $request->title,
            'description' => $request->description,
            'remind_at' => $request->remind_at,
            'event_at' => $request->event_at,
        ]);
        //dd($response->json());

        if($response->getStatusCode() >= 400)
        {
            if($response->getStatusCode() == Response::HTTP_UNAUTHORIZED)
            {
                Utility::refreshToken();
                return redirect()->to('/')->with("error", "Session expired, please log in.");            
            }else{
                return redirect()->back()->with("error","Request failed with error code: ".$response->getStatusCode());
            }
        }
        return redirect()->to("/reminders")->with("success", "Reminder created successfully");
    }

    public function show(Request $request, $id)
    {
        $access_token = session()->get("access_token");
        $response = Http::withHeaders(['Authorization' => "Bearer {$access_token}"])->get("{$this->baseUrl}/reminders/{$id}");
      
        if($response->getStatusCode() >= 400)
        {
            if($response->getStatusCode() == Response::HTTP_UNAUTHORIZED)
            {
                Utility::refreshToken();
                return redirect()->to('/')->with("error", "Session expired, please log in.");            
            }else{
                return redirect()->back()->with("error","Request failed with error code: ".$response->getStatusCode());
            }
        }
       
        $reminder = $response->json()["data"];
        return view("reminder_detail", compact("reminder"));
    }

    public function edit(Request $request, $id)
    {
        $access_token = session()->get("access_token");
        $response = Http::withHeaders(['Authorization' => "Bearer {$access_token}"])->get("{$this->baseUrl}/reminders/{$id}");
      
        if($response->getStatusCode() >= 400)
        {
            if($response->getStatusCode() == Response::HTTP_UNAUTHORIZED)
            {
                Utility::refreshToken();
                return redirect()->to('/')->with("error", "Session expired, please log in.");            
            }else{
                return redirect()->back()->with("error","Request failed with error code: ".$response->getStatusCode());
            }
        }
       
        $reminder = $response->json()["data"];
        return view("reminder_edit", compact("reminder"));
    }

    public function update(Request $request, $id)
    {
        $access_token = session()->get("access_token");
        $response = Http::withHeaders(['Authorization' => "Bearer {$access_token}"])->put("{$this->baseUrl}/reminders/{$id}",[
            'title' => $request->title,
            'description' => $request->description,
            'remind_at' => $request->remind_at,
            'event_at' => $request->event_at,
        ]);
      
        if($response->getStatusCode() >= 400)
        {
            if($response->getStatusCode() == Response::HTTP_UNAUTHORIZED)
            {
                Utility::refreshToken();
                return redirect()->to('/')->with("error", "Session expired, please log in.");            
            }else{
                return redirect()->back()->with("error","Request failed with error code: ".$response->getStatusCode());
            }
        }
       
        return redirect()->to("/reminders")->with("success", "Reminder updated successfully");
    }

    public function destroy($id)
    {
        $access_token = session()->get("access_token");
        $response = Http::withHeaders(['Authorization' => "Bearer {$access_token}"])->delete("{$this->baseUrl}/reminders/{$id}");
      
        if($response->getStatusCode() >= 400)
        {
            if($response->getStatusCode() == Response::HTTP_UNAUTHORIZED)
            {
                Utility::refreshToken();
                return redirect()->to('/')->with("error", "Session expired, please log in.");            
            }else{
                return redirect()->back()->with("error","Request failed with error code: ".$response->getStatusCode());
            }
        }
        return redirect()->to("/reminders")->with("success", "Reminder deleted successfully");
    }
}
