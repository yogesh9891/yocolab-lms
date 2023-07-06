<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Live', 'Recorded']);
            $table->string('title');
            $table->enum('level', ['Beginners', 'intermediate','Advance']);
            $table->string('category_id');
            $table->text('tags');
            $table->text('desciption')->nullable();
            $table->text('learn')->nullable();
            $table->text('currency')->nullable();
            $table->text('price')->nullable();
            $table->text('date')->nullable();    
            $table->text('time')->nullable();    
            $table->text('duration')->nullable();    
            $table->integer('material_id')->nullable();    
            $table->text('image')->nullable();    
            $table->text('video')->nullable();    
            $table->text('url')->nullable(); 
            $table->text('preview')->nullable(); 
            $table->integer('user_id'); 
            $table->boolean('status')->default(1);
            $table->softDeletes();

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
        Schema::dropIfExists('courses');
    }
}
