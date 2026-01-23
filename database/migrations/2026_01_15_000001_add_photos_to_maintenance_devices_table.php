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
            $table->string('product_photo')->nullable()->after('serial_number');
            $table->string('installation_photo')->nullable()->after('product_photo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('maintenance_devices', function (Blueprint $table) {
            $table->dropColumn(['product_photo', 'installation_photo']);
        });
    }
};
