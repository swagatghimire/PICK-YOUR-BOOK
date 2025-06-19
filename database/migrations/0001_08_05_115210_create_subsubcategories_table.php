<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubsubcategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('subsubcategories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subcategory_id')->constrained('subcategories')->onDelete('cascade');
            $table->string('subsubcategory_name');
            $table->foreignId('admin_id')->constrained('admin_info')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subsubcategories');
    }
}

