<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\UserSettingFormRequest;
use App\Models\User;
use Tests\TestCase;

class UserSettingFormRequestTest extends TestCase
{
    /**
     * @var \App\Http\Requests\UserSettingFormRequest
     */
    private $subject;

    protected function setUp():void
    {
        parent::setUp();

        $this->subject = new UserSettingFormRequest();
    }

    /**
     * @test
     */
    public function authorize_returns_false_for_unauthenticated()
    {
        $this->assertFalse($this->subject->authorize());
    }

    /**
     * @test
     */
    public function authorize_returns_true_when_authenticated()
    {
        $user = User::factory()->make();

        $this->actingAs($user);

        $this->assertTrue($this->subject->authorize());
    }

    /**
     * @test
     */
    public function rules()
    {
        $this->assertSame([
            'desktop_status' => ['boolean'],
            'mobile_status' => ['boolean'],
        ], $this->subject->rules());
    }
}
