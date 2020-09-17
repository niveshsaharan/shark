<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Http\Controllers\Api\SettingController;
use App\Http\Requests\UserSettingFormRequest;
use App\Models\User;
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
        $user = User::factory()->create();

        $settings = [
            'desktop_status' => false,
            'mobile_status' => false,
            'some-setting' => [
                'key' => 'value',
            ],
        ];

        config()->set('model_settings.defaultSettings.'.$user->getTable(), $settings);

        $response = $this->actingAs($user)->get('/api/settings');

        $response->assertStatus(200)
                 ->assertJson([
                     'settings' => $settings,
                 ]);
    }

    /**
     * @test
     */
    public function save_uses_form_request()
    {
        $this->assertActionUsesFormRequest(SettingController::class, 'save', UserSettingFormRequest::class);
    }

    /**
     * @test
     */
    public function save()
    {
        // Create a shop
        $user = User::factory()->create();

        $response = $this->actingAs($user)->put('/api/settings', [
            'desktop_status' => true,
            'mobile_status' => true,
            'some-invalid-setting' => 'something', // this won't be saved
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'settings' => [
                    'desktop_status' => true,
                    'mobile_status' => true,
                ],
            ])
            ->assertJsonMissing([
                'settings' => [
                    'some-invalid-setting' => 'something',
                ],
            ]);
    }
}
