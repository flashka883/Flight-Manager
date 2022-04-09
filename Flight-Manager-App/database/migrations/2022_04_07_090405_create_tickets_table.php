<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->timestamp('departs_at');
            $table->timestamp('lands_at');
            $table->unsignedBigInteger('air_port_from');
            $table->unsignedBigInteger('air_port_to');
            $table->unsignedBigInteger('air_plane_class_id');
            $table->double('price');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('air_port_from')->references('id')->on('air_ports')->onDelete('cascade');
            $table->foreign('air_port_to')->references('id')->on('air_ports')->onDelete('cascade');
            $table->foreign('air_plane_class_id')->references('id')->on('air_plane_classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
