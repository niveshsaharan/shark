<?php

namespace Tests\Feature\Exceptions;

use Tests\TestCase;

/**
 * Class MissingShopDomainExceptionTest
 *
 * @package \Tests\Feature\Exceptions
 */
class MissingShopDomainExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function it_redirects_to_auth_page()
    {
        $response = $this->get('/');
        $response->assertRedirect('/auth');
    }
}
