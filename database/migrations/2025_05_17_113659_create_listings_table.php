<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Listing\ListingUser;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('external_id')->index();
            $table->string('slug');
            $table->unique(['slug', 'external_id']);
            $table->foreignIdFor(ListingUser::class)->index()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('city_id');
            $table->integer('rubric');
            $table->decimal('price', 12, 2);
            $table->decimal('start_price', 12, 2)->nullable();
            $table->string('price_description')->nullable();
            $table->timestamp('published_at');
            $table->integer('hit_count');
            $table->string('phone_hitcount');
            $table->string('video_link')->nullable();
            $table->boolean('flatplan');
            $table->integer('zoom')->nullable();
            $table->string('category_type');
            $table->integer('feet');
            $table->string('floor');
            $table->string('remont');
            $table->string('sanuzel');
            $table->text('district')->nullable();
            $table->integer('otoplenie');
            $table->integer('sostoyanie');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
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
