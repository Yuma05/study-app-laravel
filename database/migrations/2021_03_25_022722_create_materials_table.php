<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'materials', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 50);
            $table->text('content');
            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();
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
        Schema::dropIfExists('materials');
    }
}
