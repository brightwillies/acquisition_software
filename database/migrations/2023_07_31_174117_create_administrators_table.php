<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('administrators', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('telephone_number')->nullable();
            $table->string('device_token')->nullable();
            $table->integer('status')->nullable()->defualt(1);
            $table->string('password');
            $table->date('date_added')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->string('mask');
            $table->string('image')->nullable();
            $table->string('image_filename')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('administrators')->insert([
            'first_name' => 'ACIDMS',
            'last_name' => 'Administrator',
            'email' => 'admin@acidms.com',
            'telephone_number' => '0241849088',
            'status' => 1,
            'mask' => \generate_mask(),
            'password' => Hash::make('Admin@2023!!..'),
            'date_added' => Carbon::now()->format('Y-m-d'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrators');
    }
};
