<?php

use App\Enums\CapsuleStatusEnum;
use App\Enums\ChannelTypesEnum;
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
        Schema::create('letters', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->foreignUuid('user_id');
            $table->foreignUuid('capsule_id');
            $table->text('message');
            $table->json('channels')->nullable()->comment("The channels the letter will be sent to");
            $table->integer('scheduled_days')->default(365)->comment("The number of days the capsule will be unlocked after it is created");
            $table->timestamp('scheduled_at')->nullable()->comment("The date and time the letter is scheduled to be sent");
            $table->timestamp('delivered_at')->nullable()->comment("The date and time the letter was sent");
            $table->timestamp('read_at')->nullable()->comment("The date and time the letter was read");
            $table->boolean('is_public')->nullable()->default(false);
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
        Schema::dropIfExists('letters');
    }
};
