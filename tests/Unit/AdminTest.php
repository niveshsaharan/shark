<?php

namespace Tests\Unit;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns((new Admin())->getTable(), [
                'id',
                'name',
                'email',
                'password',
                'email_verified_at',
                'type',
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
            'deleted_at' => 'datetime',
        ];

        $actual = (new Admin())->getCasts();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_has_expected_columns_casts_as_dates()
    {
        $expected = [
            'created_at',
            'updated_at',
        ];

        $actual = (new Admin())->getDates();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_has_expected_fillable_columns()
    {
        $expected = [
            'name', 'email', 'password',
        ];

        $actual = (new Admin())->getFillable();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_has_expected_guarded_columns()
    {
        $expected = ['*'];

        $actual = (new Admin())->getGuarded();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function isSuperAdmin()
    {
        $user = Admin::factory()->make();
        $user2 = Admin::factory()->admin()->make();
        $user3 = Admin::factory()->make([
            'type' => 'user',
        ]);

        $this->assertTrue($user->isSuperAdmin());
        $this->assertFalse($user2->isSuperAdmin());
        $this->assertFalse($user3->isSuperAdmin());
    }

    /**
     * @test
     */
    public function isAdmin()
    {
        $user = Admin::factory()->make();
        $user2 = Admin::factory()->admin()->make();
        $user3 = Admin::factory()->make([
            'type' => 'user',
        ]);

        $this->assertTrue($user->isAdmin());
        $this->assertFalse($user->isAdmin(true));
        $this->assertTrue($user2->isAdmin());
        $this->assertTrue($user2->isAdmin(true));
        $this->assertFalse($user3->isAdmin());
    }

    /**
     * @test
     */
    public function canImpersonate()
    {
        $user = Admin::factory()->make();
        $user2 = Admin::factory()->admin()->make();
        $user3 = Admin::factory()->make([
            'type' => 'user',
        ]);

        $this->assertTrue($user->canImpersonate());
        $this->assertTrue($user2->canImpersonate());
        $this->assertFalse($user3->canImpersonate());
    }
}
