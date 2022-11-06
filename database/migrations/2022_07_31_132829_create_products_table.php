<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('price')->nullable();
            $table->integer('old_price')->nullable();
            $table->string('currency')->nullable();
            $table->boolean('action_btn')->default(false);
            $table->string('btn_label')->nullable();
            $table->string('btn_link')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
