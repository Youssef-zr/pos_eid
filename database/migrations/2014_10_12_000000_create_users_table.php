<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('adress')->nullable();
            $table->string('phone')->nullable();
            $table->string('status')->nullable()->default('enabled');
            $table->string('file_name', 50)->nullable()->default('default.png');
            $table->string('path', 100)->nullable()->default('assets/dist/storage/users/default.png');
            $table->dateTime('last_login_at')->nullable();
            $table->string('last_login_ip_address')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
