<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $schema = Schema::getConnection()->getSchemaBuilder();
        
        if (! $schema->hasIndex('carritos', 'carritos_usuario_id_unique', 'unique')) {
            return;
        }
        // Elimina la restricción de unicidad en la columna usuario_id de la tabla carritos
        Schema::table('carritos', function (Blueprint $table): void {
            $table->dropUnique('carritos_usuario_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $schema = Schema::getConnection()->getSchemaBuilder();

        if ($schema->hasIndex('carritos', 'carritos_usuario_id_unique', 'unique')) {
            return;
        }

        Schema::table('carritos', function (Blueprint $table): void {
            $table->unique('usuario_id');
        });
    }
};
