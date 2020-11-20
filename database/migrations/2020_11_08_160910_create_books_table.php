<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->text('desc');
            $table->float('price',6,2);
            $table->string('img',100)->nullable();
            $table->string('pdf',100)->nullable();
            $table->integer('number_download')->nullable();
            $table->foreignId('author_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
