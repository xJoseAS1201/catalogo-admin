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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->string('business_name', 150);
            $table->string('logo')->nullable();

            $table->string('whatsapp_number', 30)->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('facebook_url')->nullable();

            $table->text('address')->nullable();
            $table->text('google_maps_url')->nullable();
            $table->text('schedule')->nullable();

            $table->string('primary_color', 20)->default('#111827');
            $table->string('secondary_color', 20)->default('#f59e0b');

            $table->string('footer_text')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
