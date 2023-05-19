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
        Schema::create('statements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->notnull();
            $table->unsignedBigInteger('property_type_id')->notnull();
            $table->string('title')->notnull();
            $table->text('desc')->nullable();
            $table->integer('price')->notnull()->index();
            $table->integer('floors')->default(1);
            $table->boolean('active')->default(true);
            $table->string('address')->notnull();
            $table->enum('currency', ['gel', 'uer', 'usd'])->default('gel');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('property_type_id')->references('id')->on('property_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statements');
    }
};
