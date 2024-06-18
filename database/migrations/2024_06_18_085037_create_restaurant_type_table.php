<?php

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
        Schema::create('restaurant_type', function (Blueprint $table) {
            //colonna di relazione con posts
            $table->unsignedBigInteger('restaurant_id');

            // FK su questa colonna
            $table->foreign('restaurant_id')
                ->references('id')
                ->on('restaurants')
                ->cascadeOnDelete();
            // se viene eliminato un post o un tag viene cancellato il record della relazione
            //colonna di relazione con tags
            $table->unsignedBigInteger('type_id');

            // FK su questa colonna
            $table->foreign('type_id')
                ->references('id')
                ->on('types')
                ->cascadeOnDelete();
            // se viene eliminato un post o una categoria viene cancellato il record della relazione
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant_type');
    }
};
