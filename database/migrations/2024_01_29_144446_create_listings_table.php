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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            // From API
            $table->text('property_id')->unique();
            $table->text('listing_id');
            $table->text('status')->nullable();
            $table->text('branding_name')->nullable();
            $table->text('address_line')->nullable();
            $table->text('address_city')->nullable();
            $table->text('address_state')->nullable();
            $table->string('address_postal_code', 5)->nullable();
            $table->string('address_state_code', 2)->nullable();
            $table->text('description_type')->nullable();
            $table->tinyInteger('description_beds')->nullable();
            $table->tinyInteger('description_baths')->nullable();
            $table->bigInteger('description_lot_sqft')->nullable();
            $table->smallInteger('description_sqft')->nullable();
            $table->text('advertisers_name')->nullable();
            $table->text('advertisers_email')->nullable();
            $table->boolean('flags_is_price_reduced')->nullable()->default(0);
            $table->boolean('flags_is_new_construction')->nullable()->default(0);
            $table->boolean('flags_is_foreclosure')->nullable()->default(0);
            $table->boolean('flags_is_plan')->nullable()->default(0);
            $table->boolean('flags_is_new_listing')->nullable()->default(0);
            $table->boolean('flags_is_contingent')->nullable()->default(0);
            $table->boolean('flags_is_pending')->nullable()->default(0);
            $table->mediumInteger('list_price')->nullable();
            $table->mediumInteger('price_reduced_amount')->nullable();
            $table->string('primary_photo', 100)->nullable();
            // ----------------------
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
