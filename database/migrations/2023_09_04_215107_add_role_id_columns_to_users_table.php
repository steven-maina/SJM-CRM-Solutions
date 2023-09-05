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
          Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->nullable();;
           $table->unsignedBigInteger('account_id')->nullable();;
           $table->string('status')->nullable();
           $table->string('created_by');
           $table->string('updated_by')->nullable();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('set null');
          });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::table('users', function (Blueprint $table) {
        $table->dropForeign(['role_id']);
        $table->dropColumn('role_id');
//        $table->dropForeign(['user_code']);
//        $table->dropColumn('user_code');
        $table->dropForeign(['account_id']);
        $table->dropColumn('account_id');
      });
    }
};
