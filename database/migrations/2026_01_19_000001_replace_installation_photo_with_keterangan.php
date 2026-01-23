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
        Schema::table('maintenance_devices', function (Blueprint $table) {
            $table->dropColumn('installation_photo');
            $table->text('keterangan')->nullable()->after('product_photo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('maintenance_devices', function (Blueprint $table) {
            $table->dropColumn('keterangan');
            $table->string('installation_photo')->nullable()->after('product_photo');
        });
    }
};
