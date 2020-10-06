<?php

namespace Tests\Unit\Providers;

use App\Providers\EventServiceProvider;
use Tests\TestCase;

class EventServiceProviderTest extends TestCase
{
    /**
     * @test
     * @dataProvider subscribers
     * @param $subscriber
     *
     * @throws \ReflectionException
     */
    public function it_register_subscribers($subscriber)
    {
        $class = new \ReflectionClass(EventServiceProvider::class);

        $property = $class->getProperty('subscribe');
        $property->setAccessible(true);

        $providers = app()->getProviders(EventServiceProvider::class);

        $this->assertTrue(in_array($subscriber, $property->getValue(array_shift($providers))));
    }

    /**
     * Subscribers data provider
     *
     * @return \string[][]
     */
    public function subscribers()
    {
        return [
            [
                'App\Listeners\ShopLoginEventSubscriber',
            ],
        ];
    }
}
