<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

class SettingControllerTest extends TestCase
{
    use RefreshDatabase, AdditionalAssertions;


    /** @test */
    public function index()
    {
        // Create a shop
        $user = factory(User::class)->create();

        $settings = [
            'desktop_status' => false,
            'mobile_status' => false,
            'some-setting' => [
                'key' => 'value',
            ],
        ];

        config()->set('model_settings.defaultSettings.' . $user->getTable(), $settings);

        $response = $this->actingAs($user)->get('/api/settings');

        $response->assertStatus(200)
                 ->assertJson([
                     'settings' => $settings,
                 ]);
    }
}
