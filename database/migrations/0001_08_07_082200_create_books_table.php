<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('book_isbn')->unique(); 
            $table->string('book_name');
            $table->string('book_author');
            $table->decimal('book_price', 8, 2);
            $table->string('book_publication');
            $table->string('book_condition');
            $table->integer('book_quantity');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('subcategory_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('subsubcategory_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('book_pic'); 
            $table->string('owner_email');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}
