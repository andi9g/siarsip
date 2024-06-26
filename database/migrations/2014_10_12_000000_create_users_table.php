<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('iduser');
            // $table->string('name');
            // $table->string('email')->unique();
            $table->string('username')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            // $table->string('gambar')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // DB::table("users")->insert([
        //     "name" => "admin",
        //     "email" => "admin@gmail.com",
        //     "username" => "admin",
        //     "password" => Hash::make('admin2024'),
        //     "gambar" => "user.png",
        // ]);
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
