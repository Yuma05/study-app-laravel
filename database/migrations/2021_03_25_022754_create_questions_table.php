<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'questions', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->text('content');
                $table->text('explanation');
                $table->foreignId('material_id');
                $table->foreignId('created_by');
                $table->foreignId('updated_by');
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
        Schema::dropIfExists('questions');
    }
}
