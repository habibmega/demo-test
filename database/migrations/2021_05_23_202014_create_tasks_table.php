<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('list_id');
            $table->id();
            $table->text('title')->unique();
            $table->string('description')->nullable();
            $table->boolean('status_check')->default(false);
            $table->string('progress')->nullable();
            $table->timestamps();
            $table->foreign('list_id')->references('id')->on('mlists')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->index(['list_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
