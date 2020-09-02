<?php

namespace Tests\Feature\Observers;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserObserverTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function creating()
    {
        $user = factory(User::class)->create([
            'name' => 'somename.myshopify.com',
            'email' => '',
            'password' => null,
        ]);

        $user2 = factory(User::class)->create([
            'name' => 'somename.myshopify.com',
            'email' => 'shop@someothervalue.com',
            'password' => Hash::make('password'),
        ]);

        $this->assertEquals('shop@somename.myshopify.com', $user->email);
        $this->assertEquals('', $user->password);

        $this->assertEquals('shop@someothervalue.com', $user2->email);
        $this->assertTrue(Hash::check('password', $user2->password));
    }
}
