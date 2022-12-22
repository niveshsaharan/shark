<?php

namespace Tests\Unit\Http\Middleware;

use App\Http\Middleware\IsAdmin;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Tests\TestCase;

class IsAdminTest extends TestCase
{
    /**
     * @test
     */
    public function it_aborts_with_401_for_non_admins()
    {
        // Test with no user
        $response = ($this->app->make(IsAdmin::class))->handle(request(), function () {
        });
        $this->assertEquals(401, $response->status());

        // Test with user from other guard
        $user = User::factory()->make();
        $this->actingAs($user);

        $response = ($this->app->make(IsAdmin::class))->handle(request(), function () {
        });

        $this->assertEquals(401, $response->status());

        // Test with user from correct guard but not admin
        $user = Admin::factory()->make([
            'type' => 'invalid',
        ]);

        $this->actingAs($user, 'admin');

        $response = ($this->app->make(IsAdmin::class))->handle(request(), function () {
        });

        $this->assertEquals(401, $response->status());
    }

    /**
     * @test
     */
    public function it_works_for_admin_users()
    {
        $called = false;
        $user = Admin::factory()->make();
        $this->actingAs($user, 'admin');

        $this->app->make(IsAdmin::class)->handle(request(), function () use (&$called) {
            $called = true;
        });

        $this->assertTrue($called);
    }
}
