<?php

it("can_fetch_the_list_of_reminders", function()
{
    $response = login()->get('/api/reminders?limit=5');
    $response->assertStatus(200);
});


it("can_fetch_a_reminder_by_id", function()
{
    $reminder = \App\Models\Reminder::factory()->create();
    login()->get('/api/reminders/'. $reminder->id)->assertStatus(200);

});


it("can_create_new_reminder",function()
{
    $response = login()->post('/api/reminders', [
        'title' => "A New  Reminder Title",
        'description' => "It comes here like so",
        'remind_at' => 1728066415,
        'event_at' => 1728066415,
    ]);
    $response->assertStatus(201);
});


it("can_update_a_reminder",function()
{
    $reminder = \App\Models\Reminder::factory()->create();
    $response = login()->put('/api/reminders/'.$reminder->id, [
        'title' => "A New  Reminder Update",
        'description' => "It comes here like so edited",
        'remind_at' => 1728066415,
        'event_at' => 1728066415,
    ]);
    $response->assertStatus(202);
});


it("can_delete_a_reminder",function()
{
    $reminder = \App\Models\Reminder::factory()->create();
    $response = login()->delete('/api/reminders/'.$reminder->id);
    $response->assertStatus(200);
});


it("can_return_http_not_found_error_code_when_fetching_a_reminder_by_wrong_id", function()
{
    login()->get('/api/reminders/32')->assertStatus(404);

});

it("can_return_validation_error_code_when_fcreating_reminder_invalid_remind_at", function()
{
    $response = login()->post('/api/reminders', [
        'title' => "A New  Reminder Title",
        'description' => "It comes here like so",
        'remind_at' => 'wrongtype',
        'event_at' => 1728066415,
    ]);
    $response->assertStatus(422);

});

