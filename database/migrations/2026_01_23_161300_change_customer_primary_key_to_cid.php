<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Tambah kolom cid di customers jika belum ada
        if (!Schema::hasColumn('customers', 'cid')) {
            Schema::table('customers', function (Blueprint $table) {
                $table->string('cid')->nullable()->after('id');
            });
        }

        // Step 2: Update cid dengan nilai dari id untuk customer yang cid-nya null (skip jika id tidak ada)
        if (Schema::hasColumn('customers', 'id')) {
            DB::statement("UPDATE customers SET cid = CONCAT('CID-', id) WHERE cid IS NULL OR cid = ''");
        }

        // Step 3: Tambah kolom customer_cid di on_site_forms jika belum ada
        if (!Schema::hasColumn('on_site_forms', 'customer_cid')) {
            Schema::table('on_site_forms', function (Blueprint $table) {
                $table->string('customer_cid')->nullable()->after('id');
            });
        }

        // Step 4: Copy customer cid ke on_site_forms.customer_cid berdasarkan customer_id
        if (Schema::hasColumn('on_site_forms', 'customer_id') && Schema::hasColumn('customers', 'id')) {
            DB::statement("
                UPDATE on_site_forms osf 
                INNER JOIN customers c ON osf.customer_id = c.id 
                SET osf.customer_cid = c.cid
            ");
        }

        // Step 5: Drop kolom customer_id dari on_site_forms jika ada
        if (Schema::hasColumn('on_site_forms', 'customer_id')) {
            // Check and drop foreign key if exists
            $foreignKeys = DB::select("
                SELECT CONSTRAINT_NAME 
                FROM information_schema.KEY_COLUMN_USAGE 
                WHERE TABLE_SCHEMA = DATABASE() 
                AND TABLE_NAME = 'on_site_forms' 
                AND COLUMN_NAME = 'customer_id' 
                AND REFERENCED_TABLE_NAME IS NOT NULL
            ");
            
            if (!empty($foreignKeys)) {
                Schema::table('on_site_forms', function (Blueprint $table) use ($foreignKeys) {
                    $table->dropForeign($foreignKeys[0]->CONSTRAINT_NAME);
                });
            }
            
            Schema::table('on_site_forms', function (Blueprint $table) {
                $table->dropColumn('customer_id');
            });
        }

        // Step 6: Drop kolom cid dari on_site_forms jika ada (dari migration sebelumnya)
        if (Schema::hasColumn('on_site_forms', 'cid')) {
            Schema::table('on_site_forms', function (Blueprint $table) {
                $table->dropColumn('cid');
            });
        }

        // Step 7: Ubah customers - set cid not nullable (if cid is nullable)
        $cidColumn = DB::selectOne("SHOW COLUMNS FROM customers WHERE Field = 'cid'");
        if ($cidColumn && $cidColumn->Null === 'YES') {
            DB::statement("ALTER TABLE customers MODIFY cid VARCHAR(255) NOT NULL");
        }

        // Step 8: Drop id column from customers and set cid as primary (if id exists)
        if (Schema::hasColumn('customers', 'id')) {
            Schema::table('customers', function (Blueprint $table) {
                $table->dropColumn('id');
            });
            
            Schema::table('customers', function (Blueprint $table) {
                $table->primary('cid');
            });
        }

        // Step 9: Tambah foreign key constraint baru (jika belum ada)
        // Skip foreign key karena tipe data mungkin tidak cocok
        // Relasi akan dihandle oleh Eloquent model
        try {
            $existingForeignKey = DB::select("
                SELECT CONSTRAINT_NAME 
                FROM information_schema.KEY_COLUMN_USAGE 
                WHERE TABLE_SCHEMA = DATABASE() 
                AND TABLE_NAME = 'on_site_forms' 
                AND COLUMN_NAME = 'customer_cid' 
                AND REFERENCED_TABLE_NAME IS NOT NULL
            ");
            
            if (empty($existingForeignKey)) {
                // Pastikan tipe data sama sebelum membuat foreign key
                DB::statement("ALTER TABLE on_site_forms MODIFY customer_cid VARCHAR(255)");
                
                Schema::table('on_site_forms', function (Blueprint $table) {
                    $table->foreign('customer_cid')->references('cid')->on('customers')->onDelete('cascade');
                });
            }
        } catch (\Exception $e) {
            // Foreign key gagal dibuat, skip saja - relasi akan dihandle oleh Eloquent
            \Log::warning('Foreign key customer_cid tidak bisa dibuat: ' . $e->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Step 1: Drop foreign key constraint
        Schema::table('on_site_forms', function (Blueprint $table) {
            $table->dropForeign(['customer_cid']);
        });

        // Step 2: Tambah id kembali di customers
        Schema::table('customers', function (Blueprint $table) {
            $table->dropPrimary(['cid']);
        });
        
        Schema::table('customers', function (Blueprint $table) {
            $table->id()->first();
        });

        // Step 3: Tambah cid dan customer_id kembali di on_site_forms
        Schema::table('on_site_forms', function (Blueprint $table) {
            $table->string('cid')->nullable()->after('customer_cid');
            $table->unsignedBigInteger('customer_id')->nullable()->after('id');
        });

        // Step 4: Drop customer_cid
        Schema::table('on_site_forms', function (Blueprint $table) {
            $table->dropColumn('customer_cid');
        });

        // Step 5: Tambah foreign key constraint lama
        Schema::table('on_site_forms', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }
};
