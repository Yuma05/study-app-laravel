<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'statuses', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->integer('quiz_score');
                $table->boolean('is_complete')->default(false);
                $table->foreignId('user_id');
                $table->foreignId('material_id');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuses');
    }
}
