<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVirtmanNetworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('virtman_networks', function(Blueprint $table) {
        // Identifier
        $table->increments('id');
        // Date created, last updated
        $table->timestamps();
        // MAC Address
        $table->string('mac');
        // libvirt 'Network' name
        $table->string('network');
        // NIC Model
        $table->string('model');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('virtman_networks');
    }
}
