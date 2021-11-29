<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKursxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_kursxes', function (Blueprint $table) {
            $table->id();
            $table->string('currency')->nullable();
            $table->decimal('value', 5, 2)->nullable();
            $table->float('selling_rate')->nullable();
            $table->float('buying_rate')->nullable();
            $table->string('last_update')->nullable();
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
        Schema::dropIfExists('master_kursxes');
    }
}
