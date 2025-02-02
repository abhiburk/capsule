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
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->foreignUuid('user_id');
            $table->boolean('visibility')->default(0);
            $table->boolean('is_default')->default(0);
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
