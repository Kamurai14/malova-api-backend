<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('movimientos_afiliados', function (Blueprint $table) {
            // Agregamos la columna 'concepto' justo después de 'puntos_delta'
            $table->string('concepto')->nullable()->after('puntos_delta');
        });
    }

    public function down()
    {
        Schema::table('movimientos_afiliados', function (Blueprint $table) {
            $table->dropColumn('concepto');
        });
    }
};
