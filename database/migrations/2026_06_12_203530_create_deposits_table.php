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
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // কোন ইউজারের ডিপোজিট তা ট্র্যাক করবে
            $table->double('amount', 15, 2); // কত টাকা ডিপোজিট
            $table->string('method')->nullable(); // কি মাধ্যমে (বিকাশ/ব্যাংক ইত্যাদি)
            $table->string('status')->default('completed'); // স্ট্যাটাস
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
        Schema::dropIfExists('deposits');
    }
};
