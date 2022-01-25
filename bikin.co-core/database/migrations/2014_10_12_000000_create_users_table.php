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
            $table->string('email')->unique()->index('email');;
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->index('password');;
            $table->rememberToken();
            $table->timestamps();
            $table->string('created_by',10)->nullable();
            $table->string('created_from')->nullable();
            $table->string('modified_by',10)->nullable();
            $table->string('modified_from')->nullable();
            $table->string('deleted_from')->nullable();
            $table->softDeletes();
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
