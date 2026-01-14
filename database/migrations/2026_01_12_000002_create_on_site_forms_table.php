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
        Schema::create('on_site_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Petugas
            
            // Activity checkboxes
            $table->boolean('activity_survey')->default(false);
            $table->boolean('activity_activation')->default(false);
            $table->boolean('activity_upgrade')->default(false);
            $table->boolean('activity_downgrade')->default(false);
            $table->boolean('activity_troubleshoot')->default(false);
            $table->boolean('activity_preventive_maintenance')->default(false);
            
            // Complaint & Action
            $table->text('complaint')->nullable();
            $table->text('action')->nullable();
            
            // Assessment: tidak_puas, puas, sangat_puas
            $table->enum('assessment', ['tidak_puas', 'puas', 'sangat_puas'])->nullable();
            
            // Signature data (base64 encoded - needs LONGTEXT)
            $table->longText('signature_first_party')->nullable();
            $table->longText('signature_second_party')->nullable();
            $table->string('first_party_name')->nullable();
            $table->string('second_party_name')->nullable();
            
            // Location and date
            $table->string('location')->nullable();
            $table->date('form_date')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('on_site_forms');
    }
};
