<?php

use App\Models\Page\Page;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('link_clicks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Page::class);
            $table->string('link_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('link_clicks');
    }
};
