<?php

use App\Models\Page\Page;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('page_trackings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Page::class)->unique();
            $table->string('facebook_pixel_id')->nullable();
            $table->string('google_analytics_tracking_id')->nullable();
            $table->string('yandex_metrika_id')->nullable();
            $table->string('tik_tok_pixel_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('page_trackings');
    }
};
