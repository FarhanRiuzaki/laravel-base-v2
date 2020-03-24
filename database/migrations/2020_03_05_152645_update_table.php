<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // table apps
        Schema::table('apps',function(Blueprint $table)
        {
            $table->string('theme')->after('image_icon');
            $table->integer('created_by')->after('created_at')->nullable();
            $table->integer('updated_by')->after('updated_at')->nullable();
        });

        // master flags
        Schema::table('users',  function(Blueprint $table){
            $table->integer('created_by')->after('created_at')->nullable();
            $table->integer('updated_by')->after('updated_at')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
