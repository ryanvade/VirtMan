<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVirtmanStorageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('virtman_storage', function (Blueprint $table) {
            // Identifier
            $table->increments('id');
            // Date created, last updated
            $table->timestamps();
            // Storage Name
            $table->string('name')->nullable();
            // Storage Image Location
            $table->string('location');
            // Storage Type (QCOW2, RAW, ISO)
            $table->string('type');
            // Storage Size (MB)
            $table->unsignedInteger('size')->nullable();
            // Whether the storage is currently in use
            $table->boolean('active')->default(False);
            // Whether the storage image has been created
            $table->boolean('initialized')->default(False);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('virtman_storage');
    }
}
