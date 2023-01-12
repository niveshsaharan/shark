<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrivateAppFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('api_type')->default('public')->nullable()->after('shopify_scopes'); // public/private/custom
            $table->string('api_key')->nullable();
            $table->string('api_password')->nullable();
            $table->string('api_secret')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('api_type');
            $table->dropColumn('api_key');
            $table->dropColumn('api_password');
            $table->dropColumn('api_secret');
        });
    }
}
