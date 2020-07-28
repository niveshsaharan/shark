<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('shopify_grandfathered')->default(false);
            $table->string('shopify_namespace')->nullable();
            $table->boolean('shopify_freemium')->default(false);
            $table->integer('plan_id')->unsigned()->nullable();

            $table->string('analytics_id')->nullable();
            $table->string('chat_id')->nullable();
            $table->string('shopify_gid')->nullable();
            $table->string('domain')->nullable();
            $table->string('shop_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('province_code')->nullable();
            $table->string('country')->nullable();
            $table->string('country_code')->nullable();
            $table->string('currency', 3)->nullable();
            $table->json('presentment_currencies')->nullable();
            $table->string('money_format')->nullable();
            $table->string('money_with_currency_format')->nullable();
            $table->string('money_in_email_format')->nullable();
            $table->string('money_with_currency_in_email_format')->nullable();
            $table->string('timezone_offset')->nullable();
            $table->string('iana_timezone')->nullable();
            $table->string('shopify_plan_display_name')->nullable();
            $table->boolean('shopify_partner')->nullable();
            $table->boolean('shopify_plus')->nullable();
            $table->json('shopify_scopes')->nullable();

            $table->softDeletes();

            $table->foreign('plan_id')->references('id')->on('plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_plan_id_foreign');
            $table->dropColumn([
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
            ]);

            $table->dropSoftDeletes();
        });
    }
}
