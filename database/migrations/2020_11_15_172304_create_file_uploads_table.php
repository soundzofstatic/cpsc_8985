<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_uploads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('business_id')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('upload_type', 64)->comment('Denotes the type of upload it is');
            $table->string('path_directory', 255);
            $table->string('file_type', 18);
            $table->text('file_path');
            $table->text('file_name');
            $table->string('file_size', 36);
            $table->string('file_extension', 8);
            $table->string('mime_type', 36);
            $table->text('alt_text')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_uploads');
    }
}
