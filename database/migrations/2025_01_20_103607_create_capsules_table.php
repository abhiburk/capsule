<?php

use App\Enums\CapsuleStatusEnum;
use App\Enums\CapsuleVisibilityEnum;
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
        Schema::create('capsules', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            $table->foreignUuid('user_id');
            $table->boolean('visibility')->default(0);
            $table->integer('scheduled_days')->default(365)->comment("The number of days the capsule will be unlocked after it is created");
            $table->timestamp('scheduled_at')->nullable()->comment("The date and time the letter is scheduled to be sent");
            $table->string('status')->default(CapsuleStatusEnum::DRAFT);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capsules');
    }
};
