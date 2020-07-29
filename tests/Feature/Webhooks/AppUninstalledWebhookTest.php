<?php

namespace Tests\Feature\Webhooks;

use App\Webhooks\AppUninstalledWebhook;
use Osiset\ShopifyApp\Messaging\Jobs\AppUninstalledJob;
use Osiset\ShopifyApp\Objects\Values\ShopDomain;
use Tests\TestCase;

class AppUninstalledWebhookTest extends TestCase
{
    /**
     * @test
     */
    public function it_extends_the_job_from_package()
    {
        $this->assertTrue(is_subclass_of(new AppUninstalledWebhook(ShopDomain::fromNative(''), new \stdClass()), AppUninstalledJob::class));
    }
}
