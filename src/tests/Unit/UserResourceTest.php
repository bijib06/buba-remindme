<?php

namespace Tests\Unit;

use App\Http\Resources\UserResource;
use App\Models\User;
use Tests\TestCase;

class UserResourceTest extends TestCase
{
    /**
     * Test to show user resource is an array only the Chosen three fields.
     */
    public function test_user_resource_should_return_array_field_count_of_five()
    {
        $resource = UserResource::make(User::factory(1)->create()->first())->toArray(request());
        expect($resource)->toBeArray()->toHaveCount(3);

    }

    /**
     * Test to show user resource is an array only the Chosen three fields.
     */
    public function test_user_resource_should_not_include_password_field()
    {
        $resource = UserResource::make(User::factory(1)->create()->first())->toArray(request());
        expect(array_key_exists('password', $resource))->toBeFalse();

    }
}
