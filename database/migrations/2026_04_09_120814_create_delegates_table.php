<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    protected $fillable = ['full_name', 'email', 'phone', 'company_name', 'program_name', 'payment_proof', 'status', 'admin_notes'];
    public function up(): void
    {
       Schema::create('delegates', function (Blueprint $table) {
       $table->id();
    $table->string('full_name');
    $table->string('email');
    $table->string('phone');
    $table->string('residential_address')->nullable();
    $table->string('company_name')->nullable();
    $table->string('job_title')->nullable();
    $table->text('organization_address')->nullable(); 
    $table->text('business_products')->nullable();
    $table->string('program_name');
    $table->string('payment_proof');
    $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
    $table->text('admin_notes')->nullable(); 
    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delegates');
    }
};
