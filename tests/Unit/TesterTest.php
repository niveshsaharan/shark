<?php

namespace Tests\Unit;

use App\Tester;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class TesterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns((new Tester())->getTable(), [
                'id',
                'shopify_domain',
                'expires_at',
                'created_at',
                'updated_at',
                'deleted_at',
            ])
        );
    }

    /**
     * @test
     */
    public function it_has_expected_columns_casts_as_dates()
    {
        $expected = [
            'expires_at',
            'created_at',
            'updated_at',
            'deleted_at',
        ];

        $actual = (new Tester())->getDates();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_has_expected_fillable_columns()
    {
        $expected = [];

        $actual = (new Tester())->getFillable();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_has_expected_guarded_columns()
    {
        $expected = [];

        $actual = (new Tester())->getGuarded();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function scopeActive()
    {
        $this->assertInstanceOf('\Illuminate\Database\Eloquent\Builder', (new Tester())->active());
    }
}
