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
        Schema::create('ledger_points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('type', ['top up', 'purchase']);
            // $table->unsignedBigInteger('ref_id');
            $table->bigInteger('ref_id');
            $table->integer('current');
            $table->integer('add');
            $table->integer('final');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('ref_id','ledger_table_member_marchendises_ref_id_foreign')->references('id',)->on('member_marchendises');
            // $table->foreign('ref_id','ledger_table_member_points_ref_id_foreign')->references('id',)->on('member_points');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ledger_points');
    }
};
