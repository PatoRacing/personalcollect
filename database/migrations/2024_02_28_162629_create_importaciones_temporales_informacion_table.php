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
        Schema::create('importaciones_temporales_informacion', function (Blueprint $table) {
            $table->id();
            $table->string('documento')->nullable();
            $table->string('cuil')->nullable();
            $table->string('email')->nullable();
            $table->string('telefono_uno')->nullable();
            $table->string('telefono_dos')->nullable();
            $table->string('telefono_tres')->nullable();
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
        Schema::dropIfExists('importaciones_temporales_informacion');
    }
};
