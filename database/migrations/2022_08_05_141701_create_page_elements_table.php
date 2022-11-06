<?php

use App\Models\Page\Page;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('page_elements', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Page::class);
            $table->string('component_alias');
            $table->json('props');
            $table->integer('order_column');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('page_elements');
    }
};
