<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'choices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('content');
            $table->foreignId('question_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->boolean('is_answer');
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
        Schema::dropIfExists('choices');
    }
}
