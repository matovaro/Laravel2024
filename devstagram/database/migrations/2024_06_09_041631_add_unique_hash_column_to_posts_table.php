<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueHashColumnToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('uniqueHash');
        });

        DB::table('posts')->get()->each(function($row) {
            DB::table('posts')
                ->where('id', $row->id)
                ->update(['uniqueHash' => $this->calculateUniqueHash($row->imagen)]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('uniqueHash');
        });
    }

    /**
     * Calcular el valor de la nueva columna basándose en la columna existente.
     *
     * @param  string  $existingColumnValue
     * @return string
     */
    private function calculateUniqueHash($existingImagenColumn)
    {
        // Aquí puedes definir tu lógica para calcular el valor de la nueva columna
        // Basado en el valor de existing_column
        return explode('.',$existingImagenColumn)[0];
    }
}
