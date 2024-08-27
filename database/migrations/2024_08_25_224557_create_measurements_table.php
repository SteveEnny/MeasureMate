<?php

use App\Models\Customer;
use App\Models\User;
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
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            // $table->foreignIdFor(User::class);
            $table->foreignIdFor(Customer::class);
            $table->string('body_type');
            $table->decimal('bust', 5, 2)->nullable();
            $table->decimal('neck', 5, 2)->nullable();
            $table->decimal('rise', 5, 2)->nullable();
            $table->decimal('chest', 5, 2)->nullable();
            $table->decimal('waist', 5, 2)->nullable();
            $table->decimal('hips', 5, 2)->nullable();
            $table->decimal('shoulder_width', 5, 2)->nullable();
            $table->decimal('sleeve_length', 5, 2)->nullable();
            $table->decimal('sleeve_opening', 5, 2)->nullable();
            $table->decimal('arm_length', 5, 2)->nullable();
            $table->decimal('inseam', 5, 2)->nullable();
            $table->decimal('outseam', 5, 2)->nullable();
            $table->decimal('length', 5, 2)->nullable();
            $table->timestamps();
        });

        // Schema::create('type')
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};