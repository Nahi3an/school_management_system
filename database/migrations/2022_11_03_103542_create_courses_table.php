<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->unsignedBigInteger('category_id')->nullable()->comment('from categories table');
            $table->unsignedBigInteger('teacher_id')->nullable()->comment('from teachers table');
            $table->string('course_title');
            $table->text('course_requirements');
            $table->text('course_description');
            $table->text('slug');
            $table->text('course_image');
            $table->integer('course_price');
            $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    ->onUpdate('CASCADE')
                    ->onDelete('SET NULL');
            $table->foreign('teacher_id')
                    ->references('id')
                    ->on('teachers')
                    ->onUpdate('CASCADE')
                    ->onDelete('SET NULL');
            $table->timestamps();

            //  "category_id" => "required",
            // "tag_names" => "required|min:1",
            // "course_title" => "required|string|max:255|min:10",
            // "course_description" => "required|string",
            // "slug" => "unique:courses,slug",
            // "course_price" => "required|integer"
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
};
