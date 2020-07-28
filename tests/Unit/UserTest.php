<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Osiset\BasicShopifyAPI\ResponseAccess;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;


    /** @test */
    public function table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns((new User())->getTable(), [
                'id',
                'name',
                'email',
                'password',
                'email_verified_at',
                'shopify_grandfathered',
                'shopify_namespace',
                'shopify_freemium',
                'plan_id',
                'analytics_id',
                'chat_id',
                'shopify_gid',
                'domain',
                'shop_name',
                'contact_email',
                'city',
                'province',
                'province_code',
                'country',
                'country_code',
                'currency',
                'presentment_currencies',
                'money_format',
                'money_with_currency_format',
                'money_in_email_format',
                'money_with_currency_in_email_format',
                'timezone_offset',
                'iana_timezone',
                'shopify_plan_display_name',
                'shopify_partner',
                'shopify_plus',
                'shopify_scopes',
                'created_at',
                'updated_at',
                'deleted_at',
            ])
        );
    }


    /**
     * @test
     */
    public function it_has_expected_columns_casted()
    {
        $expected = [
            'id' => 'int',
            'email_verified_at' => 'datetime',
            'presentment_currencies' => 'json',
            'shopify_scopes' => 'json',
            'shopify_partner' => 'boolean',
            'shopify_plus' => 'boolean',
        ];

        $actual = (new User())->getCasts();

        $this->assertEquals($expected, $actual);
    }


    /**
     * @test
     */
    public function it_has_expected_columns_casts_as_dates()
    {
        $expected = [
            'deleted_at',
            'created_at',
            'updated_at',
        ];

        $actual = (new User())->getDates();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_has_expected_fillable_columns()
    {
        $expected = [];

        $actual = (new User())->getFillable();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_has_expected_guarded_columns()
    {
        $expected = [];

        $actual = (new User())->getGuarded();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function updateFromGraphApiResponse()
    {
        $shop = factory(User::class)->create([
            'contact_email' => 'some-email@example.com',
        ]);

        $email = $this->faker->safeEmail;

        $apiResponse = new ResponseAccess([
            'contactEmail' => $email,
        ]);

        $response = $shop->updateFromGraphApiResponse($apiResponse);

        $shop->refresh();

        $this->assertSame($response, 1);
        $this->assertSame($email, $shop->contact_email);
    }
}
