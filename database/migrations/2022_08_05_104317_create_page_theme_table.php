<?php

use App\Models\Page\Page;
use App\Models\Theme;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('page_theme', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Page::class)->unique();
            $table->foreignIdFor(Theme::class);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('page_theme');
    }
};
