<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2)->default(0);
            $table->string('interval')->default('month');
            $table->integer('interval_count')->default(1);
            $table->integer('sort_order')->default(0);
            $table->string('currency')->default('USD');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_recurring')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_trial_plan')->default(false);
            $table->string('trial_interval')->default('month');
            $table->integer('trial_interval_count')->default(1);
            $table->integer('trial_period_days')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
};
