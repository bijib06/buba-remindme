<?php

namespace Tests\Unit;

use App\Http\Resources\ReminderCollection;
use App\Http\Resources\ReminderResource;
use App\Models\Reminder;
use Tests\TestCase;

class ReminderCollectionTest extends TestCase
{

    /**
     * Test to show reminder resource collection is an array.
     */
    public function test_reminder_resource_collection_should_return_array()
    {
        $resource = (ReminderResource::collection(Reminder::factory(3)->create()))->toArray(request());
        expect($resource)->toBeArray()->toHaveCount(3);

    }

    /**
     * Test to show reminder resource collection contains an array of reminder resources.
     */
    public function test_resource_collection_should_return_two_dimensional_array()
    {
        $resource = (ReminderResource::collection(Reminder::factory(3)->create()))->toArray(request());
        expect($resource[0])->toBeArray()->toHaveCount(5);
    }
}
