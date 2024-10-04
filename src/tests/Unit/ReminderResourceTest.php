<?php

namespace Tests\Unit;

use App\Http\Resources\ReminderResource;
use App\Models\Reminder;
use Tests\TestCase;

class ReminderResourceTest extends TestCase
{
    /**
     * Test to show reminder resource is an array only the reminder fields.
     */
    public function test_reminder_resource_should_return_array_field_count_of_five()
    {
        $resource = ReminderResource::make(Reminder::factory(1)->create()->first())->toArray(request());
        expect($resource)->toBeArray()->toHaveCount(5);

    }
}
