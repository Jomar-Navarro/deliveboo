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
        Schema::table('dishes', function (Blueprint $table) {

            // 1.creiamo la colonna della foreign key
            $table->unsignedBigInteger('restaurant_id')->nullable()->after('id');
            // 2.assegno la FK alla colonna creata
            $table->foreign('restaurant_id')
                ->references('id')
                ->on('restaurants')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dishes', function (Blueprint $table) {

            // 1. si elimina la foreign key
            //elimino in base al nome della FK
            // $table->dropForeign('posts_type_id_foreign');

            // elimino in base al nome della colonna
            $table->dropForeign(['restaurant_id']);
            // 2. si elimina la colonna
            $table->dropColumn('restaurant_id');
        });
    }
};
