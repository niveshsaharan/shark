<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\SampleController;
use App\Http\Requests\UserSettingFormRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

class SampleControllerTest extends TestCase
{
    use RefreshDatabase, AdditionalAssertions;

    /**
     * @test
     */
    public function index()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/');
        $response->assertStatus(200)->assertViewIs('app');

        // Inertia test
        $response = $this->actingAs($user)->get('/', [
            'X-Inertia' => true,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'props' => [
                    'errors' => [],
                    'flash' => [
                        'success' => '',
                        'error' => '',
                    ],
                ],
            ]);
    }

    /** @test */
    public function indexSetting()
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

        $response = $this->actingAs($user)->get('/settings', [
            'X-Inertia' => true,
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'props' => [
                         'settings' => $settings,
                     ],
                 ]);
    }

    /**
     * @test
     */
    public function updateSetting_uses_form_request()
    {
        $this->assertActionUsesFormRequest(SampleController::class, 'updateSetting', UserSettingFormRequest::class);
    }

    /**
     * @test
     */
    public function updateSetting()
    {
        // Create a shop
        $user = User::factory()->create();

        $response = $this->actingAs($user)->put('/settings', [
            'desktop_status' => true,
            'mobile_status' => true,
            'some-invalid-setting' => 'something', // this won't be saved
        ], [
            'X-Inertia' => true,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'props' => [
                    'settings' => [
                        'desktop_status' => true,
                        'mobile_status' => true,
                    ],
                ],
            ])
            ->assertJsonMissing([
                'props' => [
                    'settings' => [
                        'some-invalid-setting' => 'something',
                    ],
                ],
            ]);
    }
}
