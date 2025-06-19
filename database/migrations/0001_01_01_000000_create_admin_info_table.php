<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash; // Import the Hash class
use Illuminate\Support\Facades\DB; // Import the DB facade

class CreateAdminInfoTable extends Migration
{
    public function up()
    {
        Schema::create('admin_info', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        // Insert default admin user
        DB::table('admin_info')->insert([
            'firstName' => 'Swagat',
            'lastName' => 'Ghimire',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin@123'), // Hash the password
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('admin_info');
    }
}
