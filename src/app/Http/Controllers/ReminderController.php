<?php

namespace App\Http\Controllers;

use App\Http\Requests\PathRequest;
use App\Http\Requests\ReminderRequest;
use App\Http\Resources\ReminderCollection;
use App\Http\Resources\ReminderResource;
use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit =  $request->limit?: 5;
        try {
            $reminders = Reminder::take($limit)->get();
            $reminderCollection = new ReminderCollection($reminders);
            return $this->sendResponse($reminderCollection, Response::HTTP_OK);

        }catch (ModelNotFoundException $e){
            return $this->sendError('o reminder exists.', ['error'=>$e->getMessage()], Response::HTTP_NOT_FOUND);
        }catch (\Exception $e){
            return $this->sendError('Server Error.', ['error'=>$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$request->validate($request->rules());
        try {
            $reminder = Reminder::create([
                'title' => $request->title,
                'description' => $request->description,
                'remind_at' => $request->remind_at,
                'event_at' => $request->event_at,
            ]);
            $reminderResource = new ReminderResource($reminder);
            return $this->sendResponse($reminderResource, Response::HTTP_CREATED);
        }catch (ModelNotFoundException $e){
            return $this->sendError('Reminder record not created', ['error'=>$e->getMessage()], Response::HTTP_NOT_FOUND);
        }catch (\Exception $e){
            return $this->sendError('Server Error.', ['error'=>$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        //$request->validate($request->rules());

        try {
            $reminder = Reminder::findOrFail($id);
            $remindResource = new ReminderResource($reminder);
            return $this->sendResponse($remindResource, Response::HTTP_OK);

        }catch (ModelNotFoundException $e){
            
            return $this->sendError('Reminder not found.', ['error'=>$e->getMessage()], Response::HTTP_NOT_FOUND);
        }catch (\Exception $e){
            return $this->sendError('Server Error.', ['error'=>$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       // $request->validate($request->rules());
        try {
            $reminder = Reminder::findOrFail($id);
            $reminder->title = $request->title;
            $reminder->description = $request->description;
            $reminder->remind_at = $request->remind_at;
            $reminder->event_at = $request->event_at;
            $reminder->save();
            return $this->sendResponse(new ReminderResource($reminder), Response::HTTP_ACCEPTED);
        }catch (ModelNotFoundException $e){
            return $this->sendError('Reminder not found.', ['error'=>$e->getMessage()], Response::HTTP_NOT_FOUND);
        }catch (\Exception $e){
            return $this->sendError('Reminder not updated.'.$request->title, ['error'=>$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        //$request->validate($request->rules());

        try {
            Reminder::destroy($id);
            return $this->sendResponse(null, Response::HTTP_OK);

        }catch (ModelNotFoundException $e){
            return $this->sendError('Reminder not found.', ['error'=>$e->getMessage()], Response::HTTP_NOT_FOUND);
        }catch (\Exception $e){
            return $this->sendError('Reminder not deleted.', ['error'=>$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
