<?php

namespace Tests\Feature\Http\Middleware;

use Tests\TestCase;

class CheckReferrerTest extends TestCase
{
    /**
     * @test
     */
    public function referrer_is_being_set_in_session()
    {
        $response = $this->get('/?ref=referrer');
        $response->assertSessionHas('referrer', 'referrer');

        $response = $this->get('/?ref=new-referrer');
        $response->assertSessionHas('referrer', 'new-referrer');

        $this->assertEquals($response->getStatusCode(), 302);
    }
}
