<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name'); // Full Name
            $table->string('username')->unique(); // Username
            $table->date('dob'); // Date of Birth
            $table->string('mobile'); // Mobile Number
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            // ব্যালেন্স ও নোটিশের জন্য নতুন কলাম
            $table->double('main_balance', 15, 2)->default(0.00);
            $table->double('bonus_balance', 15, 2)->default(0.00);
            $table->string('role')->default('user'); // admin নাকি user তা চেনার জন্য
            
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
};
