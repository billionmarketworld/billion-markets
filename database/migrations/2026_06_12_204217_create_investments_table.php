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
        Schema::create('investments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('plan_name'); // ইনভেস্টমেন্ট প্ল্যানের নাম
    $table->double('amount', 15, 2); // কত টাকা ইনভেস্ট করেছে
    $table->double('profit', 15, 2)->default(0.00); // প্রফিট কত হলো
    $table->string('status')->default('active'); // একটিভ নাকি ক্লোজড
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
        Schema::dropIfExists('investments');
    }
};
