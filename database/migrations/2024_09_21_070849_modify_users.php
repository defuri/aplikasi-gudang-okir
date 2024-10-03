<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop columns if they exist
        Schema::table('users', function (Blueprint $table) {
            $columns = ['name', 'email', 'email_verified_at', 'remember_token'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        // Rename column if it exists
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'hak')) {
                $table->renameColumn('hak', 'id_hak');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'name')) {
                $table->string('name', 255)->unique()->nullable(false); // Ensure not nullable
            }
            if (!Schema::hasColumn('users', 'email')) {
                $table->string('email', 255)->unique()->nullable(false); // Ensure not nullable
            }
            if (!Schema::hasColumn('users', 'email_verified_at')) {
                $table->timestamp('email_verified_at')->nullable();
            }
            if (!Schema::hasColumn('users', 'remember_token')) {
                $table->string('remember_token', 100)->nullable();
            }
        });

        // Rename back if needed
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'id_hak')) {
                $table->renameColumn('id_hak', 'hak');
            }
        });
    }
};
